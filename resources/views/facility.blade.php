<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/facility.css') }}">
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
                <li><a href="{{ route('booking_view') }}">Booking</a></li>
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
                        <a href="{{ route('facility.detail', $f->id_fasilitas) }}" class="btn-detail">Detail</a>
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

