<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('home.welcome_warga');
});

Route::get('/register', [AuthController::class, 'registerPage']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home.home');
})->middleware('auth');

Route::get('/admin', function () {
    if (Auth::user()->usertype !== 'admin') {
        return redirect('/home');
    }
    return view('admin.admin_rt');
})->middleware(('auth'));


Route::middleware(['auth'])->group(function () {
    route::get('/admin_rt', [DashboardController::class, 'index'])->name('admin_rt');
});
