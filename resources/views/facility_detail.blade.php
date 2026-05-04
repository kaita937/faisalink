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
    <header>
        <div class="header-container">
            <a href="{{ route('dashboard.user') }}" class="logo-section">
                <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
                <span>Faisalink</span>
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('dashboard.user') }}">Home</a></li>
                <li><a href="{{ route('facility') }}" class="active">Facilities</a></li>

                <li><a href="{{ route('booking_view') }}">Booking</a></li>

                <li><a href="{{ route('profile') }}">Profile</a></li>

            </ul>
            <div style="display: flex; gap: 12px; align-items: center;">
                @php
                    $notifications = $notifications ?? collect();
                    $unreadCount = $unreadCount ?? $notifications->whereNull('read_at')->count();
                @endphp
                <div class="notification-wrapper">
                    <button class="notification-icon" id="notificationToggle" type="button" aria-label="Notifications">
                        &#128276;
                        <span class="notification-badge" id="notificationCount" style="display: {{ $unreadCount > 0 ? 'inline-flex' : 'none' }};">{{ $unreadCount }}</span>
                    </button>
                    <div class="notification-panel" id="notificationPanel">
                        <div class="notification-header">
                            <div class="notification-title">Notification</div>
                            <button class="notification-action" id="notificationMarkAll" type="button">Mark all as read</button>
                        </div>
                        <div class="notification-list" id="notificationList">
                            @forelse ($notifications as $notification)
                                @php
                                    $type = $notification->type ?? 'info';
                                    $isRead = !empty($notification->read_at);
                                    $notificationUrl = $notification->url ?: '#';
                                @endphp
                                <a href="{{ $notificationUrl }}" class="notification-item {{ $type }} {{ $isRead ? 'read' : '' }}" data-id="{{ $notification->id }}">
                                    <div class="notification-icon-bubble {{ $type }}">
                                        @if ($type === 'success')
                                            &#10003;
                                        @elseif ($type === 'warning')
                                            &#9200;
                                        @else
                                            &#8505;
                                        @endif
                                    </div>
                                    <div class="notification-text">
                                        <h4>{{ $notification->title ?? 'Update' }}</h4>
                                        <p>{{ $notification->message ?? '-' }}</p>
                                        <div class="notification-time">{{ optional($notification->created_at)->diffForHumans() ?? 'baru saja' }}</div>
                                    </div>
                                </a>
                            @empty
                                <div class="notification-empty">Belum ada notifikasi.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
                        <div class="info-value" style="color: #ffaa00;">&#9733; 4.8 / 5.0</div>
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
