<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Review_Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private function getBookingForReview(int $bookingId): Peminjaman
    {
        $userId = Auth::guard('peminjam')->id();

        return Peminjaman::with(['fasilitas', 'review'])
            ->where('id_peminjaman', $bookingId)
            ->where('id_peminjam', $userId)
            ->where('status_peminjaman', 'Selesai')
            ->firstOrFail();
    }

    public function form(int $bookingId)
    {
        $booking = $this->getBookingForReview($bookingId);
        $review = $booking->review;

        return view('booking_review', compact('booking', 'review'));
    }

    public function store(Request $request, int $bookingId)
    {
        $booking = $this->getBookingForReview($bookingId);

        if ($booking->review) {
            return redirect()->route('booking.review.form', $bookingId);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:2000'
        ]);

        Review_Fasilitas::create([
            'id_peminjaman' => $booking->id_peminjaman,
            'id_fasilitas' => $booking->id_fasilitas,
            'id_peminjam' => $booking->id_peminjam,
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar']
        ]);

        return redirect()->route('booking_view')->with('success', 'Review berhasil disimpan.');
    }

    public function update(Request $request, int $bookingId)
    {
        $booking = $this->getBookingForReview($bookingId);
        $review = $booking->review;

        if (!$review) {
            abort(404);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:2000'
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar']
        ]);

        return redirect()->route('booking_view')->with('success', 'Review berhasil diperbarui.');
    }

    public function destroy(int $bookingId)
    {
        $booking = $this->getBookingForReview($bookingId);
        $review = $booking->review;

        if ($review) {
            $review->delete();
        }

        return redirect()->route('booking_view')->with('success', 'Review berhasil dihapus.');
    }
}
