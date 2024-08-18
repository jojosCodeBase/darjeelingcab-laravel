@extends('layouts.admin-main')

@section('title', 'Manage Bookings')

@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3 d-flex justify-content-between">
                    <div class="col">
                        <h4 class="header-title text-uppercase">All Bookings</h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add Booking</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Adults</th>
                                <th>Child</th>
                                <th>Infant</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Vehicle Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                            @php
                                    $dayDates = json_decode($booking->day_date, true);
                                    $startDate = isset($dayDates[0]) ? $dayDates[0] : 'N/A';
                                    $endDate = isset($dayDates[count($dayDates) - 1]) ? $dayDates[count($dayDates) - 1] : 'N/A';
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->customer->full_name }}</td>
                                    <td>{{ $booking->adults }}</td>
                                    <td>{{ $booking->child }}</td>
                                    <td>{{ $booking->infant }}</td>
                                    <td>{{ $startDate }}</td>
                                    <td>{{ $endDate }}</td>
                                    <td>{{ implode(', ', json_decode($booking->vehicle_type)) }}</td>
                                    <td>
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info"><i class="align-middle" data-feather="eye"></i></a>
                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-success"><i class="align-middle" data-feather="edit"></i></a>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure, you want to delete this booking?')"><i class="align-middle" data-feather="trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No bookings found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
