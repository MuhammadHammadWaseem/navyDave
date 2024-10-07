<?php

use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceAssign;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\StaffAuthController;

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

// for Getting Google token
Route::get('/google-auth', [AdminAuthController::class, 'redirectToGoogle']);
// for Handling Google callback
Route::get('/google-auth/callback', [AdminAuthController::class, 'handleGoogleCallback']);
// for Create sample event
Route::get('/check', [AdminAuthController::class, 'check']);


 // Community like and unlike
    Route::post('/like/{type}/{id}', [CommunityController::class, 'like'])->name('like');
    Route::post('/unlike/{type}/{id}', [CommunityController::class, 'unlike'])->name('unlike');
    Route::post('post', [CommunityController::class, 'post'])->name('post');
    Route::get('post/get', [CommunityController::class, 'postGet'])->name('post.get');
    Route::post('comment/get', [CommunityController::class, 'commentGet'])->name('comment.get');
    Route::post('posts/delete', [CommunityController::class, 'deletePost'])->name('posts.delete');
    Route::post('/comment/like', [CommunityController::class, 'likeComment']);


    Route::get('/comments/{post}', [CommunityController::class,'fetchReplies'])->name('comments.get');
    Route::post('/comment/{post}', [CommunityController::class,'commentPost'])->name('post.comments');
    Route::post('/comments/add', [CommunityController::class, 'addComment'])->middleware('auth');
    Route::post('/comment/update/{id}', [CommunityController::class,'update'])->name('comment.update');
    Route::post('/comment/{id}/delete', [CommunityController::class, 'deleteComment'])->name('comment.delete');
    Route::post('/like/{post}', [CommunityController::class,'like'])->name('post.like');

    // User Subscribe
    Route::post('subscribe', [UserAuthController::class, 'subscribe'])->name('user.subscribe');
    
    Route::get('get-notification', [CommunityController::class, 'getNotification'])->name('user.get-notification');
    Route::post('mark-notification-read/{id}', [CommunityController::class, 'markNotification'])->name('user.mark-notification-read');
    Route::post('/mark-all-notifications-read', [CommunityController::class, 'markAllNotification'])->name('user.mark-all-notifications-read');



// Guest Route
Route::get('/',[GuestController::class, 'home'])->name('home');
Route::get('about',[GuestController::class, 'about'])->name('about');
Route::get('pricing',[GuestController::class, 'pricing'])->name('pricing');
Route::get('appointment',[GuestController::class, 'appointment'])->name('appointment');
Route::post('appointment/create',[GuestController::class, 'appointmentCreate'])->name('appointment.create');
Route::get('mailCheck',[GuestController::class, 'mailCheck'])->name('appointment.mailCheck');
// Stripe
Route::post('appointment/stripe',[GuestController::class, 'appointmentStripe'])->name('appointment.stripe');
Route::get('/payment/success', [GuestController::class, 'stripeSuccess'])->name('payment.success');
Route::get('/payment/fail', [GuestController::class, 'paymentFail'])->name('payment.fail');

Route::get('contact',[GuestController::class, 'contact'])->name('contact');
Route::post('contact',[GuestController::class, 'contactStore'])->name('contact.store')->middleware('throttle:5,1');
Route::get('blogs',[GuestController::class, 'blogs'])->name('blogs');
Route::get('blog/details/{id}',[GuestController::class, 'blogDetails'])->name('blog-details');
Route::get('faq',[GuestController::class, 'faq'])->name('faq');

Route::get('get-services/{id}',[GuestController::class, 'getServices'])->name('get-services');
Route::get('get-staff/{id}',[GuestController::class, 'getStaff'])->name('get-staff');
Route::get('get-slots',[GuestController::class, 'getSlots'])->name('get-slots');
Route::get('get-slots-for-date',[GuestController::class, 'getSlotsForDate'])->name('get-slots-for-date');


