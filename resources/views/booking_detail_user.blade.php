<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - Faisalink</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking-detail-user.css') }}">
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
                <li><a href="{{ route('facility') }}">Facilities</a></li>
                <li><a href="{{ route('booking_view') }}" class="active">Booking</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
            </ul>
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="search-box">
                    <span class="search-icon">&#128269;</span>
                    <input type="text" placeholder="Search Facilities...">
                </div>
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

    <!-- Main Content -->
    <div class="main-container">
        <a href="{{ route('booking_view') }}" class="back-link">
            <span>&larr;</span> Kembali ke Booking
        </a>

        @php
            $status = strtolower($booking->status_peminjaman ?? 'pending');
            $statusClass = match ($status) {
                'disetujui', 'approved' => 'status-approved',
                'ditolak', 'rejected' => 'status-rejected',
                'dibatalkan', 'cancelled' => 'status-cancelled',
                'selesai', 'done' => 'status-done',
                default => 'status-pending',
            };
        @endphp

        <div class="detail-card">
            <div class="card-header">
                <h2>Detail Booking</h2>
                <span class="status-badge {{ $statusClass }}">{{ $booking->status_peminjaman }}</span>
            </div>

            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <h4>Nama Peminjam</h4>
                        <p>{{ $booking->peminjam->nama_peminjam ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>NIM / NIP</h4>
                        <p>{{ $booking->peminjam->nomor_identitas ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Fasilitas</h4>
                        <p>{{ $booking->fasilitas->nama_fasilitas ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Lokasi Fasilitas</h4>
                        <p>{{ $booking->fasilitas->lokasi_fasilitas ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Tanggal Peminjaman</h4>
                        <p>{{ \Carbon\Carbon::parse($booking->tanggal_peminjaman)->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Waktu Peminjaman</h4>
                        <p>{{ substr($booking->jam_mulai, 0, 5) }} WIB - {{ substr($booking->jam_selesai, 0, 5) }} WIB</p>
                    </div>
                    <div class="info-item full-width">
                        <h4>Keperluan / Kegiatan</h4>
                        <p>{{ $booking->keperluan ?? '-' }}</p>
                    </div>
                </div>

                @if($booking->administrasi_peminjaman)
                <div class="proposal-box">
                    <div class="proposal-info">
                        <div class="proposal-icon">&#128196;</div>
                        <div class="proposal-text">
                            <h4>Dokumen Surat Permohonan / Proposal</h4>
                            <p>Berikut dokumen pengajuan Anda.</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $booking->administrasi_peminjaman) }}" target="_blank" class="btn btn-outline">Buka Dokumen</a>
                </div>
                @if($booking->status_peminjaman === 'Ditolak' && $booking->alasan_penolakan)
                <div style="margin-top: 25px; padding: 15px; background-color: #fff5f5; border-radius: 8px; border: 1px solid #feb2b2;">
                    <h4 style="color: #c53030; margin-bottom: 8px; font-size: 1.1rem;">Alasan Penolakan:</h4>
                    <p style="color: #742a2a; line-height: 1.5;">{{ $booking->alasan_penolakan }}</p>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>

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
