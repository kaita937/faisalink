<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - Faisalink</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/facility.css') }}">
</head>
<body>

    <!-- Header -->
    <x-user-nav search-input-id="searchInput" />
                    </div>
                </div>
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
                <button class="filter-btn" data-category="library">Library</button>
                <button class="filter-btn" data-category="studio">Studio</button>
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
                    } elseif (str_contains($nama, 'library') || str_contains($nama, 'perpustakaan')) {
                        $kategori = 'library';
                    } elseif (str_contains($nama, 'studio')) {
                        $kategori = 'studio';
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
                                @if(($f->reviews_count ?? 0) > 0)
                                    <span>{{ number_format($f->average_rating, 1) }}</span>
                                @else
                                    <span>-</span>
                                @endif
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
            const notificationToggle = document.getElementById('notificationToggle');
            const notificationPanel = document.getElementById('notificationPanel');
            const notificationCount = document.getElementById('notificationCount');
            const notificationMarkAll = document.getElementById('notificationMarkAll');
            const notificationList = document.getElementById('notificationList');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

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

            const urlParams = new URLSearchParams(window.location.search);
            const initialCategory = "{{ $initialCategory ?? '' }}" || urlParams.get('category');
            const initialSearch = urlParams.get('search') || '';

            if (initialSearch && searchInput) {
                searchInput.value = initialSearch;
            }
            if (initialCategory) {
                const targetBtn = document.querySelector(`.filter-btn[data-category="${initialCategory}"]`);
                if (targetBtn) {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    targetBtn.classList.add('active');
                    filterCards(initialCategory, (searchInput?.value || '').toLowerCase());
                }
            }

            if (initialSearch && !initialCategory) {
                const activeCategory = document.querySelector('.filter-btn.active').dataset.category;
                filterCards(activeCategory, (searchInput?.value || '').toLowerCase());
            }

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

            function updateNotificationCount() {
                if (!notificationCount || !notificationList) {
                    return;
                }

                const unreadItems = notificationList.querySelectorAll('.notification-item:not(.read)');
                const unreadCount = unreadItems.length;
                notificationCount.textContent = unreadCount;
                notificationCount.style.display = unreadCount > 0 ? 'inline-flex' : 'none';
            }

            if (notificationToggle && notificationPanel) {
                notificationToggle.addEventListener('click', function(event) {
                    event.stopPropagation();
                    notificationPanel.classList.toggle('open');
                });

                document.addEventListener('click', function(event) {
                    if (!notificationPanel.contains(event.target) && !notificationToggle.contains(event.target)) {
                        notificationPanel.classList.remove('open');
                    }
                });
            }

            if (notificationList) {
                notificationList.addEventListener('click', function(event) {
                    const item = event.target.closest('.notification-item');
                    if (item) {
                        const notificationId = item.dataset.id;
                        const targetUrl = item.getAttribute('href');
                        if (!notificationId || !csrfToken) {
                            return;
                        }

                        event.preventDefault();
                        fetch(`/notifications/${notificationId}/read`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        }).finally(() => {
                            item.classList.add('read');
                            updateNotificationCount();
                            if (targetUrl && targetUrl !== '#') {
                                window.location.href = targetUrl;
                            }
                        });
                    }
                });
            }

            if (notificationMarkAll) {
                notificationMarkAll.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (!notificationList) {
                        return;
                    }
                    if (!csrfToken) {
                        return;
                    }
                    fetch('/notifications/read-all', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }).finally(() => {
                        notificationList.querySelectorAll('.notification-item').forEach(item => {
                            item.classList.add('read');
                        });
                        updateNotificationCount();
                    });
                });
            }

            updateNotificationCount();
        });
    </script>
</body>
</html>

