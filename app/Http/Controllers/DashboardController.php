<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas_Kampus;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function peminjamDashboard()
    {
        $user = Auth::guard('peminjam')->user();
        
        // Ambil statistik
        $totalFasilitas = Fasilitas_Kampus::count();
        // Hitung statistik user-specific (Booked = peminjaman aktif/mendatang milik user)
        $totalBooked = Peminjaman::where('id_peminjam', $user->id_peminjam)
            ->whereIn('status_peminjaman', ['Pending', 'Disetujui'])
            ->where('tanggal_peminjaman', '>=', now()->toDateString())
            ->count();
            
        $totalAvailable = $totalFasilitas - $totalBooked;
        
        // Ambil upcoming bookings
        $upcomingBookings = Peminjaman::with('fasilitas')
            ->where('id_peminjam', $user->id_peminjam)
            ->where('tanggal_peminjaman', '>=', now()->toDateString())
            ->orderBy('tanggal_peminjaman', 'asc')
            ->get();
        
        // Ambil semua fasilitas untuk kategori
        $fasilitas = Fasilitas_Kampus::all();
        
        // Ambil notifikasi dinamis (berdasarkan perubahan status terbaru)
        $notifications = Peminjaman::with('fasilitas')
            ->where('id_peminjam', $user->id_peminjam)
            ->where('status_peminjaman', '!=', 'Pending')
            ->orderBy('id_peminjaman', 'desc')
            ->limit(5)
            ->get()
            ->map(function($item) {
                $status = strtolower($item->status_peminjaman);
                return [
                    'type' => $status == 'disetujui' ? 'success' : ($status == 'ditolak' ? 'warning' : 'info'),
                    'title' => 'Status: ' . $item->status_peminjaman,
                    'message' => 'Pengajuan ' . $item->fasilitas->nama_fasilitas . ($status == 'disetujui' ? ' telah disetujui.' : ' telah ditolak.'),
                    'time' => 'Baru saja',
                    'read' => false,
                    'url' => route('booking_view')
                ];
            });
            
        return view('dashboard.peminjam', compact('user', 'totalAvailable', 'totalBooked', 'upcomingBookings', 'fasilitas', 'notifications'));
    }

    public function facility()
    {
        $user = Auth::guard('peminjam')->user();
        $fasilitas = Fasilitas_Kampus::all();
        return view('facility', compact('user', 'fasilitas'));
    }

    public function facilityDetail($id)
    {
        $user = Auth::guard('peminjam')->user();
        $fasilitas = Fasilitas_Kampus::with('perlengkapan')->findOrFail($id);
        return view('facility_detail', compact('user', 'fasilitas'));
    }

    public function profile()
    {
        $user = Auth::guard('peminjam')->user();

        $totalBooking = Peminjaman::where('id_peminjam', $user->id_peminjam)->count();
        $monthlyBooking = Peminjaman::where('id_peminjam', $user->id_peminjam)
            ->whereMonth('tanggal_peminjaman', now()->month)
            ->whereYear('tanggal_peminjaman', now()->year)
            ->count();
        $canceledBooking = Peminjaman::where('id_peminjam', $user->id_peminjam)
            ->whereIn('status_peminjaman', ['Dibatalkan', 'Cancelled'])
            ->count();

        $programInfo = 'Teknik Informatika, Fakultas Ilmu Komputer';

        return view('profile', compact('user', 'totalBooking', 'monthlyBooking', 'canceledBooking', 'programInfo'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('peminjam')->user();

        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:Peminjam,username,' . $user->id_peminjam . ',id_peminjam',
            'email' => 'required|email|max:100|unique:Peminjam,email,' . $user->id_peminjam . ',id_peminjam',
            'contact' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048'
        ]);

        if (isset($validated['avatar'])) {
            unset($validated['avatar']);
        }

        if ($request->hasFile('avatar')) {
            if (!empty($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_path = $path;
        }

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function adminDashboard()
    {
        $admin = Auth::guard('admin')->user();
        
        // Ambil statistik
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $peminjamanditolak = Peminjaman::where('status_peminjaman', 'Ditolak')->count();
        
        // Ambil pending peminjaman
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.admin', compact('admin', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'peminjamanditolak', 'pendingBookings'));
    }
}
