<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking User</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking-view.css') }}">

</head>
<body>
    <x-user-nav search-input-id="searchInput" />


    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Your Schedule</h1>
            <p>Keep an eye on your upcoming events and review past bookings easily.</p>
    </div>

    <div class = "filter-section">
        <div class="filter-tabs">
            <button type="button" class="filter-btn active" data-category="all">All</button>
            <button type="button" class="filter-btn" data-category="upcoming">Upcoming</button>
            <button type="button" class="filter-btn" data-category="past">Past</button>
            <button type="button" class="filter-btn" data-category="cancelled">Cancelled</button>
        </div>

    </div>


 <div class="booking-grid">

    @foreach($upcomingBookings as $booking)
        <div class="booking-card" data-category="upcoming">
            <div class="card-header">
                <div>
                    <h3>{{ $booking->fasilitas->nama_fasilitas }}</h3>
                    <p>ID : BK - {{ $booking->id_peminjaman }}</p>
                </div>
                <!-- Status Badge -->
                @if($booking->status_peminjaman == 'pending')
                    <div class="badge badge-pending"><div class="dot"></div>Pending</div>
                @else
                    <div class="badge badge-approved"><div class="dot"></div>Approved</div>
                @endif
            </div>

            <div class="card-body">
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>{{ $booking->tanggal_peminjaman }}</span>
                </div>
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"></circle>
                        <polyline points="12 7 12 12 16 14"></polyline>
                    </svg>
                    <span>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                </div>
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 21s-7-6.2-7-11a7 7 0 1 1 14 0c0 4.8-7 11-7 11z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span>{{ $booking->fasilitas->lokasi_fasilitas }}</span>
                </div>
            </div>

            <div class="card-footer">
                <form action="{{ route('booking.destroy', $booking->id_peminjaman) }}" method="POST" onsubmit="return confirm('Hapus booking ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-red">Cancel</button>
                </form>
            </div>
        </div>
    @endforeach


    @foreach($pastBookings as $booking)
        <div class="booking-card" data-category="past">

             <div class="card-header">
                <div>
                    <h3>{{ $booking->fasilitas->nama_fasilitas }}</h3>
                    <p>ID : BK - {{ $booking->id_peminjaman }}</p>
                </div>
                <div class="badge badge-past"><div class="dot"></div>Past</div>
            </div>

            <div class="card-body">
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>{{ $booking->tanggal_peminjaman }}</span>
                </div>
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"></circle>
                        <polyline points="12 7 12 12 16 14"></polyline>
                    </svg>
                    <span>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                </div>
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 21s-7-6.2-7-11a7 7 0 1 1 14 0c0 4.8-7 11-7 11z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span>{{ $booking->fasilitas->lokasi_fasilitas }}</span>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($cancelledBookings as $booking)
        <div class="booking-card" data-category="cancelled">

            <div class="card-header">
                <div class="badge" style="background:#fee2e2; color:#ef4444;"><div class="dot" style="background:#ef4444;"></div>Cancelled</div>
                <div>
                    <h3>{{ $booking->fasilitas->nama_fasilitas }}</h3>
                    <p>ID : BK - {{ $booking->id_peminjaman }}</p>
                </div>
                <!-- Status Badge -->
                @if($booking->status_peminjaman == 'pending')
                    <div class="badge badge-pending"><div class="dot"></div>Pending</div>
                @else
                    <div class="badge badge-approved"><div class="dot"></div>Approved</div>
                @endif
            </div>

            <div class="card-body">
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>{{ $booking->tanggal_peminjaman }}</span>
                </div>
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"></circle>
                        <polyline points="12 7 12 12 16 14"></polyline>
                    </svg>
                    <span>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                </div>
                <div class="info-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 21s-7-6.2-7-11a7 7 0 1 1 14 0c0 4.8-7 11-7 11z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span>{{ $booking->fasilitas->lokasi_fasilitas }}</span>
                </div>
            </div>
        </div>
    @endforeach

        </div>
</div>
    
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const bookingCards = document.querySelectorAll('.booking-card');
        const notificationToggle = document.getElementById('notificationToggle');
        const notificationPanel = document.getElementById('notificationPanel');
        const notificationCount = document.getElementById('notificationCount');
        const notificationMarkAll = document.getElementById('notificationMarkAll');
        const notificationList = document.getElementById('notificationList');

        filterButtons.forEach((button) => {
            button.addEventListener('click', () => {
                filterButtons.forEach((btn) => btn.classList.remove('active'));
                button.classList.add('active');

                const category = button.dataset.category;

                bookingCards.forEach((card) => {
                    const cardCategory = card.dataset.category;
                    const show = category === 'all' || cardCategory === category;
                    card.style.display = show ? '' : 'none';
                });
            });
        });

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
                    item.classList.add('read');
                    updateNotificationCount();
                }
            });
        }

        if (notificationMarkAll) {
            notificationMarkAll.addEventListener('click', function(event) {
                event.preventDefault();
                if (!notificationList) {
                    return;
                }
                notificationList.querySelectorAll('.notification-item').forEach(item => {
                    item.classList.add('read');
                });
                updateNotificationCount();
            });
        }

        updateNotificationCount();
    });
</script>
</body>
</html>