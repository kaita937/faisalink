@props([
    'searchInputId' => null
])

<header>
    <div class="header-container">
        <a href="{{ route('landing') }}" class="logo-section">
            <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
            <span>Faisalink</span>
        </a>
        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard.user') }}" class="{{ request()->routeIs('dashboard.user') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('facility') }}" class="{{ request()->routeIs('facility') ? 'active' : '' }}">Facilities</a>
            </li>
            <li>
                <a href="{{ route('booking_view') }}" class="{{ request()->routeIs('booking_view') ? 'active' : '' }}">Booking</a>
            </li>
            <li>
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
            </li>
        </ul>
        <div style="display: flex; gap: 20px; align-items: center;">
            <div class="search-box">
                <span class="search-icon">&#128269;</span>
                <input type="text" placeholder="Search Facilities..." @if($searchInputId) id="{{ $searchInputId }}" @endif>
            </div>
            @php
                $notifications = $notifications ?? [
                    [
                        'type' => 'success',
                        'title' => 'Pengajuan disetujui',
                        'message' => 'Booking Lab Komputer 1 untuk 30 Oktober telah disetujui.',
                        'time' => '2 jam lalu',
                        'read' => false,
                        'url' => '#'
                    ],
                    [
                        'type' => 'info',
                        'title' => 'Review terkirim',
                        'message' => 'Review Anda untuk ruang meeting A telah dikirim.',
                        'time' => '10 jam lalu',
                        'read' => false,
                        'url' => '#'
                    ],
                    [
                        'type' => 'warning',
                        'title' => 'Pengingat',
                        'message' => 'Jangan lupa check-in untuk seminar besok jam 14:00.',
                        'time' => '1 minggu lalu',
                        'read' => true,
                        'url' => '#'
                    ]
                ];
                $unreadCount = 0;
                foreach ($notifications as $item) {
                    if (empty($item['read'])) {
                        $unreadCount++;
                    }
                }
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
                                $type = $notification['type'] ?? 'info';
                                $isRead = !empty($notification['read']);
                            @endphp
                            <a href="{{ $notification['url'] ?? '#' }}" class="notification-item {{ $type }} {{ $isRead ? 'read' : '' }}" data-read="{{ $isRead ? '1' : '0' }}">
                                <div class="notification-dot"></div>
                                <div class="notification-content">
                                    <div class="notification-title-row">
                                        <span class="notification-subject">{{ $notification['title'] ?? 'Notification' }}</span>
                                        <span class="notification-time">{{ $notification['time'] ?? '' }}</span>
                                    </div>
                                    <div class="notification-message">{{ $notification['message'] ?? '' }}</div>
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
