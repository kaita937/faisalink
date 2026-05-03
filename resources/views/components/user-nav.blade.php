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
            
            <!-- Search component (Blade) -->
            @include('components.⚡facility-search', ['searchInputId' => $searchInputId])

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
                $notificationItems = collect($notifications);
                $unreadCount = $notificationItems->filter(function ($item) {
                    $readAt = data_get($item, 'read_at');
                    $readFlag = data_get($item, 'read');
                    return empty($readAt) && empty($readFlag);
                })->count();
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
                        @forelse ($notificationItems as $notification)
                            @php
                                $type = data_get($notification, 'type', 'info');
                                $isRead = !empty(data_get($notification, 'read_at')) || !empty(data_get($notification, 'read'));
                                $notificationUrl = data_get($notification, 'url', '#');
                                $notificationTitle = data_get($notification, 'title', 'Update');
                                $notificationMessage = data_get($notification, 'message', '-');
                                $notificationTime = data_get($notification, 'time');
                                if (empty($notificationTime) && data_get($notification, 'created_at')) {
                                    $notificationTime = optional(data_get($notification, 'created_at'))->diffForHumans();
                                }
                            @endphp
                            <a href="{{ $notificationUrl }}" class="notification-item {{ $type }} {{ $isRead ? 'read' : '' }}" data-id="{{ data_get($notification, 'id') }}">
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
                                    <h4>{{ $notificationTitle }}</h4>
                                    <p>{{ $notificationMessage }}</p>
                                    <div class="notification-time">{{ $notificationTime ?? 'baru saja' }}</div>
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
