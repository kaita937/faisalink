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
            ->whereIn('status_peminjaman', ['pending', 'disetujui'])
            ->orderBy('tanggal_peminjaman', 'asc') // Urutkan dari jadwal terdekat
            ->get();

        $pastBookings = Peminjaman::with('fasilitas')
            ->where('id_peminjam', $userId)
            ->where('status_peminjaman', 'selesai')
            ->orderBy('tanggal_peminjaman', 'desc') // Urutkan dari yang paling baru selesai
            ->get();

        $cancelledBookings = Peminjaman::with('fasilitas')
            ->where('id_peminjam', $userId)
            ->whereIn('status_peminjaman', ['dibatalkan', 'ditolak'])
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

        $booking->status_peminjaman = 'dibatalkan';
        $booking->save();

        return redirect()->route('booking_view');
    }

    
}

