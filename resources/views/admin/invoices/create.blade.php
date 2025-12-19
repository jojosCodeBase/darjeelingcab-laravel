@extends('layouts.admin-main')

@section('title', 'Billing')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title text-uppercase">Generate Bill</h4>
                        <hr>
                        <form action="{{ route('bill.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <!-- Customer Select -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Customer <span class="text-danger">*</span></label>
                                        <select class="form-select border-bottom" name="party_id" id="customerSelect"
                                            required>
                                            <option value="">Please select</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->full_name }} -
                                                    {{ $customer->phone_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Booking Select -->
                                <div class="col-md-4" id="bookingSelectContainer" style="display: none;">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Booking <span class="text-danger">*</span></label>
                                        <select class="form-select border-bottom" name="booking_id" id="bookingSelect"
                                            required>
                                            <!-- Options will be populated by JavaScript -->
                                        </select>
                                    </div>
                                </div>

                                <!-- Invoice Date -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Invoice Date <span class="text-danger">*</span></label>
                                        <input type="date" name="invoice_date" id="invoice_date"
                                            class="form-control border-bottom"
                                            value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
                                    </div>
                                </div>

                                <!-- Invoice Number -->
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Invoice Number <span class="text-danger">*</span></label>
                                        <input type="text" name="invoice_no" class="form-control border-bottom"
                                            placeholder="Enter Invoice number" value="DC-{{ date('Y') }}-" required>
                                    </div>
                                </div>

                                <!-- Payment Status -->
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                                        <select name="payment_status" id="" class="form-select" required>
                                            <option value="" selected>Select payment status</option>
                                            <option value="advance-paid">Advance paid</option>
                                            <option value="unpaid">Unpaid</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Vehicle Details</label>
                                        <div id="vehicle_details">
                                            {{-- result will be rendered here --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Itinerary Table -->
                            <div class="row align-items-center d-flex justify-content-between">
                                <div class="col">
                                    <h4 class="header-title text-uppercase">Item Details</h4>
                                </div>
                                <div class="col-auto">
                                    <button type="button" id="addItemBtn" class="btn btn-primary"
                                        data-bs-target="#itemModal" data-bs-toggle="modal">Add item</button>
                                </div>
                            </div>
                            <hr>

                            <div class="row table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th>Description</th>
                                            <th>Dates</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemTableBody">
                                        {{-- dynamic table contents --}}
                                    </tbody>
                                </table>
                            </div>

                            <!-- Totals -->
                            <div class="row">
                                <div class="col">
                                    <ul style="list-style: none; float: right;">
                                        <li>
                                            <b>Total Amount:</b> ₹ <span id="total">0</span>
                                            <input type="hidden" value="0" name="total">
                                        </li>
                                        <li>
                                            <b>Received Amount:</b> ₹ <input type="number" class="form-control"
                                                id="received_amount" name="received_amount" value="0" min="0">
                                        </li>
                                        <li>
                                            <b>Balance Due:</b> ₹ <span id="balance_due">0</span>
                                            <input type="hidden" value="0" name="balance_due">
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Submit Button -->
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
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel"
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
                            <label for="dates" class="form-label">Date</label>
                            <input type="date" class="form-control" id="dates" required>
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
    </div>
    <!-- Add Item Modal End -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#customerSelect').change(function() {
                const customerId = $(this).val();
                if (customerId) {
                    $.get('{{ route('billing.getBookings') }}', {
                        customer_id: customerId
                    }, function(data) {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            const bookings = data.bookings;
                            const bookingSelect = $('#bookingSelect');
                            $('#bookingSelectContainer').show();
                            bookingSelect.empty();
                            if (bookings.length > 0) {
                                bookingSelect.append('<option value="">Select Booking</option>');
                                bookings.forEach(booking => {
                                    var dayDateArray = JSON.parse(booking.day_date);
                                    bookingSelect.append(
                                        `<option value="${booking.id}">${booking.id} - ${dayDateArray[0]}</option>`
                                    );
                                });
                            } else {
                                bookingSelect.append('<option value="">No bookings found</option>');
                            }
                        }
                    });
                } else {
                    $('#bookingSelectContainer').hide();
                }
            });

            $('#bookingSelect').change(function() {

                const bookingId = $(this).val();

                if (bookingId) {
                    const url = `/admin/booking/${bookingId}`;
                    $.get(url, function(booking) {
                        populateForm(booking);
                    });
                }
            });

            function convertYmdToDmy(dateStr) {
                const parts = dateStr.split("-");
                return `${parts[2]}-${parts[1]}-${parts[0]}`;
            }


            function populateForm(booking) {
                // Populate form fields with booking data
                // $('#invoice_date').val(booking.created_at.split(' ')[0]); 

                // Clear existing rows
                $('#itemTableBody').empty();

                // Parse itinerary data
                const dayDates = JSON.parse(booking.day_date);
                const destinations = JSON.parse(booking.destination);
                const vehicleTypes = JSON.parse(booking.vehicle_type);
                const vehicleNumbers = JSON.parse(booking.vehicle_no);
                const driverNames = JSON.parse(booking.driver_name);

                if (
                    (booking.vehicle_type === "[null]") ||
                    (booking.vehicle_no === "[null]") ||
                    (booking.driver_name === "[null]")
                ) {

                    $('#vehicle_details').val('NA');

                } else {

                    $('#vehicle_details').html('');

                    let result_div = document.createElement('div');

                    let html = '';

                    vehicleNumbers.forEach((item, index) => {
                        const vehicleType = vehicleTypes[index] || '';
                        const vehicleNumber = vehicleNumbers[index] || '';
                        const driverName = driverNames[index] || '';

                        let vehicleObject = {
                            type: vehicleType,
                            number: vehicleNumber,
                            driver: driverName
                        };

                        // Convert JS object to JSON string
                        let vehicleJSON = JSON.stringify(vehicleObject);

                        html += `
                            <input type="text" name="vehicle_details[]" value='${vehicleJSON}' hidden>
                            <div class="mb-2 p-2 border rounded">
                                <p class='mb-0'><strong>Vehicle Type:</strong> ${vehicleType}</p>
                                <p class='mb-0'><strong>Driver:</strong> ${driverName}</p>
                                <p class='mb-0'><strong>Vehicle No:</strong> ${vehicleNumber}</p>
                            </div>
                        `;
                    });

                    result_div.innerHTML = html;

                    $('#vehicle_details').append(result_div);
                }

                dayDates.forEach((date, index) => {
                    const destination = destinations[index] || '';
                    const vehicleType = vehicleTypes[index] || '';
                    const vehicleNumber = vehicleNumbers[index] || '';
                    const driverName = driverNames[index] || '';

                    let formatted_date = convertYmdToDmy(date);

                    // Add a row to the table for each itinerary item
                    $('#itemTableBody').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                <input type="text" class="form-control" name="description[]" value="${destination}" hidden>
                                <p>${destination}</p>
                            </td>
                            <td>
                                <input type="date" class="form-control dates" name="dates[]" value="${date}" hidden>
                                <p>${formatted_date}</p>
                            </td>
                            <td><input type="number" class="form-control price" name="price[]" value="0" min="0"></td>
                            <td><input type="number" class="form-control amount" name="amount[]" value="0" readonly></td>
                        </tr>
                    `);
                });

                // Update totals initially
                updateTotals();
            }

            $('#add-item-btn').click(function() {
                const description = $('#description').val();
                const dates = $('#dates').val();
                const price = $('#price').val();
                const amount = $('#amount').val();

                if (description && price && amount) {
                    const newRow = `
                        <tr>
                            <td>${$('#itemTableBody tr').length + 1}</td>
                            <td><input type="text" class="form-control" name="description[]" value="${description}"></td>
                            <td><input type="date" class="form-control dates" name="dates[]" value="${dates}"></td>
                            <td><input type="number" class="form-control price" name="price[]" value="${price}"></td>
                            <td><input type="number" class="form-control amount" name="amount[]" value="${amount}" readonly></td>
                        </tr>
                    `;
                    $('#itemTableBody').append(newRow);

                    // Clear input fields
                    $('#description, #dates, #price, #amount').val('');

                    // Update totals after adding new item
                    updateTotals();
                } else {
                    alert('Please fill in all fields.');
                }
            });

            $('#price').on('input', function() {
                $('#amount').val($('#price').val()); // Set amount to be equal to price
            });

            $('#received_amount').on('input', function() {
                updateTotals(); // Update totals when received_amount changes
            });

            $(document).on('input', '.price', function() {
                // Get the current row (tr) where the price input exists
                const currentRow = $(this).closest('tr');

                // Get the value from the current price input
                const currentPrice = $(this).val();

                // Update the amount input in the same row
                currentRow.find('.amount').val(currentPrice);

                // Update totals after calculating amount
                updateTotals();
            });

            function updateTotals() {
                let total = 0;

                $('#itemTableBody tr').each(function() {
                    const amount = parseFloat($(this).find('.amount').val()) || 0;
                    total += amount;
                });

                const received_amount = parseFloat($('#received_amount').val()) || 0;
                const balanceAmount = total - received_amount;

                $('#total').text(
                    total.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })
                );

                $('#balance_due').text(
                    balanceAmount.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })
                );

                $('input[name="total"]').val(total.toFixed(2));
                $('input[name="balance_due"]').val(balanceAmount.toFixed(2));

                $('#itemTableBody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            }
        });
    </script>
@endsection
