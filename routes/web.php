<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faisalink', function () {
    return view('landing');
})->name('landing');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Dashboard
Route::middleware('auth:admin')->get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');
Route::middleware('auth:peminjam')->get('/dashboard/user', [DashboardController::class, 'peminjamDashboard'])->name('dashboard.user');
