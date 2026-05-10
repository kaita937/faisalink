<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking {{ $fasilitas->nama_fasilitas }} - Faisalink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="{{ route('dashboard.user') }}" class="logo-section">
                <img src="{{ asset('Icon/logo.png') }}" alt="Faisalink">
                <span>Faisalink</span>
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('dashboard.user') }}">Home</a></li>
                <li><a href="{{ route('facility') }}">Facilities</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <a href="{{ route('facility.detail', $fasilitas->id_fasilitas) }}" class="back-link">
            <span>&larr;</span> Back to Facility Detail
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1>Formulir Peminjaman</h1>
                <p>Isi detail peminjaman Anda dengan lengkap dan benar.</p>
            </div>

            <div class="form-body">
                @if(session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('booking.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="id_fasilitas" value="{{ $fasilitas->id_fasilitas }}">

                    <div class="form-group">
                        <label class="form-label">Fasilitas yang Dipinjam</label>
                        <input type="text" class="form-control" value="{{ $fasilitas->nama_fasilitas }} ({{ $fasilitas->lokasi_fasilitas }})" readonly>
                    </div>

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label" for="tanggal_peminjaman">Tanggal Mulai</label>
                            <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" value="{{ old('tanggal_peminjaman') }}" required min="{{ date('Y-m-d') }}">
                            @error('tanggal_peminjaman')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}" required min="{{ date('Y-m-d') }}">
                            @error('tanggal_selesai')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="form-group">
                            <label class="form-label" for="jam_mulai">Jam Mulai</label>
                            <select name="jam_mulai" id="jam_mulai" class="form-control" required>
                                <option value="" disabled selected hidden>Pilih Jam Mulai</option>
                                @for ($i = 7; $i <= 20; $i++)
                                    @php $jam = sprintf('%02d:00', $i); @endphp
                                    <option value="{{ $jam }}" {{ old('jam_mulai') == $jam ? 'selected' : '' }}>{{ $jam }}</option>
                                @endfor
                            </select>
                            @error('jam_mulai')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jam_selesai">Jam Selesai</label>
                            <select name="jam_selesai" id="jam_selesai" class="form-control" required>
                                <option value="" disabled selected hidden>Pilih Jam Selesai</option>
                                @for ($i = 7; $i <= 20; $i++)
                                    @php $jam = sprintf('%02d:00', $i); @endphp
                                    <option value="{{ $jam }}" {{ old('jam_selesai') == $jam ? 'selected' : '' }}>{{ $jam }}</option>
                                @endfor
                            </select>
                            @error('jam_selesai')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="keperluan">Keperluan / Deskripsi Kegiatan</label>
                        <textarea name="keperluan" id="keperluan" class="form-control" placeholder="Jelaskan tujuan peminjaman fasilitas ini..." required>{{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Surat Permohonan / Proposal (Wajib)</label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="administrasi_peminjaman" id="administrasi_peminjaman" class="file-upload-input" accept=".pdf,.doc,.docx" required>
                            <div class="file-upload-text" id="file-name-display">
                                <span>&#128194;</span> Pilih file (PDF, DOC, DOCX - Maks 2MB)
                            </div>
                        </div>
                        @error('administrasi_peminjaman')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">Kirim Pengajuan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Faisalink - Smart Facility Booking System</p>
    </footer>

    <script>
        document.getElementById('administrasi_peminjaman').addEventListener('change', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : "Pilih file (PDF, DOC, DOCX - Maks 2MB)";
            document.getElementById('file-name-display').innerHTML = "<span>&#128194;</span> " + fileName;
        });
    </script>
</body>
</html>
