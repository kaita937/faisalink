<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}?v={{ time() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false,
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="{{ route('dashboard.admin') }}" class="logo-section">
            <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
            <span>Faisalink Admin</span>
        </a>
        <nav class="admin-nav">
            <a href="{{ route('dashboard.admin') }}" class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.facilities.index') }}" class="nav-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}">Fasilitas</a>
            <a href="{{ route('admin.equipment.index') }}" class="nav-link {{ request()->routeIs('admin.equipment.*') ? 'active' : '' }}">Perlengkapan</a>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">User</a>
        </nav>
        <div class="admin-info">
            <span>Welcome, {{ $admin->nama_admin }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        @hasSection('content')
            @yield('content')
        @else
            <h1>📊 Admin Dashboard</h1>

            <!-- Flash Messages handled by SweetAlert2 -->

            <!-- Stats -->
            <div class="stats-grid">
                <a class="stat-card-link" href="{{ route('admin.bookings.index') }}">
                    <div class="stat-card">
                        <h3>Total Peminjaman</h3>
                        <div class="number">{{ $totalPeminjaman }}</div>
                        <span class="stat-action">Lihat Detail →</span>
                    </div>
                </a>
                <a class="stat-card-link" href="{{ route('admin.bookings.index', ['status' => 'Pending']) }}">
                    <div class="stat-card pending">
                        <h3>Menunggu Persetujuan</h3>
                        <div class="number">{{ $peminjamanbaru }}</div>
                        <span class="stat-action">Lihat Detail →</span>
                    </div>
                </a>
                <a class="stat-card-link" href="{{ route('admin.bookings.index', ['status' => 'Disetujui']) }}">
                    <div class="stat-card approved">
                        <h3>Disetujui</h3>
                        <div class="number">{{ $peminjamanditerima }}</div>
                        <span class="stat-action">Lihat Detail →</span>
                    </div>
                </a>
                <a class="stat-card-link" href="{{ route('admin.bookings.index', ['status' => 'Ditolak']) }}">
                    <div class="stat-card rejected">
                        <h3>Ditolak</h3>
                        <div class="number">{{ $peminjamanditolak }}</div>
                        <span class="stat-action">Lihat Detail →</span>
                    </div>
                </a>
                <a class="stat-card-link" href="{{ route('admin.facilities.index') }}">
                    <div class="stat-card">
                        <h3>Total Fasilitas</h3>
                        <div class="number">{{ $totalFasilitas }}</div>
                        <span class="stat-action">Lihat Detail →</span>
                    </div>
                </a>
                <a class="stat-card-link" href="{{ route('admin.equipment.index') }}">
                    <div class="stat-card">
                        <h3>Total Perlengkapan</h3>
                        <div class="number">{{ $totalPerlengkapan }}</div>
                        <span class="stat-action">Lihat Detail →</span>
                    </div>
                </a>
            </div>

            <!-- Pending Requests -->
            <div class="requests-section">
                <h2>⏳ Permintaan Peminjaman Menunggu</h2>
                @if($pendingBookings->count() > 0)
                    <div class="request-list">
                        @foreach($pendingBookings as $booking)
                        <div class="request-item">
                            <div class="request-info">
                                <h3>{{ $booking->peminjam->nama_peminjam }} - {{ $booking->fasilitas->nama_fasilitas }}</h3>
                                <p><strong>Keperluan:</strong> {{ $booking->keperluan }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal_peminjaman)->format('d/m/Y') }} | <strong>Waktu:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
                                <p><strong>Lokasi:</strong> {{ $booking->fasilitas->lokasi_fasilitas }}</p>
                                @if($booking->administrasi_peminjaman)
                                    <p><a href="{{ asset('storage/' . $booking->administrasi_peminjaman) }}" target="_blank" style="color:#2e66ff; text-decoration:none; font-weight:600;">&#128194; Lihat Proposal</a></p>
                                @endif
                            </div>
                            <div class="request-actions">
                                <a href="{{ route('admin.booking.detail', $booking->id_peminjaman) }}" class="btn" style="background-color: #2e66ff; color: white;">Lihat Detail</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px; color: #999;">
                        <p>Tidak ada permintaan peminjaman yang menunggu persetujuan</p>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System | Admin Panel</p>
    </footer>
    <!-- SweetAlert2 Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            @endif

            // Handle confirmation for any element with data-confirm
            document.body.addEventListener('click', function(e) {
                const confirmEl = e.target.closest('[data-confirm]');
                if (confirmEl) {
                    e.preventDefault();
                    const message = confirmEl.getAttribute('data-confirm') || 'Apakah Anda yakin?';
                    const form = confirmEl.closest('form');
                    
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2e66ff',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (form) {
                                form.submit();
                            } else if (confirmEl.tagName === 'A') {
                                window.location.href = confirmEl.href;
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
