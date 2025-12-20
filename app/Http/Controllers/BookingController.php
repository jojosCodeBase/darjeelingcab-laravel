<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('user', 'customer')->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('full_name')->get();
        return view('admin.bookings.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pax' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'day_date.*' => 'required|date',
            'destination.*' => 'required|string|max:255',
            'vehicle_type.*' => 'nullable|string|max:255',
            'vehicle_no.*' => 'nullable|string|max:255',
            'driver_name.*' => 'nullable|string|max:255',
        ]);

        try {

            $dayDates = json_encode($request->input('day_date'));
            $destinations = json_encode($request->input('destination'));
            $vehicleTypes = json_encode($request->input('vehicle_type'));
            $vehicleArray = $request->input('vehicle_no');
            $vehicleNos = json_encode(array_map('strtoupper', $vehicleArray));
            $driverNames = json_encode($request->input('driver_name'));

            Booking::create([
                'customer_id' => $request->input('customer_id'),
                'created_by' => Auth::id(), // Get the ID of the authenticated user
                'pax' => $request->input('pax'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'day_date' => $dayDates,
                'destination' => $destinations,
                'vehicle_type' => $vehicleTypes,
                'vehicle_no' => $vehicleNos,
                'driver_name' => $driverNames,
            ]);

            return redirect()->route('bookings')->with('success', 'Booking created successfully');
        } catch (\Exception $e) {
            \Log::error("Failed to create booking -- " . $e->getMessage());
            return redirect()->route('bookings')->withErrors('Failed to create booking')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $customers = Customer::all();
        return view('admin.bookings.edit', compact('booking', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'pax' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'day_date.*' => 'required|date',
            'destination.*' => 'required|string',
            'vehicle_type.*' => 'required|string',
            'vehicle_no.*' => 'required|string',
            'driver_name.*' => 'required|string',
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            // Update the booking record
            $booking->customer_id = $request->input('customer_id');
            $booking->pax = $request->input('pax');
            $booking->start_date = $request->input('start_date');
            $booking->end_date = $request->input('end_date');
            $booking->day_date = json_encode($request->input('day_date'));
            $booking->destination = json_encode($request->input('destination'));
            $booking->vehicle_type = json_encode($request->input('vehicle_type'));
            $vehicleArray = $request->input('vehicle_no');
            $booking->vehicle_no = json_encode(array_map('strtoupper', $vehicleArray));
            $booking->driver_name = json_encode($request->input('driver_name'));
            $booking->created_by = Auth::id();

            // Save the changes
            $booking->save();

            // Redirect back to the bookings with a success message
            return redirect()->route('bookings')->with('success', 'Booking updated successfully.');

        } catch (\Exception $e) {
            \Log::error("Failed to update booking -- " . $e->getMessage());
            return redirect()->route('bookings')->withErrors('Failed to update booking')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function getBookings(Request $request)
    {
        $customerId = $request->input('customer_id');
        $bookings = Booking::where('customer_id', $customerId)->get();

        return response()->json(['bookings' => $bookings]);
    }

    // Controller method to get booking details
    public function getBookingDetails($bookingId)
    {
        $booking = Booking::with('customer', 'user')->findOrFail($bookingId);

        // dd($booking);

        return response()->json($booking);
    }
}
