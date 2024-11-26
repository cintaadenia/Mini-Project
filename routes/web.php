<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\JadwalPraktekController;
use App\Http\Controllers\RekamMedisController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Hanya untuk admin
Route::get('/admin', function () {
    return view('admin-home');
})->middleware(['auth', 'role:admin']);

// Pasien dan Rekam Medis (dapat diakses oleh semua user)
Route::middleware('auth')->group(function () {
    Route::resource('pasien', PasienController::class);
    Route::resource('rekam_medis', RekamMedisController::class);
});

// Fitur lain (hanya admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('obat', ObatController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('resep', ResepController::class);
    Route::resource('kunjungan', KunjunganController::class);
    Route::resource('jadwal_praktek', JadwalPraktekController::class);
});
