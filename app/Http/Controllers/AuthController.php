<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'role'     => 'required|in:admin,user',
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        
        // Memilih guard berdasarkan role
        $guard = $request->role === 'admin' ? 'admin' : 'peminjam';

        // Mencoba login (asumsi password di DB menggunakan bcrypt/Hash standar Laravel)
        // Jika password di database berupa Plain Text (tidak dienkripsi), fungsi attempt() ini akan selalu GAGAL.
        if (Auth::guard($guard)->attempt($credentials)) {
            // Jika sukses
            $request->session()->regenerate();

            if ($guard === 'admin') {
                return redirect()->intended('/dashboard/admin');
            } else {
                return redirect()->intended('/dashboard/user');
            }
        }

        // Jika salah username / password
        return back()->withErrors([
            'loginError' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username', 'role');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('peminjam')->check()) {
            Auth::guard('peminjam')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
