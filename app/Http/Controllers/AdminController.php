<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Fasilitas_Kampus;
use App\Models\Perlengkapan_Fasilitas_Kampus;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Menampilkan detail peminjaman
     */
    public function bookingDetail($id)
    {
        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::with(['peminjam', 'fasilitas'])->findOrFail($id);
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $peminjamanditolak = Peminjaman::where('status_peminjaman', 'Ditolak')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.booking_detail', compact('admin', 'booking', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'peminjamanditolak', 'pendingBookings'));
    }

    /**
     * Setujui peminjaman
     */
    public function approveBooking($id)
    {
        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::findOrFail($id);

        $booking->update([
            'status_peminjaman' => 'Disetujui',
            'id_admin' => $admin->id_admin,
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    /**
     * Tolak peminjaman
     */
    public function rejectBooking(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::findOrFail($id);

        $booking->update([
            'status_peminjaman' => 'Ditolak',
            'id_admin' => $admin->id_admin,
            'keterangan' => $request->alasan_penolakan ?? 'Pengajuan tidak memenuhi syarat atau fasilitas sedang digunakan untuk agenda fakultas.',
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Peminjaman telah ditolak.');
    }

    // Fasilitas CRUD
    public function facilitiesIndex()
    {
        $admin = Auth::guard('admin')->user();
        $facilities = Fasilitas_Kampus::all();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.facilities', compact('admin', 'facilities', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function facilitiesCreate()
    {
        $admin = Auth::guard('admin')->user();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.facilities_create', compact('admin', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function facilitiesStore(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'lokasi_fasilitas' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'status_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Fasilitas_Kampus::create($request->all());

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function facilitiesEdit($id)
    {
        $admin = Auth::guard('admin')->user();
        $facility = Fasilitas_Kampus::findOrFail($id);
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.facilities_edit', compact('admin', 'facility', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function facilitiesUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'lokasi_fasilitas' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'status_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $facility = Fasilitas_Kampus::findOrFail($id);
        $facility->update($request->all());

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function facilitiesDestroy($id)
    {
        $facility = Fasilitas_Kampus::findOrFail($id);
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }

    // Perlengkapan CRUD
    public function equipmentIndex()
    {
        $admin = Auth::guard('admin')->user();
        $equipment = Perlengkapan_Fasilitas_Kampus::with('fasilitas')->get();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.equipment', compact('admin', 'equipment', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function equipmentCreate()
    {
        $admin = Auth::guard('admin')->user();
        $facilities = Fasilitas_Kampus::all();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.equipment_create', compact('admin', 'facilities', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function equipmentStore(Request $request)
    {
        $request->validate([
            'id_fasilitas' => 'required|exists:Fasilitas_Kampus,id_fasilitas',
            'nama_perlengkapan' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string|max:255',
        ]);

        Perlengkapan_Fasilitas_Kampus::create($request->all());

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan berhasil ditambahkan.');
    }

    public function equipmentEdit($id)
    {
        $admin = Auth::guard('admin')->user();
        $equipment = Perlengkapan_Fasilitas_Kampus::findOrFail($id);
        $facilities = Fasilitas_Kampus::all();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.equipment_edit', compact('admin', 'equipment', 'facilities', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function equipmentUpdate(Request $request, $id)
    {
        $request->validate([
            'id_fasilitas' => 'required|exists:Fasilitas_Kampus,id_fasilitas',
            'nama_perlengkapan' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string|max:255',
        ]);

        $equipment = Perlengkapan_Fasilitas_Kampus::findOrFail($id);
        $equipment->update($request->all());

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan berhasil diperbarui.');
    }

    public function equipmentDestroy($id)
    {
        $equipment = Perlengkapan_Fasilitas_Kampus::findOrFail($id);
        $equipment->delete();

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan berhasil dihapus.');
    }
}
