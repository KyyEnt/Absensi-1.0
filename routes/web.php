<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuRFIDController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('beranda'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');

    Route::get('/kartu', [KartuRFIDController::class, 'index'])->name('kartu.index');
    Route::post('/kartu/simpan', [KartuRFIDController::class, 'simpanRFID'])->name('kartu.simpan');
});
