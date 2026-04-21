<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faisalink', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Dummy Dashboard (memerlukan Auth)
Route::middleware('auth:admin')->get('/dashboard/admin', function () {
    return '<h1>Beranda Admin</h1><form method="POST" action="/logout">'.csrf_field().'<button>Logout</button></form>';
});

Route::middleware('auth:peminjam')->get('/dashboard/user', function () {
    return '<h1>Beranda User/Peminjam</h1><form method="POST" action="/logout">'.csrf_field().'<button>Logout</button></form>';
});
