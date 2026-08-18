<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------------
// PORTAL SEKOLAH SMK (PUBLIC ROUTES)
// -------------------------------------------------------------
Route::get('/', [SchoolController::class, 'index'])->name('home');
Route::get('/berita/{slug?}', [SchoolController::class, 'newsDetail'])->name('news.detail');
Route::get('/pengumuman/{id?}', [SchoolController::class, 'announcementDetail'])->name('announcement.detail');
Route::get('/jurusan/{slug?}', [SchoolController::class, 'majorDetail'])->name('major.detail');

// -------------------------------------------------------------
// GUEST ROUTES (Hanya bisa diakses oleh pengunjung yang BELUM LOGIN)
// -------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// -------------------------------------------------------------
// AUTH ROUTES (Hanya bisa diakses oleh user/guru/staff yang SUDAH LOGIN)
// -------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

