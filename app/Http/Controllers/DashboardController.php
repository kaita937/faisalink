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
        $today = now()->toDateString();
        
        // Hitung fasilitas yang benar-benar tersedia (Status 'Tersedia' dan tidak ada peminjaman disetujui hari ini)
        $totalAvailable = Fasilitas_Kampus::where('status_fasilitas', 'Tersedia')
            ->whereNotIn('id_fasilitas', function($query) use ($today) {
                $query->select('id_fasilitas')
                      ->from('Peminjaman')
                      ->where('tanggal_peminjaman', $today)
                      ->where('status_peminjaman', 'Disetujui');
            })
            ->count();
            
        $totalBooked = $totalFasilitas - $totalAvailable;
        
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
        
        // Ambil pending peminjaman
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->where('status_peminjaman', 'Pending')
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.admin', compact('admin', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }
}
