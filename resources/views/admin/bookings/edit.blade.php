@extends('layouts.admin-main')

@section('title', 'Edit Booking')

@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="header-title text-uppercase">Edit Booking</h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('bookings') }}" class="btn btn-primary">Back to Bookings</a>
                    </div>
                </div>

                <!-- Edit Booking Form -->
                <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Select Customer -->
                        <div class="col-md-6 mb-3">
                            <label for="customer" class="form-label">Select Customer</label>
                            <select name="customer_id" id="customer" class="form-control form-select" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $customer->id == $booking->customer_id ? 'selected' : '' }}>
                                        {{ $customer->full_name }} - {{ $customer->phone_no }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="adults" class="form-label">Adults</label>
                            <input type="number" name="adults" id="adults" class="form-control" value="{{ old('adults', $booking->adults) }}" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="child" class="form-label">Child</label>
                            <input type="number" name="child" id="child" class="form-control" value="{{ old('child', $booking->child) }}" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="infant" class="form-label">Infant</label>
                            <input type="number" name="infant" id="infant" class="form-control" value="{{ old('infant', $booking->infant) }}" required>
                        </div>
                    </div>

                    <!-- Dynamic Day-wise Itinerary Section -->
                    <h5 class="header-title text-uppercase mt-4">Day-wise Itinerary</h5>
                    <div id="itinerary-details">
                        @foreach (json_decode($booking->day_date, true) as $key => $date)
                            <div class="row mb-3 itinerary-item">
                                <div class="col-md-4">
                                    <label for="day_date" class="form-label">Date</label>
                                    <input type="date" name="day_date[]" class="form-control" value="{{ old('day_date.' . $key, $date) }}" required>
                                </div>
                                <div class="col-md-8">
                                    <label for="destination" class="form-label">Destination</label>
                                    <input type="text" name="destination[]" class="form-control" value="{{ old('destination.' . $key, json_decode($booking->destination, true)[$key]) }}" required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="button" class="btn btn-danger btn-sm delete-day-btn">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add More Days Button -->
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary" id="add-day-btn">Add Another Day</button>
                        </div>
                    </div>

                    <!-- Vehicle Details Section -->
                    <h5 class="header-title text-uppercase mt-4">Vehicle Details</h5>
                    <div id="vehicle-details">
                        @foreach (json_decode($booking->vehicle_type, true) as $key => $vehicleType)
                            <div class="row mb-3 vehicle-item">
                                <div class="col-md-4">
                                    <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                    <input type="text" name="vehicle_type[]" class="form-control" value="{{ old('vehicle_type.' . $key, $vehicleType) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="vehicle_no" class="form-label">Vehicle Number</label>
                                    <input type="text" name="vehicle_no[]" class="form-control" value="{{ old('vehicle_no.' . $key, json_decode($booking->vehicle_no, true)[$key]) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="driver_name" class="form-label">Driver Name</label>
                                    <input type="text" name="driver_name[]" class="form-control" value="{{ old('driver_name.' . $key, json_decode($booking->driver_name, true)[$key]) }}" required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="button" class="btn btn-danger btn-sm delete-vehicle-btn">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add More Vehicles Button -->
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary" id="add-vehicle-btn">Add Another Vehicle</button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Update Booking</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add Day Button Functionality
            document.getElementById('add-day-btn').addEventListener('click', function() {
                var dayDetails = document.getElementById('itinerary-details');
                var dayIndex = dayDetails.querySelectorAll('.itinerary-item').length;
                var newDayHtml = `
                    <div class="row mb-3 itinerary-item">
                        <div class="col-md-4">
                            <label for="day_date" class="form-label">Date</label>
                            <input type="date" name="day_date[]" class="form-control" required>
                        </div>
                        <div class="col-md-8">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" name="destination[]" class="form-control" required>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="button" class="btn btn-danger btn-sm delete-day-btn">Remove</button>
                        </div>
                    </div>
                `;
                dayDetails.insertAdjacentHTML('beforeend', newDayHtml);
            });

            // Add Vehicle Button Functionality
            document.getElementById('add-vehicle-btn').addEventListener('click', function() {
                var vehicleDetails = document.getElementById('vehicle-details');
                var vehicleIndex = vehicleDetails.querySelectorAll('.vehicle-item').length;
                var newVehicleHtml = `
                    <div class="row mb-3 vehicle-item">
                        <div class="col-md-4">
                            <label for="vehicle_type" class="form-label">Vehicle Type</label>
                            <input type="text" name="vehicle_type[]" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="vehicle_no" class="form-label">Vehicle Number</label>
                            <input type="text" name="vehicle_no[]" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="driver_name" class="form-label">Driver Name</label>
                            <input type="text" name="driver_name[]" class="form-control" required>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="button" class="btn btn-danger btn-sm delete-vehicle-btn">Remove</button>
                        </div>
                    </div>
                `;
                vehicleDetails.insertAdjacentHTML('beforeend', newVehicleHtml);
            });

            // Delete Day Functionality
            document.getElementById('itinerary-details').addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-day-btn')) {
                    event.target.closest('.itinerary-item').remove();
                }
            });

            // Delete Vehicle Functionality
            document.getElementById('vehicle-details').addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-vehicle-btn')) {
                    event.target.closest('.vehicle-item').remove();
                }
            });
        });
    </script>
    @endsection
@endsection
