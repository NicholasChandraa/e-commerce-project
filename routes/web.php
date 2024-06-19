<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute untuk admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('products', ProductController::class);
    });

    // Rute untuk user
    Route::middleware(['auth'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/user/profile', [UserController::class, 'showUser'])->name('user.profile');
        Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
        Route::post('/settings', [UserController::class, 'updateSettings'])->name('user.settings.update');
        Route::get('/buy/{product}', [ProductController::class, 'buy'])->name('products.buy');
    });
});
