<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\StylistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('booking.step1');
});

// Client Booking Flow
Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/step-1', [BookingController::class, 'step1'])->name('step1');
    Route::get('/step-2', [BookingController::class, 'step2'])->name('step2');
    Route::get('/step-3', [BookingController::class, 'step3'])->name('step3');
    Route::post('/store', [BookingController::class, 'store'])->name('store');
    Route::get('/success', [BookingController::class, 'success'])->name('success');
});

// Stylist Dashboard
Route::prefix('stylist')->name('stylist.')->group(function () {
    Route::get('/dashboard', [StylistController::class, 'dashboard'])->name('dashboard');
});