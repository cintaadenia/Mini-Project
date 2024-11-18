<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\KunjunganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('dokter', DokterController::class);

Route::resource('kunjungan', KunjunganController::class);