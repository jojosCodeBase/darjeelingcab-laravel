@extends('layouts.admin-main')
@section('title', 'View Bill')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center d-flex justify-content-between">
                            <div class="col">
                                <h4 class="header-title text-uppercase">View Bill</h4>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('bill.edit', ['bill' => $bill->id]) }}" class="btn btn-primary">Edit</a>
                                <button type="button" id="generatePdfBtn" class="btn btn-danger" onclick="window.location.href='{{ route('bill.pdf', ['bill' => $bill->id]) }}'">Generate PDF</button>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('bill.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Customer</label>
                                        <select class="form-select border-bottom" name="party_id" id="validationCustom01"
                                            disabled>
                                            <option value="">Please select</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ $customer->id == $bill->customer_id ? 'selected' : '' }}>
                                                    {{ $customer->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Invoice Date</label>
                                        <input type="date" name="invoice_date" class="form-control border-bottom"
                                            value="{{ $bill->bill_date }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Invoice Number</label>
                                        <input type="text" name="invoice_no" class="form-control border-bottom"
                                            placeholder="Enter Invoice number"
                                            value="{{ $bill->bill_no }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center d-flex justify-content-between">
                                <div class="col">
                                    <h4 class="header-title text-uppercase">Item Details</h4>
                                </div>
                            </div>
                            <hr>

                            <div class="row table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th class="w-50">Description</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $descriptions = json_decode($bill->description, true);
                                        $dates = json_decode($bill->dates, true);
                                        $price = json_decode($bill->price, true);
                                        $amount = json_decode($bill->amount, true);
                                        $combined = array_map(null, $descriptions, $dates, $price, $amount);
                                    @endphp
                                    <tbody id="itemTableBody">
                                        @foreach ($combined as $index => $data)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $data[0] }} <br>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($data[1])->format('D - d M, Y') }}
                                                </td>
                                                <td>₹ {{ number_format($data[2]) }}</td>
                                                <td>
                                                    ₹ {{ number_format($data[3]) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <ul style="list-style: none;float: right;">
                                        <li>
                                            <b>Total Amount:</b> ₹ <span type="text" id="totalAmount">{{ number_format($bill->total_amount, 2, '.', ',') }}</span>
                                        </li>
                                        <li>
                                            <b>Received Amount:</b> ₹ <span type="text" id="receivedAmount">{{ number_format($bill->received_amount, 2, '.', ',') }}</span>
                                        </li>
                                        <li>
                                            <b>Balance Due:</b> ₹ <span type="text" id="balanceDue">{{ number_format($bill->balance_due, 2, '.', ',') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mt-3 d-none">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-right mb-2">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
