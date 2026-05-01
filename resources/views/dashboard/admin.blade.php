<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header */
        header {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 900;
            color: #2e66ff;
        }

        .logo-section img {
            width: 40px;
            height: 40px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-info span {
            font-weight: 500;
            color: #555;
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px;
        }

        h1 {
            font-size: 2.5rem;
            color: #2e66ff;
            margin-bottom: 30px;
        }

        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #2e66ff;
        }

        .stat-card h3 {
            font-size: 0.9rem;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .stat-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2e66ff;
        }

        .stat-card.pending {
            border-left-color: #ffaa00;
        }

        .stat-card.pending .number {
            color: #ffaa00;
        }

        .stat-card.approved {
            border-left-color: #34a853;
        }

        .stat-card.approved .number {
            color: #34a853;
        }

        /* Pending Requests Section */
        .requests-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .requests-section h2 {
            font-size: 1.5rem;
            color: #2e66ff;
            margin-bottom: 20px;
        }

        .request-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .request-item {
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 8px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 20px;
            align-items: center;
            transition: background-color 0.2s;
        }

        .request-item:hover {
            background-color: #f9f9f9;
        }

        .request-info h3 {
            font-size: 1rem;
            margin-bottom: 8px;
            color: #333;
        }

        .request-info p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
        }

        .request-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-approve {
            background-color: #34a853;
            color: white;
        }

        .btn-approve:hover {
            background-color: #2d8e47;
        }

        .btn-reject {
            background-color: #d93025;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c5221f;
        }

        .btn-logout {
            background-color: #ffaa00;
            color: black;
            margin-left: 10px;
        }

        .btn-logout:hover {
            background-color: #e69900;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            color: #999;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .request-item {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
