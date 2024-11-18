<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('dokter', DokterController::class);
