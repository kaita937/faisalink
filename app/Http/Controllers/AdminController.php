<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
    public function rejectBooking($id)
    {
        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::findOrFail($id);

        $booking->update([
            'status_peminjaman' => 'Ditolak',
            'id_admin' => $admin->id_admin,
        ]);

        return redirect()->back()->with('success', 'Peminjaman telah ditolak.');
    }
}
