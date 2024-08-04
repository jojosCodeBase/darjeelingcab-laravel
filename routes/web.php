<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/about-us', function () {
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
