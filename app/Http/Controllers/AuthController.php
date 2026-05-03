<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Peminjam;

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

        // Mencoba login
        if (Auth::guard($guard)->attempt($credentials)) {
            // Jika sukses
            $request->session()->regenerate();

            if ($guard === 'admin') {
                return redirect()->route('dashboard.admin');
            } else {
                return redirect()->route('dashboard.user');
            }
        }

        // Jika salah username / password
        return back()->withErrors([
            'loginError' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username', 'role');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:Peminjam',
            'email' => 'required|email|max:100|unique:Peminjam',
            'contact' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.unique' => 'Username sudah digunakan.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // Membuat user baru
        $peminjam = Peminjam::create([
            'nama_peminjam' => $request->nama_peminjam,
            'username' => $request->username,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah register
        Auth::guard('peminjam')->login($peminjam);
        
        return redirect()->route('dashboard.user')->with('success', 'Registrasi berhasil! Selamat datang di Faisalink.');
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
