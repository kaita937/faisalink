<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo-section">
            <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
            <span>Faisalink Admin</span>
        </div>
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
        <h1>📊 Admin Dashboard</h1>

        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #28a745;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Peminjaman</h3>
                <div class="number">{{ $totalPeminjaman }}</div>
            </div>
            <div class="stat-card pending">
                <h3>Menunggu Persetujuan</h3>
                <div class="number">{{ $peminjamanbaru }}</div>
            </div>
            <div class="stat-card approved">
                <h3>Disetujui</h3>
                <div class="number">{{ $peminjamanditerima }}</div>
            </div>
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
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System | Admin Panel</p>
    </footer>
</body>
</html>
