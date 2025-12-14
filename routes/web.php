<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\StylistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppointmentController;

// =====================
// PÚBLICO - Landing Page
// =====================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// =====================
// AUTENTICACIÓN
// =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// RESERVAS (Público)
// =====================
Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/step-1', [BookingController::class, 'step1'])->name('step1');
    Route::get('/step-2', [BookingController::class, 'step2'])->name('step2');
    Route::get('/step-3', [BookingController::class, 'step3'])->name('step3');
    Route::post('/store', [BookingController::class, 'store'])->name('store');
    Route::get('/success', [BookingController::class, 'success'])->name('success');
});

// =====================
// PANEL ADMIN (Protegido)
// =====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Servicios
    Route::resource('services', ServiceController::class);

    // CRUD Productos
    Route::resource('products', ProductController::class);

    // CRUD Usuarios
    Route::resource('users', UserController::class);

    // CRUD Citas
    Route::resource('appointments', AppointmentController::class);
});

// =====================
// PANEL ESTILISTA (Protegido)
// =====================
Route::prefix('stylist')->name('stylist.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StylistController::class, 'dashboard'])->name('dashboard');
    Route::post('/appointments/{id}/complete', [StylistController::class, 'complete'])->name('appointments.complete');
});