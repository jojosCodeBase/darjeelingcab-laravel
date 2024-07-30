@extends('layouts.main')
@section('title', 'Booking Inquiry')
<style>
    .booking-section {
        background-color: #f9f9f9;
        padding: 40px 0;
    }

    .booking-form {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .booking-form h3 {
        font-weight: 700;
        color: #2c3e50;
    }

    .form-group label {
        color: #2c3e50;
    }

    .form-control {
        border-radius: 5px;
        border-color: #ced4da;
    }

    .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }
</style>
@section('content')
    <div class="container mt-5 booking-section">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="booking-form">
                    <h3 class="mb-4 text-center">Booking Inquiry Form</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="from_location">From Location</label>
                            <input type="text" class="form-control" id="from_location" name="from_location" placeholder="Enter the starting location" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="to_location">To Location</label>
                            <input type="text" class="form-control" id="to_location" name="to_location" placeholder="Enter the destination location" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="ride_date">Ride Date</label>
                            <input type="date" class="form-control" id="ride_date" name="ride_date" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="no_of_persons">Number of Persons</label>
                            <input type="number" class="form-control" id="no_of_persons" name="no_of_persons" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
