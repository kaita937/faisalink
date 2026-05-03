<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking-detail-user.css') }}">
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
                <li><a href="{{ route('facility') }}">Facilities</a></li>
                <li><a href="{{ route('booking_view') }}" class="active">Booking</a></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
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
        <a href="{{ route('booking_view') }}" class="back-link">
            <span>&larr;</span> Kembali ke Booking
        </a>

        @php
            $status = strtolower($booking->status_peminjaman ?? 'pending');
            $statusClass = match ($status) {
                'disetujui', 'approved' => 'status-approved',
                'ditolak', 'rejected' => 'status-rejected',
                'dibatalkan', 'cancelled' => 'status-cancelled',
                'selesai', 'done' => 'status-done',
                default => 'status-pending',
            };
        @endphp

        <div class="detail-card">
            <div class="card-header">
                <h2>Detail Booking</h2>
                <span class="status-badge {{ $statusClass }}">{{ $booking->status_peminjaman }}</span>
            </div>

            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <h4>Nama Peminjam</h4>
                        <p>{{ $booking->peminjam->nama_peminjam ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>NIM / NIP</h4>
                        <p>{{ $booking->peminjam->nomor_identitas ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Fasilitas</h4>
                        <p>{{ $booking->fasilitas->nama_fasilitas ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Lokasi Fasilitas</h4>
                        <p>{{ $booking->fasilitas->lokasi_fasilitas ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Tanggal Peminjaman</h4>
                        <p>{{ \Carbon\Carbon::parse($booking->tanggal_peminjaman)->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Waktu Peminjaman</h4>
                        <p>{{ substr($booking->jam_mulai, 0, 5) }} WIB - {{ substr($booking->jam_selesai, 0, 5) }} WIB</p>
                    </div>
                    <div class="info-item full-width">
                        <h4>Keperluan / Kegiatan</h4>
                        <p>{{ $booking->keperluan ?? '-' }}</p>
                    </div>
                </div>

                @if($booking->administrasi_peminjaman)
                <div class="proposal-box">
                    <div class="proposal-info">
                        <div class="proposal-icon">&#128196;</div>
                        <div class="proposal-text">
                            <h4>Dokumen Surat Permohonan / Proposal</h4>
                            <p>Berikut dokumen pengajuan Anda.</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $booking->administrasi_peminjaman) }}" target="_blank" class="btn btn-outline">Buka Dokumen</a>
                </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
