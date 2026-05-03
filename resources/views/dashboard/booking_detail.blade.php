<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan - Faisalink Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard-booking-detail.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <a href="{{ route('dashboard.admin') }}" class="logo-section">
            <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
            <span>Faisalink Admin</span>
        </a>
        <div class="admin-info">
            <span>Welcome, {{ $admin->nama_admin }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-logout" style="padding: 6px 12px; font-size: 0.9rem;">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <a href="{{ route('dashboard.admin') }}" class="back-link">
            <span>&larr;</span> Kembali ke Dashboard
        </a>

        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #28a745;">
                {{ session('success') }}
            </div>
        @endif

        <div class="detail-card">
            <div class="card-header">
                <h2>Detail Pengajuan Peminjaman</h2>
                <span class="status-badge">{{ $booking->status_peminjaman }}</span>
            </div>

            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <h4>Nama Peminjam</h4>
                        <p>{{ $booking->peminjam->nama_peminjam }}</p>
                    </div>
                    <div class="info-item">
                        <h4>NIM / NIP</h4>
                        <p>{{ $booking->peminjam->nomor_identitas ?? '-' }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Fasilitas</h4>
                        <p>{{ $booking->fasilitas->nama_fasilitas }}</p>
                    </div>
                    <div class="info-item">
                        <h4>Lokasi Fasilitas</h4>
                        <p>{{ $booking->fasilitas->lokasi_fasilitas }}</p>
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
                        <p>{{ $booking->keperluan }}</p>
                    </div>
                </div>

                @if($booking->administrasi_peminjaman)
                <div class="proposal-box">
                    <div class="proposal-info">
                        <div class="proposal-icon">📄</div>
                        <div class="proposal-text">
                            <h4>Dokumen Surat Permohonan / Proposal</h4>
                            <p>Silakan periksa dokumen sebelum meneruskan atau menyetujui pengajuan.</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $booking->administrasi_peminjaman) }}" target="_blank" class="btn btn-outline">Buka Dokumen</a>
                </div>
                @endif

                @if($booking->status_peminjaman === 'Pending')
                <div class="action-section">
                    
                    @php
                        $nomorWaSarpras = "6285838557954"; 
                        $linkDokumen = $booking->administrasi_peminjaman ? asset('storage/' . $booking->administrasi_peminjaman) : 'Tidak ada dokumen';
                        
                        $pesanWa = "Halo Bapak/Ibu Petugas Sarpras,%0A%0A"
                                 . "Terdapat pengajuan peminjaman fasilitas baru yang telah saya periksa kelengkapannya:%0A%0A"
                                 . "Nama Peminjam: *" . $booking->peminjam->nama_peminjam . "*%0A"
                                 . "Fasilitas: *" . $booking->fasilitas->nama_fasilitas . "*%0A"
                                 . "Tanggal: *" . \Carbon\Carbon::parse($booking->tanggal_peminjaman)->format('d/m/Y') . "*%0A"
                                 . "Waktu: *" . substr($booking->jam_mulai, 0, 5) . " - " . substr($booking->jam_selesai, 0, 5) . " WIB*%0A"
                                 . "Keperluan: " . $booking->keperluan . "%0A%0A"
                                 . "Link Dokumen: " . $linkDokumen . "%0A%0A"
                                 . "Mohon arahannya apakah pengajuan ini dapat *Disetujui* atau *Ditolak*. Terima kasih.";
                    @endphp

                    <div class="wa-action">
                        <p>Langkah 1: Teruskan detail pengajuan ini ke WhatsApp Petugas Sarpras untuk meminta persetujuan.</p>
                        <a href="https://wa.me/{{ $nomorWaSarpras }}?text={{ $pesanWa }}" target="_blank" class="btn btn-wa">
                            💬 Teruskan ke WA Sarpras
                        </a>
                    </div>

                    <div style="text-align: center; margin: 15px 0;">
                        <span style="color: #999; font-size: 0.9rem;">— Langkah 2: Setelah mendapat balasan dari Sarpras —</span>
                    </div>

                    <div class="final-actions">
                        <form action="{{ route('admin.booking.approve', $booking->id_peminjaman) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-approve" onclick="return confirm('Apakah Anda yakin Sarpras sudah MENYETUJUI pengajuan ini?');">✓ Setujui Pengajuan</button>
                        </form>
                        <form action="{{ route('admin.booking.reject', $booking->id_peminjaman) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-reject" onclick="return confirm('Apakah Anda yakin Sarpras MENOLAK pengajuan ini?');">✕ Tolak Pengajuan</button>
                        </form>
                    </div>

                </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
