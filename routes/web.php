<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubcategoryController;


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

// Route::view('/login', 'admin.pages.login');
// Route::view('/register', 'admin.pages.register');
// Route::view('/dashboard', 'admin.page-example');

Route::prefix('admin')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::resource('dashboard', DashboardController::class);
            Route::resource('admin', AdminController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('subcategories', SubcategoryController::class);
            Route::resource('products', ProductController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('colors', ColorController::class);
            Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        });
    });
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'handleLogin'])->name('admin.handleLogin');
        Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
        Route::post('/register', [AuthController::class, 'handleRegister'])->name('admin.handleRegister');
    });
});
