@extends('layouts.admin-main')
@section('title', 'Bills')
@section('content')
    <div class="container-fluid p-0">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col">
                <h4 class="header-title text-uppercase">Bills</h4>
            </div>
            <div class="col-auto">
                <a href="{{ route('bill.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Bill no</th>
                            <th>Description</th>
                            <th>Dates</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Bill date</th>
                        </thead>
                        <tbody>
                            @forelse ($bills as $bill)
                                <tr onclick="window.location.href='{{ route('bill.show', ['bill' => $bill->id]) }}'" style="cursor: pointer;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="text-decoration-underline text-primary">{{ $bill->customer->full_name }}</span></td>
                                    <td>{{ $bill->customer->customer_type }}</td>
                                    <td>{{ $bill->bill_no }}</td>
                                    <td>
                                        @php
                                            $descriptions = json_decode($bill->description, true);
                                            $dates = json_decode($bill->dates, true);
                                            $price = json_decode($bill->price, true);
                                        @endphp
                                        <span>{{ $descriptions[0] }}&hellip;</span>
                                    </td>
                                    <td>{{ $dates[0] }}</td>
                                    <td>{{ $price[0] }}</td>
                                    <td>{{ $bill->total_amount }}</td>
                                    <td>{{ $bill->bill_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No bills found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
