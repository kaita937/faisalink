<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking {{ $fasilitas->nama_fasilitas }} - Faisalink</title>
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
        }

        .nav-links a:hover {
            color: #2e66ff;
        }

        /* Main Container */
        .main-container {
            max-width: 800px;
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

        .form-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #2e66ff 0%, #1a52e0 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .form-header p {
            font-size: 1.05rem;
            opacity: 0.9;
        }

        .form-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            color: #333;
            transition: all 0.2s;
            background-color: #fcfcfc;
        }

        .form-control:focus {
            outline: none;
            border-color: #2e66ff;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(46, 102, 255, 0.1);
        }

        .form-control[readonly] {
            background-color: #f0f0f0;
            color: #777;
            cursor: not-allowed;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23a3a3a3%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 15px top 50%;
            background-size: 10px auto;
            cursor: pointer;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 16px;
            background-color: #ffaa00;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(255, 170, 0, 0.3);
            margin-top: 30px;
        }

        .btn-submit:hover {
            background-color: #e69900;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 170, 0, 0.4);
        }

        .error-message {
            color: #d93025;
            font-size: 0.85rem;
            margin-top: 5px;
            font-weight: 500;
        }

        .alert-error {
            background-color: #fce8e6;
            color: #d93025;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #d93025;
        }

        .file-upload-wrapper {
            position: relative;
            width: 100%;
            height: 60px;
            border: 2px dashed #ccc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fafafa;
            overflow: hidden;
            transition: all 0.2s;
        }

        .file-upload-wrapper:hover {
            border-color: #2e66ff;
            background-color: #f0f4ff;
        }

        .file-upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-upload-text {
            color: #666;
            font-weight: 500;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 10px;
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
            .grid-2 {
                grid-template-columns: 1fr;
            }
            .form-body {
                padding: 30px 20px;
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

                    <div class="form-group">
                        <label class="form-label" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" value="{{ old('tanggal_peminjaman') }}" required min="{{ date('Y-m-d') }}">
                        @error('tanggal_peminjaman')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
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
