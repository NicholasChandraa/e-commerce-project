<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCategoryController;

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
        Route::resource('categories', CategoryController::class);
        Route::resource('article-categories', ArticleCategoryController::class);
        Route::get('/manageArticles', [ArticleController::class, 'manage'])->name('manageArticles');
    });

    // Rute untuk user
    Route::middleware(['auth'])->group(function () {
        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

        // Route User
        Route::get('/main', [HomeController::class, 'main'])->name('main');
        Route::get('/', [HomeController::class, 'main'])->name('main');

        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/user/profile', [UserController::class, 'showUser'])->name('user.profile');
        Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
        Route::post('/settings', [UserController::class, 'updateSettings'])->name('user.settings.update');

        // Route Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

        // Rute untuk checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');


        // Rute untuk hasil pembayaran
        Route::get('/payment-success', function () {
            return view('payment.success');
        })->name('payment.success');

        Route::get('/payment-pending', function () {
            return view('payment.pending');
        })->name('payment.pending');

        Route::get('/payment-error', function () {
            return view('payment.error');
        })->name('payment.error');

        // Rute Artikel
        Route::resource('articlePages', ArticleController::class);
        Route::get('/articles/filter', [ArticleController::class, 'filter'])->name('articles.filter');
        Route::get('/about', function () {
            return view('users.about');
        })->name('about');
    });
});
