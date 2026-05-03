<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
        }

        .topbar {
            background: white;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
        }

        .logo img {
            width: 36px;
            height: 36px;
        }

        .icon-button {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
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

        .settings-card,
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

        .settings-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            color: var(--text-dark);
            text-decoration: none;
        }

        .settings-item:last-child {
            border-bottom: none;
        }

        .settings-left {
            display: flex;
            align-items: center;
            gap: 12px;
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

    <header class="topbar">
        <a href="{{ route('dashboard.user') }}" class="logo">
            <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
            <span>Faisalink</span>
        </a>
        <button class="icon-button" type="button" aria-label="Notifications">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3C9.238 3 7 5.238 7 8V11.4C7 11.85 6.88 12.29 6.65 12.68L5.55 14.5C5.13 15.2 5.64 16.07 6.44 16.07H17.56C18.36 16.07 18.87 15.2 18.45 14.5L17.35 12.68C17.12 12.29 17 11.85 17 11.4V8C17 5.238 14.762 3 12 3Z" stroke="#1f6dff" stroke-width="1.5"/>
                <path d="M9.5 18C9.85 19.16 10.85 20 12 20C13.15 20 14.15 19.16 14.5 18" stroke="#1f6dff" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </button>
    </header>

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
            <a class="settings-item" href="#">
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
                <span>&gt;</span>
            </a>
            <a class="settings-item" href="#">
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
                <span>&gt;</span>
            </a>
            <a class="settings-item" href="#">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9C6 6.239 8.239 4 11 4H13C15.761 4 18 6.239 18 9V14C18 16.761 15.761 19 13 19H11C8.239 19 6 16.761 6 14" stroke="#6b7280" stroke-width="1.5"/>
                            <path d="M4 12H8" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span>Notification setting</span>
                </div>
                <span>&gt;</span>
            </a>
            <a class="settings-item" href="#">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9V7C6 4.791 7.791 3 10 3H14C16.209 3 18 4.791 18 7V9" stroke="#6b7280" stroke-width="1.5"/>
                            <rect x="5" y="9" width="14" height="12" rx="3" stroke="#6b7280" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <span>Privacy setting</span>
                </div>
                <span>&gt;</span>
            </a>
            <a class="settings-item" href="#">
                <div class="settings-left">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 7C7 9.761 9.239 12 12 12C14.761 12 17 9.761 17 7" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M4 20C4 16.134 7.134 13 11 13H13C16.866 13 20 16.134 20 20" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span>Contact admin</span>
                </div>
                <span>&gt;</span>
            </a>
        </section>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Log out</button>
        </form>
    </main>

    <script>
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
                        img.id = 'avatarImage';
                        img.src = event.target.result;
                        if (avatarFallback) {
                            avatarFallback.remove();
                        }
                        avatarPreview.innerHTML = '';
                        avatarPreview.appendChild(img);
                    } else {
                        avatarImage.src = event.target.result;
                    }
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
</body>
</html>
