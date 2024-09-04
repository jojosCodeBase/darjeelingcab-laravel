<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;
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

Route::middleware('track')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/about-us', function () {
        return view('about-us');
    });

    Route::get('/blogs', [BlogController::class, 'show'])->name('blogs');

    Route::get('/blogs/{slug}', [BlogController::class, 'viewBlog'])->name('view-blog');

    Route::get('/testimonials', function () {
        return view('testimonials');
    });

    Route::get('/contact', function () {
        return view('contact');
    });

    Route::get('/booking-inquiry', function () {
        return view('booking-inquiry');
    });

    Route::post('enquiry', [FormController::class, 'sendEnquiry'])->name('enquiry.submit');
});


Route::get('/login', function () {
    return view('admin.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/***********************************************
                ADMIN ROUTES START
*********************************************/

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Route::get('/profile', function () {
    //     return view('admin.profile');
    // })->name('profile');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

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
        'edit' => 'bill.edit',
        'update' => 'bill.update',
        'show' => 'bill.show',
        'destroy' => 'bill.destroy',
    ]);

    Route::resource('receipt', ReceiptController::class)->names([
        'index' => 'receipts',
        'create' => 'receipt.create',
        'store' => 'receipt.store',
        'edit' => 'receipt.edit',
        'update' => 'receipt.update',
        'show' => 'receipt.show',
        'destroy' => 'receipt.destroy',
    ]);

    Route::get('/get-customer-bills/{customerId}', [ReceiptController::class, 'getCustomerBills']);

    Route::get('/billing/customer-details', [BillController::class, 'getCustomerDetails'])->name('billing.customer.details');
    // Route::get('/booking/{id}', [BookingController::class, 'show'])->name('getBookingDetails');

    Route::get('/billing/bookings', [BookingController::class, 'getBookings'])->name('billing.getBookings');

    // Route to fetch booking details based on booking ID
    Route::get('/booking/{id}', [BookingController::class, 'getBookingDetails'])->name('booking.details');


    Route::resource('bookings', BookingController::class)->names([
        'index' => 'bookings',
        'create' => 'bookings.create',
        'store' => 'bookings.store',
        'show' => 'bookings.show',
        'edit' => 'bookings.edit',
        'update' => 'bookings.update',
        'destroy' => 'bookings.destroy',
    ]);

    Route::resource('blogs', BlogController::class)->names([
        'index' => 'blogs',
        'create' => 'blogs.create',
        'store' => 'blogs.store',
        'edit' => 'blogs.edit',
        'update' => 'blogs.update',
        'destroy' => 'blogs.destroy',
    ]);

    Route::post('blogs/update-status', [BlogController::class, 'updateStatus'])->name('blogs.update-status');

    Route::get('/bill/{bill}/pdf', [BillController::class, 'generatePDF'])->name('bill.pdf');

    Route::post('/create-party', [BookingController::class, "createBooking"])->name('create-booking');
});

/***********************************************
                ADMIN ROUTES END
*********************************************/