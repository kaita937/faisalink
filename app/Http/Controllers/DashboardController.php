<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas_Kampus;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function peminjamDashboard()
    {
        $user = Auth::guard('peminjam')->user();
        
        // Ambil statistik
        $totalFasilitas = Fasilitas_Kampus::count();
        $totalBooked = Peminjaman::where('status_peminjaman', '!=', 'Ditolak')->count();
        $totalAvailable = $totalFasilitas - $totalBooked;
        
        // Ambil upcoming bookings
        $upcomingBookings = Peminjaman::with('fasilitas')
            ->where('id_peminjam', $user->id_peminjam)
            ->where('tanggal_peminjaman', '>=', now()->toDateString())
            ->orderBy('tanggal_peminjaman', 'asc')
            ->get();
        
        // Ambil semua fasilitas untuk kategori
        $fasilitas = Fasilitas_Kampus::all();
        
        return view('dashboard.peminjam', compact('user', 'totalAvailable', 'totalBooked', 'upcomingBookings', 'fasilitas'));
    }

    public function adminDashboard()
    {
        $admin = Auth::guard('admin')->user();
        
        // Ambil statistik
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        
        // Ambil pending peminjaman
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.admin', compact('admin', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }
}
