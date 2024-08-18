<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $customers = Customer::count();
        $bookings = Booking::count();
        $visits = Visit::first()->count;
        return view('admin.dashboard', compact('customers', 'bookings','visits'));
    }
}
