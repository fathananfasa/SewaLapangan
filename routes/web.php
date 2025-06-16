<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('create-booking', [BookingController::class, 'create'])->name('create-booking');
Route::post('simpan-booking', [BookingController::class, 'store'])->name('store-booking');

Route::get('/get-available-jam', [BookingController::class, 'getAvailableJam'])->name('get-available-jam');
// ✅ Cukup yang ini untuk admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware(['auth', 'role:admin']);
// routes/web.php
Route::patch('/admin/konfirmasi/{id}', [AdminController::class, 'konfirmasi'])->name('admin.konfirmasi')->middleware(['auth', 'role:admin']);
Route::put('/admin/tolak/{id}', [AdminController::class, 'tolak'])->name('admin.tolak');

Route::get('/dashboard', [BookingController::class, 'dashboard'])
    ->middleware(['auth', 'role:user'])
    ->name('dashboard');

    Route::get('/status-booking', [BookingController::class, 'statusBooking'])->middleware(['auth', 'role:user'])->name('status-booking');
// Menangani metode POST untuk route 'dashboard'
Route::post('/dashboard', [BookingController::class, 'store'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
