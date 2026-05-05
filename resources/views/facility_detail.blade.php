<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fasilitas->nama_fasilitas }} - Faisalink</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/facility-detail.css') }}">
</head>
<body>
    <!-- Header -->
    <x-user-nav showSearch="true" />


    @php
        $statusClass = match(strtolower($fasilitas->status_fasilitas)) {
            'tersedia' => 'badge-available',
            'dipinjam', 'booked' => 'badge-booked',
            'maintenance', 'perbaikan' => 'badge-maintenance',
            default => 'badge-available'
        };

        $statusText = match(strtolower($fasilitas->status_fasilitas)) {
            'tersedia' => 'Available',
            'dipinjam', 'booked' => 'Booked',
            'maintenance', 'perbaikan' => 'Maintenance',
            default => 'Available'
        };
    @endphp

    <!-- Main Content -->
    <div class="main-container">
        <a href="{{ route('facility') }}" class="back-link">
            <span>&larr;</span> Back to Facilities
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <div class="detail-icon">
                    &#127970;
                </div>
                <div class="detail-title">
                    <h1>{{ $fasilitas->nama_fasilitas }}</h1>
                    <p>{{ $fasilitas->lokasi_fasilitas }}</p>
                </div>
            </div>

            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Capacity</div>
                        <div class="info-value">&#128100; {{ $fasilitas->kapasitas ?? 'Not specified' }} People</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Location</div>
                        <div class="info-value">&#128205; {{ $fasilitas->lokasi_fasilitas }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Rating</div>
                        <div class="info-value">
                            @if(($reviewsCount ?? 0) > 0)
                                <span class="rating-score">{{ number_format($averageRating, 1) }} / 5</span>
                                <span class="rating-count">({{ $reviewsCount }} review)</span>
                            @else
                                <span class="rating-empty">No ratings yet</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="section-title">Description</div>
                <div class="description">
                    {{ $fasilitas->deskripsi ?? 'No description available for this facility.' }}
                </div>

                <div class="section-title">Equipment / Facilities</div>
                @if($fasilitas->perlengkapan && $fasilitas->perlengkapan->count() > 0)
                    <ul class="equipment-list">
                        @foreach($fasilitas->perlengkapan as $item)
                            <li class="equipment-item">
                                &#10004; {{ $item->nama_perlengkapan }}
                                <span class="qty">{{ $item->jumlah ?? 1 }}x</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p style="color: #888; font-style: italic;">No specific equipment listed for this facility.</p>
                @endif

                <div class="section-title"><br>Daftar Booking yang Disetujui</div>
                @if(isset($approvedBookings) && $approvedBookings->count() > 0)
                    <div class="approved-booking-list">
                        @foreach($approvedBookings as $booking)
                            <div class="approved-booking-item">
                                <div class="booking-avatar">
                                    @if($booking->peminjam && $booking->peminjam->avatar_path)
                                        <img src="{{ asset('storage/' . $booking->peminjam->avatar_path) }}" alt="{{ $booking->peminjam->nama_peminjam ?? 'User' }}">
                                    @else
                                        <div class="avatar-placeholder">{{ substr($booking->peminjam->nama_peminjam ?? 'U', 0, 1) }}</div>
                                    @endif
                                </div>
                                <div class="booking-info">
                                    <div class="booking-name">{{ $booking->peminjam->nama_peminjam ?? 'Pengguna' }}</div>
                                    <div class="booking-identity">{{ $booking->peminjam->nomor_identitas ?? '-' }}</div>
                                    <div class="booking-date">
                                        <span class="date-icon">📅</span>
                                        {{ \Carbon\Carbon::parse($booking->tanggal_peminjaman)->translatedFormat('l, d F Y') }}
                                    </div>
                                    <div class="booking-time">
                                        <span class="time-icon">⏰</span>
                                        {{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }} WIB
                                    </div>
                                    @if($booking->keperluan)
                                    <div class="booking-purpose">
                                        <span class="purpose-icon">📝</span>
                                        {{ $booking->keperluan }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: #888; font-style: italic;">Belum ada booking yang disetujui untuk fasilitas ini.</p>
                @endif

                <div class="section-title">Rating & Review</div>
                @if(isset($reviews) && $reviews->count() > 0)
                    <div class="review-list">
                        @foreach($reviews as $review)
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-name">{{ $review->peminjam->nama_peminjam ?? 'Pengguna' }}</div>
                                    <div class="review-rating">{{ $review->rating }} / 5</div>
                                </div>
                                <div class="review-date">{{ optional($review->created_at)->translatedFormat('d M Y') }}</div>
                                <div class="review-comment">{{ $review->komentar }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: #888; font-style: italic;">Belum ada rating atau review untuk fasilitas ini.</p>
                @endif

                <div class="booking-action">
                    @if(strtolower($fasilitas->status_fasilitas) == 'tersedia')
                        <a href="{{ route('booking.form', $fasilitas->id_fasilitas) }}" class="btn-book">Book This Facility</a>
                    @else
                        <button class="btn-book disabled" disabled>Currently Unavailable</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System</p>
        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 15px;">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationToggle = document.getElementById('notificationToggle');
            const notificationPanel = document.getElementById('notificationPanel');
            const notificationCount = document.getElementById('notificationCount');
            const notificationMarkAll = document.getElementById('notificationMarkAll');
            const notificationList = document.getElementById('notificationList');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            function updateNotificationCount() {
                if (!notificationCount || !notificationList) {
                    return;
                }

                const unreadItems = notificationList.querySelectorAll('.notification-item:not(.read)');
                const unreadCount = unreadItems.length;
                notificationCount.textContent = unreadCount;
                notificationCount.style.display = unreadCount > 0 ? 'inline-flex' : 'none';
            }

            if (notificationToggle && notificationPanel) {
                notificationToggle.addEventListener('click', function(event) {
                    event.stopPropagation();
                    notificationPanel.classList.toggle('open');
                });

                document.addEventListener('click', function(event) {
                    if (!notificationPanel.contains(event.target) && !notificationToggle.contains(event.target)) {
                        notificationPanel.classList.remove('open');
                    }
                });
            }

            if (notificationList) {
                notificationList.addEventListener('click', function(event) {
                    const item = event.target.closest('.notification-item');
                    if (item) {
                        const notificationId = item.dataset.id;
                        const targetUrl = item.getAttribute('href');
                        if (!notificationId || !csrfToken) {
                            return;
                        }

                        event.preventDefault();
                        fetch(`/notifications/${notificationId}/read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        }).finally(() => {
                            item.classList.add('read');
                            updateNotificationCount();
                            if (targetUrl && targetUrl !== '#') {
                                window.location.href = targetUrl;
                            }
                        });
                    }
                });
            }

            if (notificationMarkAll) {
                notificationMarkAll.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (!notificationList || !csrfToken) {
                        return;
                    }
                    fetch('/notifications/read-all', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }).finally(() => {
                        notificationList.querySelectorAll('.notification-item').forEach(item => {
                            item.classList.add('read');
                        });
                        updateNotificationCount();
                    });
                });
            }

            updateNotificationCount();
        });
    </script>
</body>
</html>
