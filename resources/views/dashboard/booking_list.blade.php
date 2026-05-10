<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman - Faisalink Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}?v={{ time() }}">
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

    <div class="main-container">
        <h1>Daftar Peminjaman</h1>

        <div class="filters">
            <a class="filter-link {{ $status === 'all' ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">Semua</a>
            <a class="filter-link {{ $status === 'Pending' ? 'active' : '' }}" href="{{ route('admin.bookings.index', ['status' => 'Pending']) }}">Pending</a>
            <a class="filter-link {{ $status === 'Disetujui' ? 'active' : '' }}" href="{{ route('admin.bookings.index', ['status' => 'Disetujui']) }}">Disetujui</a>
            <a class="filter-link {{ $status === 'Ditolak' ? 'active' : '' }}" href="{{ route('admin.bookings.index', ['status' => 'Ditolak']) }}">Ditolak</a>
        </div>

        <div class="requests-section">
            @if($bookings->count() > 0)
                <div class="request-list">
                    @foreach($bookings as $booking)
                        @php
                            $badgeClass = '';
                            if ($booking->status_peminjaman === 'Pending') {
                                $badgeClass = 'pending';
                            } elseif ($booking->status_peminjaman === 'Menghubungi Sarpras') {
                                $badgeClass = 'contacting';
                            } elseif ($booking->status_peminjaman === 'Disetujui') {
                                $badgeClass = 'approved';
                            } elseif ($booking->status_peminjaman === 'Ditolak') {
                                $badgeClass = 'rejected';
                            }
                        @endphp
                        <div class="request-item">
                            <div class="request-info">
                                <h3>{{ $booking->peminjam->nama_peminjam }} - {{ $booking->fasilitas->nama_fasilitas }}</h3>
                                <p><strong>Status:</strong> <span class="status-badge {{ $badgeClass }}">{{ $booking->status_peminjaman }}</span></p>
                                <p><strong>Keperluan:</strong> {{ $booking->keperluan }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal_peminjaman)->format('d/m/Y') }}@if($booking->tanggal_selesai && $booking->tanggal_selesai != $booking->tanggal_peminjaman) - {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d/m/Y') }}@endif | <strong>Waktu:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
                                <p><strong>Lokasi:</strong> {{ $booking->fasilitas->lokasi_fasilitas }}</p>
                                @if($booking->administrasi_peminjaman)
                                    <p><a href="{{ asset('storage/' . $booking->administrasi_peminjaman) }}" target="_blank" style="color:#2e66ff; text-decoration:none; font-weight:600;">Lihat Proposal</a></p>
                                @endif
                            </div>
                            <div class="request-actions">
                                <a href="{{ route('admin.booking.detail', $booking->id_peminjaman) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 40px; color: #999;">
                    <p>Tidak ada peminjaman untuk filter ini.</p>
                </div>
            @endif
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System | Admin Panel</p>
    </footer>
</body>
</html>
