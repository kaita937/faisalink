<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faisalink - Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <!-- Decorative Background Shapes -->
    <div class="blob-tr-light"></div>
    <div class="blob-tr-dark"></div>
    <div class="blob-bl-light"></div>
    <div class="blob-bl-dark"></div>

    <div class="container">
        <!-- Logo & Title -->
        <div class="brand-section">
            <div class="logo-icon">
                <img src="{{ asset('Icon/logo.png') }}" alt="Logo Faisalink">
            </div>
            <div class="text-container">
                <h1 class="brand-title">Faisalink</h1>
                <h2 class="brand-subtitle">Facilities Instant Access</h2>
            </div>
        </div>

        <!-- Register Card -->
        <div class="login-card">
            <h2 class="login-title">Register User</h2>
            <p style="color: #666; font-size: 0.9rem; margin-bottom: 20px; text-align: center;">Daftar akun baru untuk user</p>
            
            <form action="{{ route('register.post') }}" method="POST" style="width: 100%;">
                @csrf
                
                @if ($errors->any())
                <div style="color: #d93025; background-color: #fce8e6; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; border-left: 4px solid #d93025;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif

                <div class="form-group">
                    <input type="text" name="nama_peminjam" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_peminjam') }}" required>
                </div>

                <div class="form-group">
                    <input type="text" name="nomor_identitas" class="form-control" placeholder="NIM / NIP" value="{{ old('nomor_identitas') }}" required>
                </div>

                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <input type="text" name="contact" class="form-control" placeholder="No. Kontak (Optional)" value="{{ old('contact') }}">
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="btn-submit">Sign Up</button>
            </form>

            <div style="margin-top: 20px; text-align: center;">
                <p style="font-size: 0.9rem; color: #666;">Sudah punya akun? <a href="{{ route('login') }}" style="color: #2e66ff; text-decoration: none; font-weight: 600;">Login di sini</a></p>
            </div>
        </div>
    </div>

</body>
</html>
