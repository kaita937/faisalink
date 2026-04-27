<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - Faisalink</title>
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

        /* Page Title */
        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #2e66ff;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #666;
            font-size: 1rem;
        }

        /* Filter Tabs */
        .filter-section {
            margin-bottom: 35px;
        }

        .filter-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .filter-btn {
            padding: 8px 22px;
            border: 1.5px solid #ddd;
            background: white;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .filter-btn:hover {
            border-color: #2e66ff;
            color: #2e66ff;
            background-color: #f0f4ff;
        }

        .filter-btn.active {
            background-color: #ffaa00;
            border-color: #ffaa00;
            color: white;
            font-weight: 600;
        }

        .filter-btn.active:hover {
            background-color: #e69900;
            border-color: #e69900;
            color: white;
        }

        /* Facility Grid */
        .facility-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        /* Facility Card */
        .facility-card {
            background: white;
            border: 1.5px solid #ffe082;
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .facility-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }

        .card-body {
            display: flex;
            padding: 20px;
            gap: 16px;
            flex: 1;
        }

        .card-thumbnail {
            width: 90px;
            height: 90px;
            min-width: 90px;
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
        }

        .card-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 4px;
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: #666;
        }

        .card-meta .icon {
            font-size: 0.9rem;
            width: 18px;
            text-align: center;
        }

        .card-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.85rem;
            color: #ffaa00;
            font-weight: 600;
        }

        .card-rating .star {
            color: #ffaa00;
            margin-left: 5px;
        }

        .card-status {
            margin-top: 4px;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-available {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-booked {
            background-color: #f8d7da;
            color: #721c24;
        }

        .badge-maintenance {
            background-color: #fff3cd;
            color: #856404;
        }

        .card-footer {
            padding: 0 20px 20px 20px;
        }

        .btn-detail {
            display: block;
            width: 100%;
            padding: 10px 0;
            background-color: #2e66ff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .btn-detail:hover {
            background-color: #1a52e0;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 8px;
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

        /* Responsive */
        @media (max-width: 1024px) {
            .facility-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-container {
                padding: 16px 20px;
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-links {
                gap: 15px;
                font-size: 0.9rem;
                order: 3;
                width: 100%;
                justify-content: center;
            }

            .search-box {
                width: 160px;
            }

            .main-container {
                padding: 24px 20px;
            }

            .facility-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 1.6rem;
            }

            .filter-tabs {
                gap: 8px;
            }

            .filter-btn {
                padding: 6px 16px;
                font-size: 0.85rem;
            }

            .card-body {
                padding: 16px;
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
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="search-box">
                    <span class="search-icon">&#128269;</span>
                    <input type="text" id="searchInput" placeholder="Search Facilities...">
                </div>
                <div class="notification-icon">&#128276;</div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Our Facilities</h1>
            <p>Browse and book available campus facilities with ease.</p>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-section">
            <div class="filter-tabs">
                <button class="filter-btn active" data-category="all">All</button>
                <button class="filter-btn" data-category="laboratory">Laboratory</button>
                <button class="filter-btn" data-category="sport">Sport</button>
                <button class="filter-btn" data-category="hall">Hall</button>
                <button class="filter-btn" data-category="meeting">Meeting</button>
                <button class="filter-btn" data-category="classroom">Classroom</button>
            </div>
        </div>

        <!-- Facility Grid -->
        <div class="facility-grid" id="facilityGrid">
            @forelse($fasilitas as $f)
                @php
                    $nama = strtolower($f->nama_fasilitas);
                    if (str_contains($nama, 'laboratorium')) {
                        $kategori = 'laboratory';
                    } elseif (str_contains($nama, 'lapangan') || str_contains($nama, 'sport')) {
                        $kategori = 'sport';
                    } elseif (str_contains($nama, 'seminar') || str_contains($nama, 'auditorium') || str_contains($nama, 'hall')) {
                        $kategori = 'hall';
                    } elseif (str_contains($nama, 'meeting')) {
                        $kategori = 'meeting';
                    } elseif (str_contains($nama, 'kelas') || str_contains($nama, 'classroom')) {
                        $kategori = 'classroom';
                    } else {
                        $kategori = 'other';
                    }

                    $statusClass = match(strtolower($f->status_fasilitas)) {
                        'tersedia' => 'badge-available',
                        'dipinjam', 'booked' => 'badge-booked',
                        'maintenance', 'perbaikan' => 'badge-maintenance',
                        default => 'badge-available'
                    };

                    $statusText = match(strtolower($f->status_fasilitas)) {
                        'tersedia' => 'Available',
                        'dipinjam', 'booked' => 'Booked',
                        'maintenance', 'perbaikan' => 'Maintenance',
                        default => 'Available'
                    };
                @endphp
                <div class="facility-card" data-category="{{ $kategori }}" data-name="{{ strtolower($f->nama_fasilitas) }}">
                    <div class="card-body">
                        <div class="card-thumbnail">
                            &#127970;
                        </div>
                        <div class="card-info">
                            <div class="card-title">{{ $f->nama_fasilitas }}</div>
                            <div class="card-meta">
                                <span class="icon">&#128100;</span>
                                <span>{{ $f->kapasitas ?? '-' }} people</span>
                            </div>
                            <div class="card-meta">
                                <span class="icon">&#128205;</span>
                                <span>{{ $f->lokasi_fasilitas }}</span>
                            </div>
                            <div class="card-rating">
                                <span class="star">&#9733;</span>
                                <span>4.8</span>
                            </div>
                            <div class="card-status">
                                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn-detail">Detail</a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">&#127970;</div>
                    <h3>No facilities found</h3>
                    <p>Try adjusting your search or filter criteria.</p>
                </div>
            @endforelse
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const facilityCards = document.querySelectorAll('.facility-card');
            const searchInput = document.getElementById('searchInput');

            // Filter by category
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const category = this.dataset.category;
                    filterCards(category, searchInput.value.toLowerCase());
                });
            });

            // Search filter
            searchInput.addEventListener('input', function() {
                const activeCategory = document.querySelector('.filter-btn.active').dataset.category;
                filterCards(activeCategory, this.value.toLowerCase());
            });

            function filterCards(category, searchTerm) {
                let visibleCount = 0;

                facilityCards.forEach(card => {
                    const cardCategory = card.dataset.category;
                    const cardName = card.dataset.name;

                    const matchCategory = category === 'all' || cardCategory === category;
                    const matchSearch = cardName.includes(searchTerm);

                    if (matchCategory && matchSearch) {
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide empty state
                const grid = document.getElementById('facilityGrid');
                let emptyState = grid.querySelector('.empty-state');

                if (visibleCount === 0) {
                    if (!emptyState) {
                        emptyState = document.createElement('div');
                        emptyState.className = 'empty-state';
                        emptyState.innerHTML = `
                            <div class="empty-state-icon">&#127970;</div>
                            <h3>No facilities found</h3>
                            <p>Try adjusting your search or filter criteria.</p>
                        `;
                        grid.appendChild(emptyState);
                    }
                    emptyState.style.display = '';
                } else if (emptyState) {
                    emptyState.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>

