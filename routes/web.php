<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


// ===============================
// PUBLIC ROUTES (LOGIN)
// ===============================
Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('login.proses');


// ===============================
// AUTHENTICATED ROUTES
// ===============================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // ===============================
    // EVALUASI ROUTES
    // ===============================

    // yang boleh dilihat semua user
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');

    // ROUTE OWNER
    Route::middleware(['cekowner'])->group(function () {

        Route::get('/evaluasi/create', [EvaluasiController::class, 'create'])->name('evaluasi.create');
        Route::post('/evaluasi/store', [EvaluasiController::class, 'store'])->name('evaluasi.store');

        Route::get('/evaluasi/{id}/edit', [EvaluasiController::class, 'edit'])->name('evaluasi.edit');
        Route::put('/evaluasi/{id}/update', [EvaluasiController::class, 'update'])->name('evaluasi.update');

        Route::delete('/evaluasi/{id}', [EvaluasiController::class, 'destroy'])->name('evaluasi.destroy');
    });

    // PENTING!!! — Letakkan route ini PALING BAWAH agar tidak bentrok
    Route::get('/evaluasi/{id}', [EvaluasiController::class, 'show'])->name('evaluasi.show');


    // ===============================
    // RESOURCE ROUTES LAIN
    // ===============================
    Route::resource('absensi', AbsensiController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('users', UserController::class);

    Route::post('/absensi/import', [AbsensiController::class, 'importCSV'])->name('absensi.import');


    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
