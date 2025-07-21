<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeminjamController;
use App\Http\Controllers\Api\BarangController;

Route::get('/peminjams', [PeminjamController::class, 'index']);
Route::post('/peminjams', [PeminjamController::class, 'store']);
Route::put('/peminjams/{id}/kembali', [PeminjamController::class, 'kembali']);

Route::get('/cek', function () {
    return \App\Http\Controllers\Api\PeminjamController::class;
});

Route::get('/barangs', [BarangController::class, 'index']);