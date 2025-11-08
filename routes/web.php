<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
//use  App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\UserController;

//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [AuthController::class, 'login'])->name('login.post');//
//Route::get('/logout', [AuthController::class, 'logout'])->name('logout');//

// Contoh halaman setelah login
//Route::middleware('auth')->prefix('dashboard')->group(function () {
    //Route::get('/', function () {
  //      return view('dashboard');
//    })->name('dashboard');//


Route::get('/dashboard', function () {
    return view('dashboard');
});



Route::resource('absensi', AbsensiController::class);
Route::resource('jadwal', JadwalController::class);
Route::resource('evaluasi', EvaluasiController::class);
Route::resource('users', UserController::class);

