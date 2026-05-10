<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas_Kampus;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function showBookingForm($id)
    {
        $user = Auth::guard('peminjam')->user();
        $fasilitas = Fasilitas_Kampus::findOrFail($id);

        // Cek jika fasilitas tersedia
        if (strtolower($fasilitas->status_fasilitas) !== 'tersedia') {
            return redirect()->back()->with('error', 'Fasilitas ini sedang tidak tersedia untuk dipinjam.');
        }

        return view('booking', compact('user', 'fasilitas'));
    }

    public function submitBooking(Request $request)
    {
        $user = Auth::guard('peminjam')->user();

        $request->validate([
            'id_fasilitas' => 'required|exists:Fasilitas_Kampus,id_fasilitas',
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_peminjaman',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keperluan' => 'required|string',
            'administrasi_peminjaman' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $fasilitas = Fasilitas_Kampus::findOrFail($request->id_fasilitas);

        // Cek ulang status fasilitas pada saat submit agar tidak hanya bergantung pada halaman form.
        if (strtolower($fasilitas->status_fasilitas) !== 'tersedia') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Fasilitas ini sedang tidak tersedia untuk dipinjam.');
        }

        /*
         * Cek jadwal bentrok.
         *
         * Aturan overlap:
         * - Bentrok jika jam_mulai booking lama < jam_selesai pengajuan baru
         *   DAN jam_selesai booking lama > jam_mulai pengajuan baru.
         *
         * Status yang diblok:
         * - Pending: agar tidak ada dua pengajuan menunggu untuk slot yang sama.
         * - Disetujui: agar tidak menimpa booking yang sudah diterima.
         *
         * Status Ditolak tidak diblok supaya slot bisa diajukan kembali.
         */
        $conflict = Peminjaman::where('id_fasilitas', $fasilitas->id_fasilitas)
            ->whereIn('status_peminjaman', ['Pending', 'Disetujui'])
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    // Cek jika range tanggal beririsan
                    $q->where('tanggal_peminjaman', '<=', $request->tanggal_selesai)
                      ->where('tanggal_selesai', '>=', $request->tanggal_peminjaman);
                })->where(function ($q) use ($request) {
                    // Jika tanggalnya sama, cek jam
                    // Jika tanggal berbeda, asumsikan peminjaman seharian (conflict jika ada overlap tanggal)
                    // Namun untuk lebih presisi, kita cek jam hanya jika overlapnya di hari yang sama di batas awal/akhir
                    $q->where(function($sub) use ($request) {
                        $sub->where('tanggal_peminjaman', '<', $request->tanggal_selesai)
                            ->orWhere(function($ss) use ($request) {
                                $ss->where('tanggal_peminjaman', $request->tanggal_selesai)
                                   ->where('jam_mulai', '<', $request->jam_selesai);
                            });
                    })->where(function($sub) use ($request) {
                        $sub->where('tanggal_selesai', '>', $request->tanggal_peminjaman)
                            ->orWhere(function($ss) use ($request) {
                                $ss->where('tanggal_selesai', $request->tanggal_peminjaman)
                                   ->where('jam_selesai', '>', $request->jam_mulai);
                            });
                    });
                });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Maaf, sudah ada pengajuan atau peminjaman yang menunggu/disetujui untuk fasilitas ini pada tanggal dan jam yang saling bertumpuk. Silakan pilih jadwal lain.');
        }

        // Upload file
        $filePath = null;

        if ($request->hasFile('administrasi_peminjaman')) {
            $file = $request->file('administrasi_peminjaman');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('administrasi', $fileName, 'public');
        }

        // Simpan ke database
        Peminjaman::create([
            'id_fasilitas' => $fasilitas->id_fasilitas,
            'id_peminjam' => $user->id_peminjam,
            'id_admin' => null,
            'tanggal_pengajuan' => now()->toDateString(),
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_peminjaman' => 'Pending',
            'administrasi_peminjaman' => $filePath,
            'keterangan' => null,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('dashboard.user')->with('success', 'Pengajuan peminjaman fasilitas berhasil dikirim dan sedang menunggu persetujuan.');
    }
}
