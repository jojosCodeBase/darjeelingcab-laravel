<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function addBooking(){
        return view('add-customer');
    }
    public function bookings(){
        $customers = Booking::all();
        return view('customers', compact('customers'));
    }
    public function createBooking(Request $request)
    {
        $request->validate([
            'party_type' => 'required',
            'full_name' => 'required|string|min:2|max:20',
            'phone_no' => 'required',
            'address' => 'required|max:255',
            'booking_date' => 'required|date',
            'persons' => 'required|numeric|min:1',
            'vehicle_type' => 'required|max:255',
            'days' => 'required|numeric|min:1',
            'pickup_point' => 'required|max:255',
            'drop_point' => 'required|max:255',
        ]);

        $param = $request->all();

        // Remove token from post data before inserting
        unset($param['_token']);

        Booking::create($param);

        return back()->withSuccess("Booking created successfully");
    }
}
