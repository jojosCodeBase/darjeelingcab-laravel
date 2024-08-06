<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AuthController;

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
    return view('index');
});

Route::get('/about', function () {
    return view('about-us');
});

Route::get('/blogs', function () {
    return view('blogs');
})->name('blogs');

Route::get('/blog-info/{id}', function () {
    return view('blog-info');
})->name('blog-info');

Route::get('/blog-info/1', function () {
    return view('blog-info');
});

Route::get('/testimonials', function () {
    return view('testimonials');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/booking-inquiry', function () {
    return view('booking-inquiry');
});

Route::get('/team', function () {
    return view('team');
});

/***********************************************
                ADMIN ROUTES START
*********************************************/

Route::get('/login', function () {
    return view('admin.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('admin.register');
})->name('register');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('admin.profile');
})->name('profile');

Route::get('/forms', function () {
    return view('admin.forms');
})->name('forms');

Route::resource('customer', CustomerController::class)->names([
    'index' => 'customers',
    'create' => 'customer.create',
    'store' => 'customer.store',
    'edit' => 'customer.edit',
    'update' => 'customer.update',
    'show' => 'customer.show',
    'destroy' => 'customer.destroy',
]);


Route::resource('bill', BillController::class)->names([
    'index' => 'bills',
    'create' => 'bill.create',
    'store' => 'bill.store',
    'update' => 'bill.update',
    'show' => 'bill.show',
    'destroy' => 'bill.destroy',
]);

Route::get('/bill/{bill}/pdf', [BillController::class, 'generatePDF'])->name('bill.pdf');

Route::post('/create-party', [BookingController::class, "createBooking"])->name('create-booking');

/***********************************************
                ADMIN ROUTES END
*********************************************/