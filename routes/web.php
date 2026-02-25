<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| 1. AKSES PUBLIK (GUEST)
|--------------------------------------------------------------------------
*/
// Halaman Input Nama (Pertama kali dibuka)
Route::get('/', [MathController::class, 'showUserForm'])->name('math.user');
Route::post('/set-user', [MathController::class, 'setUser'])->name('math.set_user');

// Autentikasi Admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 2. FITUR KALKULATOR (MEMBUTUHKAN NAMA DI SESSION)
|--------------------------------------------------------------------------
*/
Route::get('/kalkulator', [MathController::class, 'index'])->name('math.index');
Route::post('/arithmetic', [MathController::class, 'arithmetic'])->name('math.arithmetic');
Route::post('/equation', [MathController::class, 'equation'])->name('math.equation');
Route::post('/geometry', [MathController::class, 'geometry'])->name('math.geometry');

/*
|--------------------------------------------------------------------------
| 3. AREA ADMIN (PROTEKSI LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Halaman Dashboard Utama
    Route::get('/admin/dashboard', [MathController::class, 'dashboard'])->name('admin.dashboard');
    
    // Halaman Laporan Statistik
    Route::get('/report', [MathController::class, 'report'])->name('math.report');
    
    // Fitur Hapus History
    Route::delete('/clear-history/{type}', [MathController::class, 'clearHistory'])->name('math.clear');
    // Fitur Hapus Riwayat Tertentu
    Route::delete('/admin/bulk-delete', [MathController::class, 'bulkDestroy'])->name('admin.bulk_destroy');
});

Route::middleware(['auth'])->group(function () {
    // ... route admin lainnya ...
    
    // Route untuk menghapus baris riwayat tertentu
    Route::delete('/history/{id}', [MathController::class, 'destroyHistory'])->name('admin.destroy_history');
});