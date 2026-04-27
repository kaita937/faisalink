<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faisalink - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            overflow: hidden;
            position: relative;
        }

        /* Decorative Background Blobs */
        .blob-tr-dark {
            position: absolute;
            top: -120px;
            right: -80px;
            width: 350px;
            height: 350px;
            background-color: #004dff; /* Warna biru sesuai gambar */
            border-radius: 43% 57% 35% 65% / 46% 62% 38% 54%;
            transform: rotate(-15deg);
            z-index: 1;
        }
        .blob-tr-light {
            position: absolute;
            top: -80px;
            right: -50px;
            width: 400px;
            height: 400px;
            background-color: #dae5ff; /* Warna biru muda */
            border-radius: 43% 57% 35% 65% / 46% 62% 38% 54%;
            transform: rotate(5deg);
            z-index: 0;
        }

        .blob-bl-dark {
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 450px;
            height: 450px;
            background-color: #004dff;
            border-radius: 35% 65% 55% 45% / 45% 40% 60% 55%;
            z-index: 1;
        }
        .blob-bl-light {
            position: absolute;
            bottom: -100px;
            left: -50px;
            width: 500px;
            height: 500px;
            background-color: #dae5ff;
            border-radius: 54% 46% 67% 33% / 59% 37% 63% 41%;
            z-index: 0;
        }

        /* Main Container */
        .container {
            position: relative;
            z-index: 10;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Brand / Logo Section */
        .brand-section {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
        }

        .logo-icon {
            width: 110px;
            height: 110px;
            margin-right: 25px;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .text-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-title {
            font-size: 5rem;
            font-weight: 900;
            color: #2e66ff;
            margin: 0;
            line-height: 0.9;
            letter-spacing: -2px;
        }

        .brand-subtitle {
            font-size: 2rem;
            font-weight: 400;
            color: #ffaa00;
            margin: 0;
            margin-top: 5px;
            letter-spacing: -0.5px;
        }

        /* Login Card */
        .login-card {
            background: #ffffff;
            border: 2px solid #aecbfa;
            border-radius: 12px;
            padding: 40px 60px;
            width: 350px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            font-size: 2.2rem;
            font-weight: 600;
            color: #000;
            margin-bottom: 30px;
            margin-top: 0;
        }

        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
            color: #555;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control::placeholder {
            color: #a3a3a3;
        }

        .form-control:focus {
            border-color: #2e66ff;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23a3a3a3%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 15px top 50%;
            background-size: 10px auto;
            color: #a3a3a3;
        }
        
        select.form-control option {
            color: #555;
        }
        
        /* Ubah warna select ketika ada isinya */
        select.form-control:valid, select.form-control option[value=""]:not(:checked) {
            color: #555;
        }

        .btn-submit {
            background-color: #ffaa00;
            color: #000;
            font-weight: 600;
            border: none;
            padding: 8px 30px;
            border-radius: 8px;
            font-size: 0.95rem;
            cursor: pointer;
            margin-top: 20px;
            transition: transform 0.1s, background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #e69900;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .brand-section { margin-bottom: 30px; }
            .login-card { width: 85%; padding: 30px; }
            .brand-title { font-size: 3.5rem; }
            .brand-subtitle { font-size: 1.4rem; }
            .logo-icon { width: 80px; height: 80px; }
        }
    </style>
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
