@extends('layouts.admin-main')

@section('title', 'Booking Details')

@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="header-title text-uppercase">Booking Details</h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('bookings') }}" class="btn btn-primary">Back to Bookings</a>
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $booking->customer->full_name }}</p>
                        <p><strong>Phone:</strong> {{ $booking->customer->phone_no }}</p>
                        <p><strong>Email:</strong> {{ $booking->customer->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <p><strong>Adults:</strong> {{ $booking->adults }}</p>
                            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse(json_decode($booking->day_date)[0])->format('d M Y') }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><strong>Child:</strong> {{ $booking->child }}</p>
                            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse(json_decode($booking->day_date)[count(json_decode($booking->day_date)) - 1])->format('d M Y') }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p><strong>Infant:</strong> {{ $booking->infant }}</p>
                            <p><strong>Updated by:</strong> {{ $booking->user->name }}</p>
                        </div>
                    </div>
                </div>
                

                <!-- Itinerary -->
                <h5 class="header-title text-uppercase">Day-wise Itinerary</h5>
                <ul class="list-group mb-4">
                    @foreach (json_decode($booking->day_date, true) as $key => $date)
                        <li class="list-group-item">
                            <strong>Date:</strong> {{ $date }}<br>
                            <strong>Destination:</strong> {{ json_decode($booking->destination, true)[$key] }}
                        </li>
                    @endforeach
                </ul>

                <!-- Vehicles -->
                <h5 class="header-title text-uppercase">Vehicle Details</h5>
                <ul class="list-group">
                    @foreach (json_decode($booking->vehicle_type, true) as $key => $vehicleType)
                        <li class="list-group-item">
                            <strong>Vehicle Type:</strong> {{ $vehicleType }}<br>
                            <strong>Vehicle Number:</strong> {{ json_decode($booking->vehicle_no, true)[$key] }}<br>
                            <strong>Driver Name:</strong> {{ json_decode($booking->driver_name, true)[$key] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
