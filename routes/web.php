<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\JadwalPraktekController;

Route::get('/', function () {
    return view('dashboard');
});

// Apply the `auth` middleware to protect all routes except the dashboard
Route::middleware('auth')->group(function () {
    // Obat routes
    Route::resource('obat', ObatController::class);

    // Pasien routes
    Route::resource('pasien', PasienController::class);

    // Resep routes
    Route::resource('resep', ResepController::class);

    // Kunjungan routes
    Route::resource('kunjungan', KunjunganController::class);

    // Jadwal Praktek routes
    Route::resource('jadwal_praktek', JadwalPraktekController::class);

    // Dokter routes
    Route::resource('dokter', DokterController::class);
});

// Authentication routes
Auth::routes();

// Home route (redirect after login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
