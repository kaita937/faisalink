<?php

namespace App\Http\Controllers;


use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\View\View;

class BookingViewController extends Controller
{
    use HasFactory;
    public function bookingInfo()
    {
        $userId = auth('peminjam')->id(); 

        $upcomingBookings = Peminjaman::with('fasilitas')
            ->where('id_peminjam', $userId)
            ->whereIn('status_peminjaman', ['Pending', 'Disetujui'])
            ->orderBy('tanggal_peminjaman', 'asc') // Urutkan dari jadwal terdekat
            ->get();

        $pastBookings = Peminjaman::with(['fasilitas', 'review'])
            ->where('id_peminjam', $userId)
            ->where('status_peminjaman', 'Selesai')
            ->orderBy('tanggal_peminjaman', 'desc') // Urutkan dari yang paling baru selesai
            ->get();

        $cancelledBookings = Peminjaman::with('fasilitas')
            ->where('id_peminjam', $userId)
            ->whereIn('status_peminjaman', ['Dibatalkan', 'Ditolak'])
            ->orderBy('tanggal_peminjaman', 'desc')
            ->get();

        return view('booking_view', compact(
            'upcomingBookings', 
            'pastBookings', 
            'cancelledBookings'
        ));
    }

    public function destroy($id)
    {
        $userId = auth('peminjam')->id();

        $booking = Peminjaman::where('id_peminjaman', $id)
            ->where('id_peminjam', $userId)
            ->firstOrFail();

        $booking->status_peminjaman = 'Dibatalkan';
        $booking->save();

        return redirect()->route('booking_view');
    }

    public function detail($id)
    {
        $userId = auth('peminjam')->id();

        $booking = Peminjaman::with(['fasilitas', 'peminjam'])
            ->where('id_peminjaman', $id)
            ->where('id_peminjam', $userId)
            ->firstOrFail();

        return view('booking_detail_user', compact('booking'));
    }

    
}

