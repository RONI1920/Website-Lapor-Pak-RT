<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Models\Laporan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('home.welcome_warga');
});

// --- Authentication ---
Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Dashboard Warga ---
Route::get('/home', function () {
    // Mengambil data laporan milik user yang login
    $laporans = Laporan::where('user_id', Auth::id())->latest()->get();
    return view('home.home', compact('laporans'));
})->middleware('auth');

// --- Dashboard Admin ---
Route::get('/admin', function () {
    if (Auth::user()->usertype !== 'admin') {
        return redirect('/home');
    }
    return view('admin.admin_rt');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin_rt', [DashboardController::class, 'index'])->name('admin_rt');
});

// --- Fitur Laporan (CRUD) ---

// 1. Form & Simpan Laporan
Route::get('/laporan/create', [LaporanController::class, 'create']);
Route::post('/laporan/store', [LaporanController::class, 'store']);

// 2. Halaman Riwayat (Tambahan)
Route::get('/laporan/riwayat', [LaporanController::class, 'history']);

// 3. Update Status (PUT) - Wajib ditaruh SEBELUM route detail {id}
// PENTING: Namanya 'laporan.update' agar cocok dengan form HTML
Route::post('/laporan/{id}/update', [LaporanController::class, 'UpdateStatus'])->name('update_laporan');

// 4. Detail Laporan (GET)
// PENTING: Namanya 'laporan.show' agar cocok dengan tombol 'Detail'
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('detail_laporan');
