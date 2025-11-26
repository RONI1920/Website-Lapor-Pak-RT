<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Runner\HookMethod;

Route::get('/', function () {
    return view('home.welcome_warga');
});

Route::get('/register', [AuthController::class, 'registerPage']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
    return view('home.home');
})->middleware('auth');

Route::get('/admin', function () {
    return view('admin.admin_rt');
})->middleware('auth');
