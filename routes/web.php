<?php

use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\GuestController;

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


// Guest Route
Route::get('/home',[GuestController::class, 'home'])->name('home');
// Route::get('/',[GuestController::class, 'home'])->name('home');
Route::get('about',[GuestController::class, 'about'])->name('about');
Route::get('pricing',[GuestController::class, 'pricing'])->name('pricing');
Route::get('appointment',[GuestController::class, 'appointment'])->name('appointment');
Route::get('appointment/p1', function () {
    return view('guest.appointment.index1');
});
Route::get('appointment/p2', function () {
    return view('guest.appointment.index2');
});
Route::get('appointment/p3', function () {
    return view('guest.appointment.index3');
});
Route::get('appointment/p4', function () {
    return view('guest.appointment.index4');
});
Route::get('contact',[GuestController::class, 'contact'])->name('contact');

Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
// Guest Route End

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AdminAuthController::class, 'register']);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('profile', [AdminAuthController::class, 'profile'])->name('profile');
        Route::post('profile/update/{id}', [AdminAuthController::class, 'profileupdate'])->name('profile.update');
        Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
        Route::get('appointment', [AdminAuthController::class, 'appointment'])->name('appointment');
        Route::get('staff', [StaffController::class, 'index'])->name('staff');
        Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('payment', [PaymentController::class, 'index'])->name('payment');
        Route::get('service', [ServiceController::class, 'index'])->name('service');
        Route::get('customer', [CustomerController::class, 'index'])->name('customer');
        Route::get('community', [CommunityController::class, 'index'])->name('community');
    });
});

// Staff Routes
Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('register', [StaffAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [StaffAuthController::class, 'register']);

    Route::middleware(['role:staff'])->group(function () {
        Route::get('dashboard', [StaffAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [StaffAuthController::class, 'profile'])->name('profile');
        Route::post('profile/update/{id}', [StaffAuthController::class, 'profileupdate'])->name('profile.update');
        Route::get('appointment', [StaffAuthController::class, 'appointment'])->name('appointment');
        Route::get('calendar', [StaffAuthController::class, 'calendar'])->name('calendar');
        Route::get('community', [StaffAuthController::class, 'community'])->name('community');
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
        Route::get('dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [UserAuthController::class, 'profile'])->name('profile');
        Route::post('profile/update/{id}', [UserAuthController::class, 'profileupdate'])->name('profile.update');
        Route::get('calendar', [UserAuthController::class, 'calendar'])->name('calendar');
        Route::get('appointment', [UserAuthController::class, 'appointment'])->name('appointment');
        Route::get('staff', [UserAuthController::class, 'staff'])->name('staff');
        Route::get('community', [UserAuthController::class, 'community'])->name('community');
    });
});

