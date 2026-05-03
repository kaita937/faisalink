<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Faisalink</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard-peminjam.css') }}">
    <style>
        :root {
            --primary: #1f6dff;
            --accent: #ffb020;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f5f7fb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
        }

        .page {
            max-width: 980px;
            margin: 0 auto;
            padding: 24px 20px 60px;
            display: grid;
            gap: 20px;
        }

        .profile-card {
            background: white;
            border-radius: 18px;
            border: 1px solid var(--border);
            padding: 22px;
            display: grid;
            gap: 18px;
        }

        .profile-top {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 18px;
            align-items: center;
        }

        .avatar {
            width: 74px;
            height: 74px;
            border-radius: 22px;
            background: #f0f4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--primary);
            font-size: 1.2rem;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name h1 {
            font-size: 1.25rem;
            margin-bottom: 4px;
        }

        .profile-name p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .status-pill {
            padding: 6px 12px;
            border-radius: 999px;
            background: #e6f7ed;
            color: #137a3c;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .info-list {
            display: grid;
            gap: 12px;
            border-top: 1px solid var(--border);
            padding-top: 16px;
        }

        .info-item {
            display: grid;
            grid-template-columns: 32px 1fr;
            gap: 12px;
            align-items: center;
            color: var(--text-muted);
            font-size: 0.88rem;
        }

        .info-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 14px;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .stat-card p {
            font-size: 0.78rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .form-card {
            background: white;
            border-radius: 18px;
            border: 1px solid var(--border);
            padding: 20px;
            display: grid;
            gap: 14px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1rem;
        }


        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .form-field {
            display: grid;
            gap: 6px;
        }

        .form-field label {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .form-field input {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border-radius: 14px;
            border: 1px solid #f87171;
            color: #b91c1c;
            background: #fff1f2;
            font-weight: 600;
            text-decoration: none;
        }

        .alert-success {
            background: #ecfdf3;
            border: 1px solid #c7f2d5;
            color: #116437;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .dropdown-content {
            display: none;
            padding: 10px 20px;
            background: #f9f9f9;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid var(--border);
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-arrow {
            transition: transform 0.3s;
        }

        .dropdown-arrow.rotated {
            transform: rotate(90deg);
        }

        .dropdown-text {
            font-size: 0.9rem;
            color: var(--text-dark);
        }

        .dropdown-text h4 {
            margin-bottom: 8px;
            font-weight: 600;
        }

        .dropdown-text p {
            margin-bottom: 6px;
        }

        @media (max-width: 860px) {
            .profile-top {
                grid-template-columns: 1fr;
                justify-items: start;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @php
        $fullName = $user->nama_peminjam ?? 'Peminjam';
        $nameParts = preg_split('/\s+/', trim($fullName));
        $initials = '';
        foreach (array_slice($nameParts, 0, 2) as $part) {
            if ($part !== '') {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }
    @endphp

    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="{{ route('landing') }}" class="logo-section">
                <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
                <span>Faisalink</span>
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('dashboard.user') }}">Home</a></li>
                <li><a href="{{ route('facility') }}">Facilities</a></li>
                <li><a href="{{ route('booking_view') }}">Booking</a></li>
                <li><a href="{{ route('profile') }}" class="active">Profile</a></li>
            </ul>
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="search-box">
                    <span class="search-icon">&#128269;</span>
                    <input type="text" placeholder="Search Facilities...">
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
                                        <h4>{{ $notification['title'] ?? 'Update' }}</h4>
                                        <p>{{ $notification['message'] ?? '-' }}</p>
                                        <div class="notification-time">{{ $notification['time'] ?? 'baru saja' }}</div>
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

    <div class="main-container">
        <main class="page">
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

        <section class="profile-card">
            <div class="profile-top">
                <div class="avatar" id="avatarPreview">
                    @if (!empty($user->avatar_path))
                        <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="Avatar" id="avatarImage">
                    @else
                        <span id="avatarFallback">{{ $initials }}</span>
                    @endif
                </div>
                <div class="profile-name">
                    <h1>{{ $fullName }}</h1>
                    <p>Student ID : {{ $user->username ?? '-' }}</p>
                </div>
                <span class="status-pill">Active Member</span>
            </div>
            <div class="info-list">
                <div class="info-item">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 7H20" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M8 3H16" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            <rect x="4" y="7" width="16" height="14" rx="3" stroke="#6b7280" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span>{{ $programInfo }}</span>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 7L12 13L20 7" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="4" y="5" width="16" height="14" rx="3" stroke="#6b7280" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span>{{ $user->email ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 5C4.45 5 4 5.45 4 6C4 15.39 8.61 20 18 20C18.55 20 19 19.55 19 19V16.5C19 16.2 18.85 15.93 18.6 15.78L16.3 14.38C16.07 14.24 15.78 14.22 15.53 14.32L13.57 15.11C12.54 14.51 11.49 13.46 10.89 12.43L11.68 10.47C11.78 10.22 11.76 9.93 11.62 9.7L10.22 7.4C10.07 7.15 9.8 7 9.5 7H7C6.45 7 6 6.55 6 6C6 5.45 5.55 5 5 5Z" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span>{{ $user->contact ?? '-' }}</span>
                </div>
            </div>
        </section>

        <section class="stats">
            <div class="stat-card">
                <h3>{{ $totalBooking }}</h3>
                <p>Total booking</p>
            </div>
            <div class="stat-card">
                <h3>{{ $monthlyBooking }}</h3>
                <p>This month</p>
            </div>
            <div class="stat-card">
                <h3>{{ $canceledBooking }}</h3>
                <p>Canceled</p>
            </div>
        </section>

        <section class="form-card">
            <div class="section-title">Edit Profile</div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-field">
                        <label for="nama_peminjam">Nama lengkap</label>
                        <input type="text" id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam', $user->nama_peminjam ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label for="username">Student ID</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label for="contact">Nomor telepon</label>
                        <input type="text" id="contact" name="contact" value="{{ old('contact', $user->contact ?? '') }}">
                    </div>
                    <div class="form-field">
                        <label for="avatarInput">Upload foto profil</label>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*">
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </section>

        <section class="settings-card">
            <div class="section-title">Settings</div>
            <div class="settings-item" onclick="toggleDropdown('terms-dropdown')">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 6H17" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M7 12H17" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M7 18H13" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span>Term and condition</span>
                </div>
                <span class="dropdown-arrow" id="terms-arrow">&gt;</span>
            </div>
            <div class="dropdown-content" id="terms-dropdown">
                <div class="dropdown-text">
                    <h4>Syarat dan Ketentuan Faisalink</h4>
                    <p>Selamat datang di Faisalink, platform peminjaman fasilitas kampus. Dengan menggunakan layanan ini, Anda setuju untuk mematuhi semua aturan yang berlaku.</p>
                    <p>Pengguna wajib menggunakan fasilitas dengan bertanggung jawab dan mengembalikan dalam kondisi baik. Pelanggaran dapat dikenai sanksi sesuai kebijakan kampus.</p>
                    <p>Faisalink berhak mengubah syarat dan ketentuan ini kapan saja tanpa pemberitahuan sebelumnya.</p>
                </div>
            </div>
            <div class="settings-item" onclick="toggleDropdown('help-dropdown')">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="9" stroke="#6b7280" stroke-width="1.5"/>
                            <path d="M12 16V12" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            <circle cx="12" cy="8" r="1" fill="#6b7280"/>
                        </svg>
                    </div>
                    <span>Help and FAQ</span>
                </div>
                <span class="dropdown-arrow" id="help-arrow">&gt;</span>
            </div>
            <div class="dropdown-content" id="help-dropdown">
                <div class="dropdown-text">
                    <h4>Bantuan dan FAQ</h4>
                    <p><strong>Bagaimana cara memesan fasilitas?</strong> Masuk ke akun Anda, pilih fasilitas, dan ikuti langkah-langkah pemesanan.</p>
                    <p><strong>Apa yang harus dilakukan jika pemesanan ditolak?</strong> Hubungi admin melalui menu Contact Admin untuk penjelasan lebih lanjut.</p>
                    <p><strong>Bagaimana mengubah profil?</strong> Pergi ke halaman Profile dan edit informasi Anda di bagian Edit Profile.</p>
                </div>
            </div>
            <div class="settings-item" onclick="toggleDropdown('notification-dropdown')">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9C6 6.239 8.239 4 11 4H13C15.761 4 18 6.239 18 9V14C18 16.761 15.761 19 13 19H11C8.239 19 6 16.761 6 14" stroke="#6b7280" stroke-width="1.5"/>
                            <path d="M4 12H8" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span>Notification setting</span>
                </div>
                <span class="dropdown-arrow" id="notification-arrow">&gt;</span>
            </div>
            <div class="dropdown-content" id="notification-dropdown">
                <div class="dropdown-text">
                    <h4>Pengaturan Notifikasi</h4>
                    <p>Aktifkan notifikasi email untuk pembaruan pemesanan.</p>
                    <p>Aktifkan notifikasi push untuk pengingat check-in.</p>
                    <p>Nonaktifkan notifikasi untuk hari libur.</p>
                </div>
            </div>
            <div class="settings-item" onclick="toggleDropdown('privacy-dropdown')">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9V7C6 4.791 7.791 3 10 3H14C16.209 3 18 4.791 18 7V9" stroke="#6b7280" stroke-width="1.5"/>
                            <rect x="5" y="9" width="14" height="12" rx="3" stroke="#6b7280" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span>Privacy setting</span>
                </div>
                <span class="dropdown-arrow" id="privacy-arrow">&gt;</span>
            </div>
            <div class="dropdown-content" id="privacy-dropdown">
                <div class="dropdown-text">
                    <h4>Pengaturan Privasi</h4>
                    <p>Jaga kerahasiaan data pribadi Anda. Faisalink tidak membagikan informasi tanpa izin.</p>
                    <p>Anda dapat menghapus akun kapan saja melalui menu Contact Admin.</p>
                    <p>Pastikan kata sandi Anda kuat dan unik.</p>
                </div>
            </div>
            <div class="settings-item" onclick="toggleDropdown('contact-dropdown')">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 7C7 9.761 9.239 12 12 12C14.761 12 17 9.761 17 7" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M4 20C4 16.134 7.134 13 11 13H13C16.866 13 20 16.134 20 20" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span>Contact admin</span>
                </div>
                <span class="dropdown-arrow" id="contact-arrow">&gt;</span>
            </div>
            <div class="dropdown-content" id="contact-dropdown">
                <div class="dropdown-text">
                    <h4>Hubungi Admin</h4>
                    <p>Email: budi@admin.com</p>
                    <p>Telepon: +62 858-3855-7954</p>
                    <p>Jam kerja: Senin-Jumat, 08:00-17:00</p>
                </div>
            </div>
        </section>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Log out</button>
        </form>
        </main>
    </div>

    <script>
        // Profile avatar upload
        const avatarInput = document.getElementById('avatarInput');
        const avatarPreview = document.getElementById('avatarPreview');
        const avatarImage = document.getElementById('avatarImage');
        const avatarFallback = document.getElementById('avatarFallback');

        if (avatarInput) {
            avatarInput.addEventListener('change', function() {
                const file = avatarInput.files && avatarInput.files[0];
                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    if (!avatarImage) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.id = 'avatarImage';
                        if (avatarFallback) avatarFallback.remove();
                        avatarPreview.innerHTML = '';
                        avatarPreview.appendChild(img);
                    } else {
                        avatarImage.src = event.target.result;
                    }
                };
                reader.readAsDataURL(file);
            });
        }

        // Notification functionality (from dashboard)
        document.addEventListener('DOMContentLoaded', function() {
            const notificationToggle = document.getElementById('notificationToggle');
            const notificationPanel = document.getElementById('notificationPanel');
            const notificationCount = document.getElementById('notificationCount');
            const notificationMarkAll = document.getElementById('notificationMarkAll');
            const notificationList = document.getElementById('notificationList');

            function updateNotificationCount() {
                if (!notificationCount || !notificationList) return;
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
                        item.classList.add('read');
                        updateNotificationCount();
                    }
                });
            }

            if (notificationMarkAll) {
                notificationMarkAll.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (!notificationList) return;
                    notificationList.querySelectorAll('.notification-item').forEach(item => item.classList.add('read'));
                    updateNotificationCount();
                });
            }

            updateNotificationCount();
        });

        function toggleDropdown(id) {
            const content = document.getElementById(id);
            const arrow = document.getElementById(id.replace('-dropdown', '-arrow'));
            if (content.classList.contains('show')) {
                content.classList.remove('show');
                arrow.classList.remove('rotated');
            } else {
                content.classList.add('show');
                arrow.classList.add('rotated');
            }
        }
    </script>
</body>
</html>
