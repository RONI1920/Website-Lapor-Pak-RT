<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Import Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
// Import Model (PENTING BIAR GAK ERROR 'Undefined type Laporan')
use App\Models\Laporan;



// Halaman Depan
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

// 2. Halaman Riwayat
Route::get('/laporan/riwayat', [LaporanController::class, 'history']);

// 3. Update Status (POST)
// Sesuai request: Namanya 'update_laporan'
Route::post('/laporan/{id}/update', [LaporanController::class, 'UpdateStatus'])->name('update_laporan');

// 4. Detail Laporan (GET)
// Sesuai request: Namanya 'detail_laporan'
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('detail_laporan');


// --- Fitur Notifikasi & Inbox ---

// Tandai sudah dibaca
Route::get('/mark-as-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->middleware('auth')->name('notifikasi.read');

// Halaman Kotak Masuk
Route::get('/kotak-masuk', [DashboardController::class, 'inbox'])->middleware('auth')->name('inbox');

// Route untuk klik notifikasi satuan
Route::get('/notifikasi/{id}/baca', [DashboardController::class, 'markAsRead'])->name('notifikasi.baca');
