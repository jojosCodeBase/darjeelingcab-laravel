@extends('layouts.admin-main')
@section('title', 'Create Booking')
@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-uppercase">Create New Booking</h4>

                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Select Customer -->
                        <div class="col-md-6 mb-3">
                            <label for="customer" class="form-label">Select Customer</label>
                            <select name="customer_id" id="customer" class="form-control form-select" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->full_name }} - {{ $customer->phone_no }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="adults" class="form-label">Adults</label>
                            <input type="number" name="adults" id="adults" class="form-control" placeholder="2"
                                value="{{ old('adults', 2) }}" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="child" class="form-label">Child</label>
                            <input type="number" name="child" id="child" class="form-control" placeholder="1"
                                value="{{ old('child', 1) }}" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="infant" class="form-label">Infant</label>
                            <input type="number" name="infant" id="infant" class="form-control" placeholder="0"
                                value="{{ old('infant', 0) }}" required>
                        </div>
                    </div>

                    <!-- Dynamic Day-wise Itinerary Section -->
                    <h5 class="header-title text-uppercase mt-4">Day-wise Itinerary</h5>
                    <div id="itinerary-details">
                        @php
                            $day_dates = old('day_date', ['']);
                            $destinations = old('destination', ['']);
                        @endphp
                        @foreach ($day_dates as $index => $day_date)
                            <div class="row mb-3 itinerary-item">
                                <div class="col-md-4 mb-3">
                                    <label for="day_date" class="form-label">Date</label>
                                    <input type="date" name="day_date[]" class="form-control" value="{{ $day_date }}"
                                        required>
                                </div>
                                <div class="col-md-8">
                                    <label for="destination" class="form-label">Description</label>
                                    <input type="text" name="destination[]" class="form-control"
                                        value="{{ $destinations[$index] ?? '' }}"
                                        placeholder="E.g. Pickup from Bagdogra and drop to Darjeeling via Lamahatta Sightseeing"
                                        required>
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
                        @php
                            $vehicle_types = old('vehicle_type', ['']);
                            $vehicle_nos = old('vehicle_no', ['']);
                            $driver_names = old('driver_name', ['']);
                        @endphp
                        @foreach ($vehicle_types as $index => $vehicle_type)
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                    <input type="text" name="vehicle_type[]" class="form-control"
                                        placeholder="E.g. INNOVA" value="{{ $vehicle_type }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="vehicle_no" class="form-label">Vehicle Number</label>
                                    <input type="text" name="vehicle_no[]" class="form-control text-uppercase"
                                        placeholder="E.g. WB 76 A 0143" value="{{ $vehicle_nos[$index] ?? '' }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="driver_name" class="form-label">Driver Name</label>
                                    <input type="text" name="driver_name[]" class="form-control"
                                        placeholder="E.g. Lokesh Gurung" value="{{ $driver_names[$index] ?? '' }}"
                                        required>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add More Vehicles Button -->
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary" id="add-vehicle-btn">Add Another
                                Vehicle</button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Create Booking</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add more day-wise itinerary
        $('#add-day-btn').click(function() {
            var dayDetailHtml = `
                <div class="row mb-3 itinerary-item">
                    <div class="col-md-4 mb-3">
                        <label for="day_date" class="form-label">Date</label>
                        <input type="date" name="day_date[]" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" name="destination[]" class="form-control" placeholder="E.g. Pickup from Bagdogra and drop to Darjeeling via Lamahatta Sightseeing" required>
                    </div>
                </div>`;
            $('#itinerary-details').append(dayDetailHtml);
        });

        // Add more vehicle details
        $('#add-vehicle-btn').click(function() {
            var vehicleDetailHtml = `
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="vehicle_type" class="form-label">Vehicle Type</label>
                        <input type="text" name="vehicle_type[]" class="form-control" placeholder="E.g. INNOVA" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="vehicle_no" class="form-label">Vehicle Number</label>
                        <input type="text" name="vehicle_no[]" class="form-control" placeholder="E.g. WB 76 A 0143 " required>
                    </div>
                    <div class="col-md-4">
                        <label for="driver_name" class="form-label">Driver Name</label>
                        <input type="text" name="driver_name[]" class="form-control" placeholder="E.g. Lokesh Gurung" required>
                    </div>
                </div>`;
            $('#vehicle-details').append(vehicleDetailHtml);
        });
    </script>
@endsection
