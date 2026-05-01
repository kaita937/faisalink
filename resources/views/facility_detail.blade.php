<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fasilitas->nama_fasilitas }} - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
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

        /* Main Container */
        .main-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 40px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #2e66ff;
        }

        .detail-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .detail-header {
            background: linear-gradient(135deg, #2e66ff 0%, #1a52e0 100%);
            color: white;
            padding: 40px;
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .detail-icon {
            font-size: 4rem;
            background: rgba(255,255,255,0.2);
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
        }

        .detail-title h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .detail-title p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .detail-body {
            padding: 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .info-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #eee;
        }

        .info-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #222;
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-available { background-color: #d4edda; color: #155724; }
        .badge-booked { background-color: #f8d7da; color: #721c24; }
        .badge-maintenance { background-color: #fff3cd; color: #856404; }

        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #222;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .description {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #555;
            margin-bottom: 40px;
        }

        .equipment-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .equipment-item {
            background: #fff;
            border: 1.5px solid #e0e0e0;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: #444;
            transition: all 0.2s;
        }

        .equipment-item:hover {
            border-color: #2e66ff;
            color: #2e66ff;
            background: #f0f4ff;
            transform: translateY(-2px);
        }

        .equipment-item span.qty {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-left: auto;
        }

        .booking-action {
            margin-top: 50px;
            text-align: center;
        }

        .btn-book {
            display: inline-block;
            padding: 16px 40px;
            background-color: #ffaa00;
            color: white;
            text-decoration: none;
            border-radius: 9999px;
            font-size: 1.1rem;
            font-weight: 700;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(255, 170, 0, 0.3);
            border: none;
            cursor: pointer;
        }

        .btn-book:hover {
            background-color: #e69900;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 170, 0, 0.4);
        }

        .btn-book:disabled, .btn-book.disabled {
            background-color: #ccc;
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }

        /* Footer */
        footer {
            background: #6c757d;
            color: white;
            padding: 40px;
            text-align: center;
            margin-top: 60px;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .detail-header {
                flex-direction: column;
                text-align: center;
                padding: 30px 20px;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
            .detail-title h1 {
                font-size: 2rem;
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
                <li><a href="{{ route('dashboard.user') }}">Home</a></li>
                <li><a href="{{ route('facility') }}" class="active">Facilities</a></li>
                <li><a href="#booking">Booking</a></li>
                <li><a href="#profile">Profile</a></li>
            </ul>
        </div>
    </header>

    @php
        $statusClass = match(strtolower($fasilitas->status_fasilitas)) {
            'tersedia' => 'badge-available',
            'dipinjam', 'booked' => 'badge-booked',
            'maintenance', 'perbaikan' => 'badge-maintenance',
            default => 'badge-available'
        };

        $statusText = match(strtolower($fasilitas->status_fasilitas)) {
            'tersedia' => 'Available',
            'dipinjam', 'booked' => 'Booked',
            'maintenance', 'perbaikan' => 'Maintenance',
            default => 'Available'
        };
    @endphp

    <!-- Main Content -->
    <div class="main-container">
        <a href="{{ route('facility') }}" class="back-link">
            <span>&larr;</span> Back to Facilities
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <div class="detail-icon">
                    &#127970;
                </div>
                <div class="detail-title">
                    <h1>{{ $fasilitas->nama_fasilitas }}</h1>
                    <p>{{ $fasilitas->lokasi_fasilitas }}</p>
                </div>
            </div>

            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Capacity</div>
                        <div class="info-value">&#128100; {{ $fasilitas->kapasitas ?? 'Not specified' }} People</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Location</div>
                        <div class="info-value">&#128205; {{ $fasilitas->lokasi_fasilitas }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Rating</div>
                        <div class="info-value" style="color: #ffaa00;">&#9733; 4.8 / 5.0</div>
                    </div>
                </div>

                <div class="section-title">Description</div>
                <div class="description">
                    {{ $fasilitas->deskripsi ?? 'No description available for this facility.' }}
                </div>

                <div class="section-title">Equipment / Facilities</div>
                @if($fasilitas->perlengkapan && $fasilitas->perlengkapan->count() > 0)
                    <ul class="equipment-list">
                        @foreach($fasilitas->perlengkapan as $item)
                            <li class="equipment-item">
                                &#10004; {{ $item->nama_perlengkapan }}
                                <span class="qty">{{ $item->jumlah ?? 1 }}x</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p style="color: #888; font-style: italic;">No specific equipment listed for this facility.</p>
                @endif

                <div class="booking-action">
                    @if(strtolower($fasilitas->status_fasilitas) == 'tersedia')
                        <a href="{{ route('booking.form', $fasilitas->id_fasilitas) }}" class="btn-book">Book This Facility</a>
                    @else
                        <button class="btn-book disabled" disabled>Currently Unavailable</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System</p>
        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 15px;">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </footer>
</body>
</html>
