<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faisalink - Login</title>
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

        <!-- Login Card -->
        <div class="login-card">
            <h2 class="login-title">Welcome</h2>
            <form action="{{ route('login.post') }}" method="POST" style="width: 100%;">
                @csrf
                @error('loginError')
                <div style="color: #d93025; background-color: #fce8e6; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; border-left: 4px solid #d93025;">
                    {{ $message }}
                </div>
                @enderror
                
                <div class="form-group">
                    <select name="role" class="form-control" required>
                        <option value="" disabled selected hidden>Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="btn-submit">Sign In</button>
            </form>
            <div style="margin-top: 20px;">
                <a href="{{ route('landing') }}" style="color: #2e66ff; text-decoration: none; font-size: 0.9rem;">Back to Home</a>
            </div>
        </div>
    </div>

</body>
</html>
