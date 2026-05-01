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
        if (strtolower($fasilitas->status_fasilitas) != 'tersedia') {
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
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keperluan' => 'required|string',
            'administrasi_peminjaman' => 'required|file|mimes:pdf,doc,docx|max:2048', // Maksimal 2MB
        ]);

        $fasilitas = Fasilitas_Kampus::findOrFail($request->id_fasilitas);

        // Upload file
        $filePath = null;
        if ($request->hasFile('administrasi_peminjaman')) {
            $file = $request->file('administrasi_peminjaman');
            // Simpan di public/storage/administrasi
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('administrasi', $fileName, 'public');
        }

        // Simpan ke database
        Peminjaman::create([
            'id_fasilitas' => $fasilitas->id_fasilitas,
            'id_peminjam' => $user->id_peminjam,
            'id_admin' => null, // Akan diisi oleh admin yang menyetujui
            'tanggal_pengajuan' => now()->toDateString(),
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
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
