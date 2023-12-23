<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::redirect('/', '/admin/dashboard');

Route::prefix('auth')->group(function() {
    Route::get('login', [LoginController::class, 'loginView'])->name('login.get');
    Route::get('signup', [RegisterController::class, 'signupView'])->name('signup.get');

    Route::post('login', [LoginController::class, 'handleLogin'])->name('login.post');
    Route::post('register', [RegisterController::class, 'handleSignup'])->name('login.post');
});

Route::prefix('admin')->group(function() {
    Route::get('dashboard', DashboardController::class)->name("dashboard.index");
    Route::resource('products', ProductController::class);
    Route::resource('categories', ProductCategoryController::class);
});

Route::fallback(function() {
    return view('errors.404');
});