Route::get('payment-success',[GuestController::class, 'paymentSuccess'])->name('payment-success');
Route::get('payment-fail',[GuestController::class, 'paymentFailViwe'])->name('payment-fail');



Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AdminAuthController::class, 'register'])->name('register.post');
Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
// Guest Route End

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('profile', [AdminAuthController::class, 'profile'])->name('profile');
        Route::post('profile/update/{id}', [AdminAuthController::class, 'profileupdate'])->name('profile.update');
        Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
        Route::get('appointment', [AdminAuthController::class, 'appointment'])->name('appointment');
        // Store Staff
        Route::get('staff', [StaffController::class, 'index'])->name('staff');
        Route::post('staff/store', [StaffController::class, 'store'])->name('staff.store');
        Route::get('staff/show', [StaffController::class, 'show'])->name('staff.show');
        Route::get('staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
        Route::post('staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('payment', [PaymentController::class, 'index'])->name('payment');
        //Service
        Route::get('service', [ServiceController::class, 'index'])->name('service');
        Route::get('service/show', [ServiceController::class, 'show'])->name('service.show');
        Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');
        Route::get('service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::delete('service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
        // Service Assign
        Route::get('service-assign', [ServiceAssign::class, 'index'])->name('service.assign');
        Route::post('service-assign/store', [ServiceAssign::class, 'store'])->name('service.assign.store');
        Route::get('service-assign/show', [ServiceAssign::class, 'show'])->name('service.assign.show');
        Route::delete('service-assign/delete/{id}', [ServiceAssign::class, 'destroy'])->name('service.assign.destroy');

        // Create Category
        Route::post('/categories/store', [ServiceController::class, 'storeCategory'])->name('categories.store');
        // Slots
        Route::get('slot', [SlotController::class, 'index'])->name('slot');
        Route::get('slot/create', [SlotController::class, 'create'])->name('slot.create');
        Route::post('slot/store', [SlotController::class, 'store'])->name('slot.store');
        Route::post('slot/delete/{id}', [SlotController::class, 'destroy'])->name('slot.destroy');
        Route::get('slot/edit/{id}', [SlotController::class, 'edit'])->name('slot.edit');
        Route::post('slot/update/{id}', [SlotController::class, 'update'])->name('slot.update');
        Route::post('slot/getServices', [SlotController::class, 'getServices'])->name('slot.getServices');

        // Customer
        Route::get('customer', [CustomerController::class, 'index'])->name('customer');

        Route::get('community', [CommunityController::class, 'index'])->name('community');
        // Blogs
        Route::get('blog', [BlogController::class, 'index'])->name('blog');
        Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::post('blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::get('blog/show/{id}', [BlogController::class, 'show'])->name('blog.show');
        Route::get('blog/show-all', [BlogController::class, 'showAll'])->name('blog.show.all');

        //Appointments
        Route::get('index', [AppointmentController::class, 'index'])->name('appointment.index');
        Route::get('get-appointment', [AppointmentController::class, 'getAppointment'])->name('appointment.get');
        Route::post('edit-appointment', [AppointmentController::class, 'edit'])->name('appointment.edit');

        // Setting
        Route::get('setting', [SettingController::class, 'index'])->name('setting');
        Route::get('setting/create', [SettingController::class, 'create'])->name('setting.create');
        Route::post('setting/store', [SettingController::class, 'store'])->name('setting.store');
        Route::get('setting/show', [SettingController::class, 'show'])->name('setting.show');
        Route::get('setting/edit/{id}', [SettingController::class, 'edit'])->name('setting.edit');
        Route::post('setting/update/{id}', [SettingController::class, 'update'])->name('setting.update');

        // Subscription
        Route::get('subscribers', [AdminAuthController::class, 'subscribers'])->name('subscribers');
    });
});

// Staff Routes
Route::prefix('staff')->name('staff.')->group(function () {
    Route::middleware(['role:staff'])->group(function () {
        Route::get('dashboard', [StaffAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [StaffAuthController::class, 'profile'])->name('profile');
        Route::post('profile/update/{id}', [StaffAuthController::class, 'profileupdate'])->name('profile.update');
        Route::get('appointment', [StaffAuthController::class, 'appointment'])->name('appointment');
        Route::get('get-appointment', [StaffAuthController::class, 'getAppointment'])->name('appointment.get');
        Route::get('show-appointment', [StaffAuthController::class, 'showAppointment'])->name('appointment.show');
        Route::post('edit-appointment', [StaffAuthController::class, 'edit'])->name('appointment.edit');
        Route::get('calendar', [StaffAuthController::class, 'calendar'])->name('calendar');
        Route::get('community', [StaffAuthController::class, 'community'])->name('community');
    });
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserAuthController::class, 'login']);
    Route::middleware(['role:user'])->group(function () {
        // Routes only Users can access
        Route::get('dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [UserAuthController::class, 'profile'])->name('profile');
        Route::post('profile/update/{id}', [UserAuthController::class, 'profileupdate'])->name('profile.update');
        Route::get('calendar', [UserAuthController::class, 'calendar'])->name('calendar');
        Route::get('appointment', [UserAuthController::class, 'appointment'])->name('appointment');
        Route::get('staff', [UserAuthController::class, 'staff'])->name('staff');
        Route::get('community', [UserAuthController::class, 'community'])->name('community');
        Route::get('get-appointment', [UserAuthController::class, 'getAppointment'])->name('appointment.get');
        Route::get('get-user-appointment', [UserAuthController::class, 'getUserAppointment'])->name('appointment.get.user');
    });
});
