<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\Auth\UserAuthController;

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

Route::get('/', function () {
    return view('welcome');
});


// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AdminAuthController::class, 'register']);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// Staff Routes
Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('login', [StaffAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [StaffAuthController::class, 'login']);
    Route::get('register', [StaffAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [StaffAuthController::class, 'register']);

    Route::middleware(['role:staff'])->group(function () {
        // Routes only Staff can access
    });
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserAuthController::class, 'login']);
    Route::get('register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [UserAuthController::class, 'register']);

    Route::middleware(['role:user'])->group(function () {
        // Routes only Users can access
    });
});

