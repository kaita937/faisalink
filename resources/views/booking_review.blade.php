<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Booking</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking-review.css') }}">
</head>
<body>
    <x-user-nav search-input-id="searchInput" />

    <div class="main-container">
        <div class="page-header">
            <h1>Review Booking</h1>
            <p>Berikan rating dan komentar untuk pengalaman peminjaman Anda.</p>
        </div>

        <div class="review-card">
            <div class="review-info">
                <div>
                    <h2>{{ $booking->fasilitas->nama_fasilitas }}</h2>
                    <p>ID : BK - {{ $booking->id_peminjaman }}</p>
                </div>
                <div class="review-meta">
                    <div>{{ $booking->tanggal_peminjaman }}</div>
                    <div>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</div>
                    <div>{{ $booking->fasilitas->lokasi_fasilitas }}</div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ $review ? route('booking.review.update', $booking->id_peminjaman) : route('booking.review.store', $booking->id_peminjaman) }}">
                @csrf
                @if ($review)
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="rating">Rating (1-5)</label>
                    <select id="rating" name="rating" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ (int) old('rating', $review->rating ?? 0) === $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="komentar">Komentar</label>
                    <textarea id="komentar" name="komentar" rows="5" required>{{ old('komentar', $review->komentar ?? '') }}</textarea>
                </div>

                <div class="form-actions">
                    <a class="btn btn-outline-blue" href="{{ route('booking_view') }}">Back</a>
                    <button type="submit" class="btn btn-solid-blue">
                        {{ $review ? 'Update Review' : 'Submit Review' }}
                    </button>
                </div>
            </form>

            @if ($review)
                <form method="POST" action="{{ route('booking.review.destroy', $booking->id_peminjaman) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-red" data-confirm="Hapus review ini?">Delete Review</button>
                </form>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('button[data-confirm]').forEach((button) => {
                button.addEventListener('click', () => {
                    const message = button.getAttribute('data-confirm');
                    if (message && !window.confirm(message)) {
                        return;
                    }

                    const form = button.closest('form');
                    if (form) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
