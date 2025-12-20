<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EnquiriesController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TourEnquiriesController;
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
    Route::get('/{any}.html', function () {
        return redirect('/');
    })->where('any', '.*');

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

    Route::post('contact-submit', [FormController::class, 'contactUs'])->name('contact-form-submit');

    Route::get('places-of-interest');
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

    Route::resource('customers', CustomerController::class)->names([
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

    Route::post('/generate-receipt', [ReceiptController::class, 'generateReceipt'])->name('generate-receipt');

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

    Route::resource('invoices', InvoiceController::class)->names([
        'index' => 'invoices',
        'create' => 'invoice.create',
        'store' => 'invoice.store',
        'edit' => 'invoice.edit',
        'update' => 'invoice.update',
        'show' => 'invoice.show',
        'destroy' => 'invoice.destroy'
    ]);

    Route::resource('enquiries', EnquiriesController::class)->names([
        'index' => 'enquiries'
    ]);

    Route::resource('tour-enquiries', TourEnquiriesController::class)->names([
        'index' => 'tour-enquiries'
    ]);

    Route::get('settings', function () {
        return view('admin.settings');
    })->name('settings');

    Route::post('blogs/update-status', [BlogController::class, 'updateStatus'])->name('blogs.update-status');

    Route::get('/bill/{bill}/pdf', [BillController::class, 'generatePDF'])->name('bill.pdf');

    Route::get('/invoice/{invoice}/pdf', [BillController::class, 'generatePDF'])->name('invoice.pdf');

    Route::get('/invoice/instant', [InvoiceController::class, 'instant_invoice'])->name('invoice.instant');

    Route::post('/invoice/instant', [InvoiceController::class, 'store_instant'])->name('invoice.store_instant');

    Route::put('/invoice/instant/{invoice}', [InvoiceController::class, 'update_instant'])->name('invoice.update-instant');

    Route::post('/create-party', [BookingController::class, "createBooking"])->name('create-booking');
});

/***********************************************
                ADMIN ROUTES END
*********************************************/