<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faisalink - Facilities Instant Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- Bagian Atas: Logo dan Teks -->
    <header class="header-section">
        <div class="logo-icon">
            <img src="{{ asset('Icon/logo.png') }}" alt="Logo Faisalink">
        </div>
        
        <div class="text-container">
            <h1 class="brand-title">Faisalink</h1>
            <h2 class="brand-subtitle">Facilities Instant Access</h2>
            <div class="btn-wrapper">
                <a href="{{ route('login') }}" class="btn-start">Explore Facilities</a>
            </div>
    </header>

    <!-- Bagian Bawah: Ilustrasi Gedung -->
    <main class="illustration-section">
        <img src="{{ asset('Icon/building.png') }}" alt="Ilustrasi Gedung" class="illustration-image" onerror="this.src='https://via.placeholder.com/1200x500/E8E8E8/808080?text=Silakan+tambahkan+gambar+potongan+ilustrasi+gedung+di+sini+nanti'">
    </main>

</body>
</html>
