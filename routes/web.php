<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingViewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/faisalink', function () {
    return view('landing');
})->name('landing');

Route::get('/facility', [DashboardController::class, 'facility'])->name('facility');
Route::get('/facility/category/{category}', [DashboardController::class, 'facilityCategory'])->name('facility.category');
Route::get('/facility/search', [DashboardController::class, 'facilitySearch'])->name('facility.search');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Dashboard
Route::middleware('auth:admin')->get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.admin');
Route::middleware('auth:peminjam')->get('/dashboard/user', [DashboardController::class, 'peminjamDashboard'])->name('dashboard.user');
Route::middleware('auth:peminjam')->get('/profile', [DashboardController::class, 'profile'])->name('profile');
Route::middleware('auth:peminjam')->post('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
Route::get('/facility_user/{id}', [DashboardController::class, 'facilityDetail'])->name('facility.detail');

// Rute Booking
Route::middleware('auth:peminjam')->get('/booking/{id}', [\App\Http\Controllers\BookingController::class, 'showBookingForm'])->name('booking.form');
Route::middleware('auth:peminjam')->post('/booking', [\App\Http\Controllers\BookingController::class, 'submitBooking'])->name('booking.submit');

// Rute Admin Booking
Route::middleware('auth:admin')->get('/admin/bookings', [\App\Http\Controllers\AdminController::class, 'bookingsIndex'])->name('admin.bookings.index');
Route::middleware('auth:admin')->get('/admin/booking/{id}', [\App\Http\Controllers\AdminController::class, 'bookingDetail'])->name('admin.booking.detail');
Route::middleware('auth:admin')->post('/admin/booking/{id}/upload-bukti', [\App\Http\Controllers\AdminController::class, 'uploadBuktiPeminjaman'])->name('admin.booking.uploadBukti');
Route::middleware('auth:admin')->post('/admin/booking/{id}/contact-sarpras', [\App\Http\Controllers\AdminController::class, 'contactSarpras'])->name('admin.booking.contactSarpras');
Route::middleware('auth:admin')->post('/admin/booking/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approveBooking'])->name('admin.booking.approve');
Route::middleware('auth:admin')->post('/admin/booking/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectBooking'])->name('admin.booking.reject');

//rute booking user
Route::middleware('auth:peminjam')->get('/booking_view', [BookingViewController::class, 'bookingInfo'])->name('booking_view');
Route::middleware('auth:peminjam')->get('/booking_view/{id}', [BookingViewController::class, 'detail'])->name('booking.detail');
Route::middleware('auth:peminjam')->delete('/booking/{id}', [BookingViewController::class, 'destroy'])->name('booking.destroy');
Route::middleware('auth:peminjam')->post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
Route::middleware('auth:peminjam')->post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
Route::middleware('auth:peminjam')->get('/booking/{id}/review', [ReviewController::class, 'form'])->name('booking.review.form');
Route::middleware('auth:peminjam')->post('/booking/{id}/review', [ReviewController::class, 'store'])->name('booking.review.store');
Route::middleware('auth:peminjam')->put('/booking/{id}/review', [ReviewController::class, 'update'])->name('booking.review.update');
Route::middleware('auth:peminjam')->delete('/booking/{id}/review', [ReviewController::class, 'destroy'])->name('booking.review.destroy');


// Rute Admin Fasilitas
Route::middleware('auth:admin')->get('/admin/facilities', [\App\Http\Controllers\AdminController::class, 'facilitiesIndex'])->name('admin.facilities.index');
Route::middleware('auth:admin')->get('/admin/facilities/create', [\App\Http\Controllers\AdminController::class, 'facilitiesCreate'])->name('admin.facilities.create');
Route::middleware('auth:admin')->post('/admin/facilities', [\App\Http\Controllers\AdminController::class, 'facilitiesStore'])->name('admin.facilities.store');
Route::middleware('auth:admin')->get('/admin/facilities/{id}/edit', [\App\Http\Controllers\AdminController::class, 'facilitiesEdit'])->name('admin.facilities.edit');
Route::middleware('auth:admin')->put('/admin/facilities/{id}', [\App\Http\Controllers\AdminController::class, 'facilitiesUpdate'])->name('admin.facilities.update');
Route::middleware('auth:admin')->delete('/admin/facilities/{id}', [\App\Http\Controllers\AdminController::class, 'facilitiesDestroy'])->name('admin.facilities.destroy');
Route::middleware('auth:admin')->get('/admin/facilities/{id}/equipment', [\App\Http\Controllers\AdminController::class, 'facilityEquipment'])->name('admin.facilities.equipment');

// Rute Admin Perlengkapan
Route::middleware('auth:admin')->get('/admin/equipment', [\App\Http\Controllers\AdminController::class, 'equipmentIndex'])->name('admin.equipment.index');
Route::middleware('auth:admin')->get('/admin/equipment/create', [\App\Http\Controllers\AdminController::class, 'equipmentCreate'])->name('admin.equipment.create');
Route::middleware('auth:admin')->post('/admin/equipment', [\App\Http\Controllers\AdminController::class, 'equipmentStore'])->name('admin.equipment.store');
Route::middleware('auth:admin')->get('/admin/equipment/{id}/edit', [\App\Http\Controllers\AdminController::class, 'equipmentEdit'])->name('admin.equipment.edit');
Route::middleware('auth:admin')->put('/admin/equipment/{id}', [\App\Http\Controllers\AdminController::class, 'equipmentUpdate'])->name('admin.equipment.update');
Route::middleware('auth:admin')->delete('/admin/equipment/{id}', [\App\Http\Controllers\AdminController::class, 'equipmentDestroy'])->name('admin.equipment.destroy');

//admin user
Route ::middleware('auth:admin')->get('/admin/users', [\App\Http\Controllers\AdminController::class, 'usersIndex'])->name('admin.users.index');  
Route ::middleware('auth:admin')->delete('/admin/users/{id}', [\App\Http\Controllers\AdminController::class, 'usersDestroy'])->name('admin.users.destroy');

//Admin Ruangan
Route::middleware('auth:admin')->get('/facility_admin', [\App\Http\Controllers\AdminController::class, 'facility'])->name('facility_admin');
Route::middleware('auth:admin')->get('/facility/{id}', [\App\Http\Controllers\AdminController::class, 'facilityDetail'])->name('facility.detail.admin');
