<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan - Faisalink Admin</title>
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
            text-decoration: none;
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
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header {
            background-color: #2e66ff;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 1.25rem;
            margin: 0;
        }

        .status-badge {
            background-color: #ffaa00;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .info-item h4 {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-item p {
            font-size: 1.05rem;
            color: #333;
            font-weight: 500;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .proposal-box {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .proposal-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .proposal-icon {
            font-size: 2rem;
        }

        .proposal-text h4 {
            margin: 0 0 5px 0;
            color: #333;
        }

        .proposal-text p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid #2e66ff;
            color: #2e66ff;
        }

        .btn-outline:hover {
            background-color: #2e66ff;
            color: white;
        }

        .action-section {
            border-top: 1px solid #eee;
            padding-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .wa-action {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            padding: 25px;
            background-color: #f0fdf4;
            border-radius: 10px;
            border: 1px dashed #25d366;
        }

        .wa-action p {
            color: #166534;
            font-weight: 500;
            text-align: center;
        }

        .btn-wa {
            background-color: #25d366;
            color: white;
            font-size: 1.1rem;
            padding: 12px 30px;
        }

        .btn-wa:hover {
            background-color: #1ea952;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        .final-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
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

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .proposal-box {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .final-actions {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
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
