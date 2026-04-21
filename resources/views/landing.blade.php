<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faisalink - Facilities Instant Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden; /* Mencegah scroll jika gambar ilustrasi presisi di bawah */
        }

        /* Container untuk Logo dan Text */
        .header-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 15vh; /* Jarak dari atas layar */
            z-index: 10;
        }

        /* Styling untuk logo (Placeholder jika belum ada gambar yang dipotong) */
        .logo-icon {
            width: 110px;
            height: 110px;
            margin-right: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }


        /* Tipografi Teks */
        .text-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-title {
            font-size: 5rem;
            font-weight: 900;
            color: #2e66ff; /* Warna Biru Utama Faisalink */
            margin: 0;
            line-height: 0.9;
            letter-spacing: -2px;
        }

        .brand-subtitle {
            font-size: 2rem;
            font-weight: 400;
            color: #ffaa00; /* Warna Kuning/Orange Faisalink */
            margin: 0;
            margin-top: 5px;
            letter-spacing: -0.5px;
        }

        .btn-start {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 35px;
            background-color: #ffaa00;
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(255, 170, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn-start:hover {
            background-color: #e69900;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 170, 0, 0.4);
        }

        /* Container untuk Ilustrasi Gedung di bawah */
        .illustration-section {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            flex-grow: 1;
        }

        /* Gambar gedung ditaruh di sini */
        .illustration-image {
            width: 100%;
            max-height: 60vh;
            object-fit: cover;
            object-position: bottom;
        }

        /* Responsivitas untuk layar kecil (Mobile) */
        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
                padding-top: 10vh;
                text-align: center;
            }
            .logo-icon {
                margin-right: 0;
                margin-bottom: 20px;
                width: 80px;
                height: 80px;
            }
            .brand-title {
                font-size: 3.5rem;
            }
            .brand-subtitle {
                font-size: 1.4rem;
            }
            .illustration-image {
                max-height: 50vh;
            }
        }
    </style>
</head>
<body>

    <!-- Bagian Atas: Logo dan Teks -->
    <header class="header-section">
        <div class="logo-icon">
            <img src="/faisalink/public/Icon/logo.png" alt="Logo Faisalink">
        </div>
        
        <div class="text-container">
            <h1 class="brand-title">Faisalink</h1>
            <h2 class="brand-subtitle">Facilities Instant Access</h2>
            <div>
                <a href="{{ route('login') }}" class="btn-start">Get Started / Login</a>
            </div>
        </div>
    </header>

    <!-- Bagian Bawah: Ilustrasi Gedung -->
    <main class="illustration-section">
        <img src="/faisalink/public/Icon/building.png" alt="Ilustrasi Gedung" class="illustration-image" onerror="this.src='https://via.placeholder.com/1200x500/E8E8E8/808080?text=Silakan+tambahkan+gambar+potongan+ilustrasi+gedung+di+sini+nanti'">
    </main>

</body>
</html>
