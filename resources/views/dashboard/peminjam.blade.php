<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Faisalink</title>
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

        /* Header Navigation */
        header {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
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
            text-decoration: none;
        }

        .logo-section img {
            width: 40px;
            height: 40px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.2s;
            position: relative;
        }

        .nav-links a:hover {
            color: #2e66ff;
        }

        .nav-links a.active {
            color: #2e66ff;
            font-weight: 700;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #2e66ff;
            border-radius: 2px;
        }

        .search-box {
            position: relative;
            width: 240px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 9999px;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-box input:focus {
            border-color: #2e66ff;
            box-shadow: 0 0 0 3px rgba(46, 102, 255, 0.1);
        }

        .search-box .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 0.95rem;
            pointer-events: none;
        }

        .notification-icon {
            font-size: 1.4rem;
            cursor: pointer;
            color: #555;
            transition: color 0.2s;
        }

        .notification-icon:hover {
            color: #2e66ff;
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px;
        }

        /* Greeting Section */
        .greeting-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            margin-bottom: 60px;
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            padding: 40px;
            border-radius: 12px;
        }

        .greeting-text h1 {
            font-size: 3rem;
            color: #2e66ff;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .greeting-text p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 5px;
        }

        .greeting-text .tagline {
            font-size: 1rem;
            color: #2e66ff;
            font-weight: 600;
        }

        .greeting-image {
            text-align: right;
        }

        .greeting-image img {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        /* Stats Section */
        .stats-section {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            justify-content: center;
        }

        .stat-card {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            min-width: 150px;
        }

        .stat-card.available {
            border: 2px solid #4285f4;
        }

        .stat-card.booked {
            border: 2px solid #34a853;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-card.available .stat-number {
            color: #4285f4;
        }

        .stat-card.booked .stat-number {
            color: #34a853;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Categories Section */
        .categories-section {
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2e66ff;
            margin-bottom: 20px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 15px;
        }

        .category-btn {
            background: white;
            border: 2px solid #ddd;
            padding: 15px 20px;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .category-btn:hover {
            border-color: #2e66ff;
            background-color: #f0f4ff;
            transform: translateY(-2px);
        }

        .category-icon {
            font-size: 2rem;
        }

        /* Upcoming Section */
        .upcoming-section {
            margin-bottom: 60px;
        }

        .upcoming-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .booking-card {
            background: white;
            border-left: 5px solid #ffaa00;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 20px;
            align-items: center;
        }

        .booking-details h3 {
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: #333;
        }

        .booking-details p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Footer */
        footer {
            background: #6c757d;
            color: white;
            padding: 40px;
            text-align: center;
            margin-top: 60px;
        }

        @media (max-width: 768px) {
            .greeting-section {
                grid-template-columns: 1fr;
            }

            .greeting-image {
                text-align: center;
            }

            .greeting-text h1 {
                font-size: 2rem;
            }

            .header-container {
                padding: 16px 20px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .nav-links {
                gap: 15px;
                font-size: 0.9rem;
                order: 3;
                width: 100%;
                justify-content: center;
            }

            .categories-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .booking-card {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="{{ route('landing') }}" class="logo-section">
                <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
                <span>Faisalink</span>
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('dashboard.user') }}" class="active">Home</a></li>
                <li><a href="{{ route('facility') }}">Facilities</a></li>
                <li><a href="#booking">Booking</a></li>
                <li><a href="#profile">Profile</a></li>
            </ul>
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="search-box">
                    <span class="search-icon">&#128269;</span>
                    <input type="text" placeholder="Search Facilities...">
                </div>
                <div class="notification-icon">&#128276;</div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Greeting Section -->
        <div class="greeting-section">
            <div class="greeting-text">
                <h1>HI, {{ strtoupper(explode(' ', $user->nama_peminjam)[0]) }}!</h1>
                <p>Good Morning</p>
                <p class="tagline">Smart Way to Book Fasilkom Facilities!</p>
            </div>
            <div class="greeting-image">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 200'%3E%3Crect fill='%23e0e0e0' width='300' height='200'/%3E%3Ctext x='50%' y='50%' text-anchor='middle' dy='.3em' fill='%23999' font-size='20'%3EFasilitas Gedung%3C/text%3E%3C/svg%3E" alt="Facilities">
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-section">
            <div class="stat-card available">
                <div class="stat-number">{{ $totalAvailable }}</div>
                <div class="stat-label">Available</div>
            </div>
            <div class="stat-card booked">
                <div class="stat-number">{{ $totalBooked }}</div>
                <div class="stat-label">Booked</div>
            </div>
        </div>

        <!-- Categories -->
        <div class="categories-section">
            <div class="section-title">Browse Categories</div>
            <div class="categories-grid">
                <a href="#" class="category-btn">
                    <span class="category-icon">🖥️</span>
                    <span>Laboratory</span>
                </a>
                <a href="#" class="category-btn">
                    <span class="category-icon">🏀</span>
                    <span>Sport</span>
                </a>
                <a href="#" class="category-btn">
                    <span class="category-icon">💬</span>
                    <span>Meeting Room</span>
                </a>
                <a href="#" class="category-btn">
                    <span class="category-icon">🏛️</span>
                    <span>Auditorium & Hall</span>
                </a>
                <a href="#" class="category-btn">
                    <span class="category-icon">📚</span>
                    <span>Library</span>
                </a>
                <a href="#" class="category-btn">
                    <span class="category-icon">🎵</span>
                    <span>Studio</span>
                </a>
            </div>
        </div>

        <!-- Upcoming Bookings -->
        <div class="upcoming-section">
            <div class="section-title">Upcoming</div>
            <div class="upcoming-list">
                @if($upcomingBookings->count() > 0)
                    @foreach($upcomingBookings as $booking)
                    <div class="booking-card">
                        <div class="booking-details">
                            <h3>{{ $booking->fasilitas->nama_fasilitas }}</h3>
                            <p>📍 {{ $booking->fasilitas->lokasi_fasilitas }}</p>
                            <p>📅 {{ \Carbon\Carbon::parse($booking->tanggal_peminjaman)->format('Y-m-d') }}</p>
                            <p>⏰ {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
                            <p>📌 {{ $booking->keperluan }}</p>
                        </div>
                        <span class="status-badge status-{{ strtolower(str_replace('ü', 'u', $booking->status_peminjaman)) }}">
                            {{ $booking->status_peminjaman }}
                        </span>
                    </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 40px; color: #999;">
                        <p>Belum ada peminjaman yang akan datang</p>
                        <a href="#" style="color: #2e66ff; text-decoration: none; margin-top: 10px;">Buat peminjaman baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System</p>
        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 15px;">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: white; text-decoration: none;">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </footer>
</body>
</html>
