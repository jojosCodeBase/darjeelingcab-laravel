@extends('layouts.admin-main')
@section('title', 'Billing')
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
                                            id="validationCustom02" value="{{ $bill->bill_date }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Invoice Number</label>
                                        <input type="text" name="invoice_no" class="form-control border-bottom"
                                            id="validationCustom02" placeholder="Enter Invoice number"
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
                                                <td>{{ $data[1] }}</td>
                                                <td>{{ $data[2] }}</td>
                                                <td>{{ $data[3] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <ul style="list-style: none;float: right;">
                                        <li>
                                            <b>Sub Total:</b> ₹ <span type="text" id="totalAmountDisplay">{{ $bill->sub_total }}</span>
                                        </li>
                                        <li>
                                            <b>Discount:</b> ₹ <span type="text" id="taxDisplay">{{ $bill->discount }}</span>
                                            <input type="hidden" value="0" name="tax_amount" id="taxAmount">
                                        </li>
                                        <li>
                                            <b>Total Amount:</b> ₹ <span type="text" id="netAmountDisplay">{{ $bill->total_amount }}</span>
                                            <input type="hidden" value="0" name="net_amount" id="netAmount">
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row mt-3">
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

    <!-- Add Item Modal Start -->
    {{-- <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="item-form">
                        <div class="form-group mb-2">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="days" class="form-label">Days</label>
                            <input type="number" class="form-control" id="days" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" readonly required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="add-item-btn"
                        data-bs-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Add Item Modal End -->
@endsection
{{-- @section('scripts')
    <script>
        $(document).ready(function() {
            const itemTableBody = $('#itemTableBody');
            // const modal = new bootstrap.Modal($('#itemModal')[0]);

            $('#add-item-btn').click(function() {
                const description = $('#description').val();
                const days = $('#days').val();
                const price = $('#price').val();
                const amount = $('#amount').val();

                if (description && days && price && amount) {
                    const newRow = `
                    <tr>
                        <td>${itemTableBody.find('tr').length + 1}</td>
                        <td><input type="text" class="form-control" name="description[]" value="${description}"></td>
                        <td><input type="text" class="form-control days" name="days[]" value="${days}"></td>
                        <td><input type="text" class="form-control price" name="price[]" value="${price}"></td>
                        <td><input type="text" class="form-control amount" name="amount[]" value="${amount}" readonly></td>
                    </tr>
                `;
                    itemTableBody.append(newRow);

                    // Clear modal fields
                    $('#description, #days, #price, #amount').val('');


                    // Update totals
                    updateTotals();

                } else {
                    alert('Please fill in all fields.');
                }
            });


            // Event delegation for dynamically added elements
            itemTableBody.on('input', '.price, .days', function() {
                const row = $(this).closest('tr');
                const days = parseFloat(row.find('.days').val()) || 0;
                const price = parseFloat(row.find('.price').val()) || 0;
                const amount = days * price || 0;
                row.find('.amount').val(amount.toFixed(2));

                // Update totals after calculating amount
                updateTotals();
            });


            $('#addItemBtn').click(function() {
                // Clone the first row
                const firstRow = itemTableBody.find('tr:first');
                const newRow = firstRow.clone();

                // Clear the input fields in the new row
                newRow.find('input').val('');

                // Append the new row to the table body
                itemTableBody.append(newRow);

                // Update the serial numbers
                itemTableBody.find('tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });

                // Update totals
                updateTotals();
            });

            $('#price').on('input', function() {
                $('#amount').val($('#days').val() * $('#price').val());
            });

            function updateTotals() {
                let subtotal = 0;
                itemTableBody.find('tr').each(function() {
                    const amount = parseFloat($(this).find('.amount').val());
                    subtotal += amount;
                });

                const discount = parseFloat($('#taxAmount').val());
                const totalAmount = subtotal - discount;

                $('#totalAmountDisplay').text(subtotal.toFixed(2));
                $('#netAmountDisplay').text(totalAmount.toFixed(2));
                $('#netAmount').val(totalAmount.toFixed(2));
            }
        });
    </script>
@endsection --}}
