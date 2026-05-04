<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Faisalink</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard-peminjam.css') }}">
</head>
<body>
    <!-- Header -->
    <x-user-nav />

    <div class="main-container">
        <!-- Greeting Section -->
        <div class="greeting-section">
            <div class="greeting-text">
                <h1>HI, {{ strtoupper(explode(' ', $user->nama_peminjam)[0]) }}!</h1>
                <p>Good Morning</p>
                <p class="tagline">Smart Way to Book Fasilkom Facilities!</p>
            </div>
            <div class="greeting-image">
                <img src="{{ asset('Icon/gedung.png') }}" alt="Facilities">
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-section">
            <div class="stat-card available">
                <div class="stat-number">{{ $totalFasilitas }}</div>
                <div class="stat-label">Total Vuilding</div>
            </div>
            <div class="stat-card booked">
                <div class="stat-number">{{ $totalBooked }}</div>
                <div class="stat-label">Booked</div>
            </div>
        </div>

        <!-- Categories -->
        <div class="categories-section">
            <div class="section-title">Browse Categories</div>
            <div class="categories-grid">
                <a href="{{ route('facility.category', ['category' => 'laboratory']) }}" class="category-btn">
                    <span class="category-icon">🖥️</span>
                    <span>Laboratory</span>
                </a>
                <a href="{{ route('facility.category', ['category' => 'sport']) }}" class="category-btn">
                    <span class="category-icon">🏀</span>
                    <span>Sport</span>
                </a>
                <a href="{{ route('facility.category', ['category' => 'meeting']) }}" class="category-btn">
                    <span class="category-icon">💬</span>
                    <span>Meeting Room</span>
                </a>
                <a href="{{ route('facility.category', ['category' => 'hall']) }}" class="category-btn">
                    <span class="category-icon">🏛️</span>
                    <span>Auditorium & Hall</span>
                </a>
                <a href="{{ route('facility.category', ['category' => 'library']) }}" class="category-btn">
                    <span class="category-icon">📚</span>
                    <span>Library</span>
                </a>
                <a href="{{ route('facility.category', ['category' => 'studio']) }}" class="category-btn">
                    <span class="category-icon">🎵</span>
                    <span>Studio</span>
                </a>
            </div>
        </div>

        <!-- Upcoming Bookings -->
        <div class="upcoming-section">
            <div class="section-title">Upcoming</div>
            <div class="upcoming-list">
                @if($upcomingBookings->count() > 0)
                    @foreach($upcomingBookings as $booking)
                    <div class="booking-card">
                        <div class="booking-details">
                            <h3>{{ $booking->fasilitas->nama_fasilitas }}</h3>
                            <p>📍 {{ $booking->fasilitas->lokasi_fasilitas }}</p>
                            <p>📅 {{ \Carbon\Carbon::parse($booking->tanggal_peminjaman)->format('Y-m-d') }}</p>
                            <p>⏰ {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
                            <p>📌 {{ $booking->keperluan }}</p>
                        </div>
                        <span class="status-badge status-{{ strtolower(str_replace('ü', 'u', $booking->status_peminjaman)) }}">
                            {{ $booking->status_peminjaman }}
                        </span>
                    </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 40px; color: #999;">
                        <p>Belum ada peminjaman yang akan datang</p>
                        <a href="#" style="color: #2e66ff; text-decoration: none; margin-top: 10px;">Buat peminjaman baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System</p>
        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 15px;">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: white; text-decoration: none;">Logout</a>
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
                    if (!notificationList) {
                        return;
                    }
                    if (!csrfToken) {
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
