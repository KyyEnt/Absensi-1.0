<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuRFIDController;
use Illuminate\Support\Facades\Route;




Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/kartu', [KartuRFIDController::class, 'index'])->name('kartu.index');
Route::post('/kartu/simpan', [KartuRFIDController::class, 'simpanRFID'])->name('kartu.simpan');
