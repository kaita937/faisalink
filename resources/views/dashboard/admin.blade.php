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

        .admin-nav {
            display: flex;
            gap: 20px;
        }

        .nav-link {
            color: #2e66ff;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .nav-link:hover {
            background-color: #f0f4ff;
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

        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-8 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .inline-block {
            display: inline-block;
        }

        .text-3xl {
            font-size: 2rem;
            line-height: 1.2;
        }

        .font-bold {
            font-weight: 700;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .shadow-md {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .rounded-lg {
            border-radius: 1rem;
        }

        .rounded {
            border-radius: 0.75rem;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .min-w-full {
            min-width: 100%;
        }

        .table-auto {
            width: 100%;
            border-collapse: collapse;
        }

        .table-auto th,
        .table-auto td {
            padding: 0.95rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        .bg-gray-50 {
            background-color: #f9fafb;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .font-medium {
            font-weight: 600;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .text-blue-600 {
            color: #2563eb;
        }

        .text-red-600 {
            color: #dc2626;
        }

        .text-red-900 {
            color: #7f1d1d;
        }

        .bg-blue-500 {
            background-color: #2563eb;
        }

        .bg-gray-500 {
            background-color: #6b7280;
        }

        .hover\:bg-blue-700:hover {
            background-color: #1d4ed8;
        }

        .hover\:bg-gray-700:hover {
            background-color: #4b5563;
        }

        .text-white {
            color: #ffffff;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .focus\:outline-none:focus {
            outline: none;
        }

        .focus\:shadow-outline:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4);
        }

        .border {
            border: 1px solid #d1d5db;
        }

        .border-green-400 {
            border-color: #4ade80;
        }

        .text-green-700 {
            color: #047857;
        }

        .bg-green-100 {
            background-color: #d1fae5;
        }

        .w-full {
            width: 100%;
        }

        .shadow {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .inline {
            display: inline;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .appearance-none {
            appearance: none;
        }

        .leading-tight {
            line-height: 1.25;
        }

        .text-gray-700 {
            color: #374151;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: #374151;
            background-color: #fff;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .form-card {
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border-radius: 1rem;
            padding: 1.5rem;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #2563eb;
            color: #ffffff;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            text-decoration: none;
            font-weight: 700;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #6b7280;
            color: #ffffff;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            text-decoration: none;
            font-weight: 700;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .text-blue-900:hover,
        .text-red-900:hover {
            opacity: 0.8;
        }

        .bg-white .text-gray-700,
        .bg-white .text-xs {
            color: inherit;
        }

        .divide-y > * + * {
            border-top: 1px solid #e5e7eb;
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
        <nav class="admin-nav">
            <a href="{{ route('dashboard.admin') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('admin.facilities.index') }}" class="nav-link">Fasilitas</a>
            <a href="{{ route('admin.equipment.index') }}" class="nav-link">Perlengkapan</a>
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
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System | Admin Panel</p>
    </footer>
</body>
</html>
