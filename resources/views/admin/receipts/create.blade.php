@extends('layouts.admin-main')
@section('title', 'Add Receipt')
@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-uppercase mb-3">New Receipt Details</h4>
                <form class="needs-validation" method="post" action="{{ route('receipt.store') }}">
                    @csrf
                    <div class="row">
                        <!-- Customer Field -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="customer_id" class="form-label">Customer <span
                                        class="text-danger">*</span></label>
                                <select name="customer_id" class="form-select border-bottom" id="customer_id" required>
                                    <option value="">Please select</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            @if (old('customer_id') == $customer->id) selected @endif>
                                            {{ $customer->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Bill ID Field -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="bill_id" class="form-label">Bill ID <span class="text-danger">*</span></label>
                                <select name="bill_id" class="form-select border-bottom" id="bill_id" disabled required>
                                    <option value="">Please select</option>
                                    {{-- Options will be dynamically populated --}}
                                </select>
                            </div>
                        </div>

                        <!-- Bill Amount Field (Disabled) -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="bill_amount" class="form-label">Bill Amount</label>
                                <input type="text" id="bill_amount" class="form-control border-bottom" disabled>
                            </div>
                        </div>

                        <!-- Amount Paid Field -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="amount" class="form-label">Amount Paid <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="amount" value="{{ old('amount') }}"
                                    class="form-control border-bottom" id="amount" placeholder="Enter amount paid"
                                    required>
                            </div>
                        </div>

                        <!-- Balance Due Field (Disabled) -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="balance_due" class="form-label">Balance Due</label>
                                <input type="text" id="balance_due" class="form-control border-bottom" disabled>
                                <input type="hidden" id="balance_due_hidden" name="balance">
                            </div>
                        </div>

                        <!-- Payment Method Field -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="payment_method" class="form-label">Payment Method <span
                                        class="text-danger">*</span></label>
                                <select name="payment_method" class="form-select border-bottom" id="payment_method"
                                    required>
                                    <option value="">Please select</option>
                                    <option value="Credit Card" @if (old('payment_method') == 'Credit Card') selected @endif>Credit
                                        Card</option>
                                    <option value="Cash" @if (old('payment_method') == 'Cash') selected @endif>Cash</option>
                                    <option value="Bank Transfer" @if (old('payment_method') == 'Bank Transfer') selected @endif>Bank
                                        Transfer</option>
                                    <option value="UPI" @if (old('payment_method') == 'UPI') selected @endif>UPI</option>
                                </select>
                            </div>
                        </div>

                        <!-- Payment Status Field -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="payment_status" class="form-label">Payment Status <span
                                        class="text-danger">*</span></label>
                                <select name="payment_status" class="form-select border-bottom" id="payment_status"
                                    required>
                                    <option value="">Please select</option>
                                    <option value="Full Paid" @if (old('payment_status') == 'Full Paid') selected @endif>Full Paid
                                    </option>
                                    <option value="Advance Paid" @if (old('payment_status') == 'Advance Paid') selected @endif>Advance
                                        Paid</option>
                                    <option value="Failed" @if (old('payment_status') == 'Failed') selected @endif>Failed</option>
                                </select>
                            </div>
                        </div>

                        <!-- Payment Date Field -->
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="payment_date" class="form-label">Payment Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="payment_date"
                                    value="{{ old('payment_date', \Carbon\Carbon::today()->format('Y-m-d')) }}"
                                    class="form-control border-bottom" id="payment_date" required>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            const $customerSelect = $('#customer_id');
            const $billSelect = $('#bill_id');
            const $amountPaidInput = $('#amount');
            const $billAmountInput = $('#bill_amount');
            const $balanceDueInput = $('#balance_due');
            const $balanceDueHiddenInput = $('#balance_due_hidden');
            const $paymentStatusSelect = $('#payment_status');

            $customerSelect.on('change', function() {
                const customerId = $(this).val();
                if (!customerId) return; // Do nothing if no customer is selected

                $.ajax({
                    url: `/admin/get-customer-bills/${customerId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Response Data:', data);
                        if (data.bills && data.bills.length) {
                            $billSelect.empty().append(
                                '<option value="">Please select</option>');
                            $.each(data.bills, function(index, bill) {
                                console.log('Appending Bill ID:', bill.id);
                                $billSelect.append(
                                    `<option value="${bill.id}" data-amount="${bill.total_amount}">${bill.id}</option>`
                                );
                            });
                            $billSelect.prop('disabled', false);
                            console.log('Bill Select HTML:', $billSelect.html());
                        } else {
                            $billSelect.empty().append(
                                '<option value="">No bills found</option>').prop('disabled',
                                true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching bills:', error);
                    }
                });
            });

            $billSelect.on('change', function() {
                const $selectedOption = $(this).find('option:selected');
                const billAmount = $selectedOption.data('amount');
                $billAmountInput.val(billAmount);
                calculateBalanceDue();
            });

            $amountPaidInput.on('input', calculateBalanceDue);

            $paymentStatusSelect.on('change', function() {
                if ($(this).val() === 'Full Paid') {
                    const billAmount = parseFloat($billAmountInput.val() || 0);
                    $amountPaidInput.val(billAmount);
                    $balanceDueInput.val(0);
                    $amountPaidInput.prop('disabled', true);
                } else {
                    $amountPaidInput.prop('disabled', false);
                    calculateBalanceDue();
                }
            });

            function calculateBalanceDue() {
                const billAmount = parseFloat($billAmountInput.val() || 0);
                const amountPaid = parseFloat($amountPaidInput.val() || 0);
                const balanceDue = billAmount - amountPaid;
                $balanceDueInput.val(balanceDue.toFixed(2));
                $balanceDueHiddenInput.val(balanceDue.toFixed(2));
            }
        });
    </script>
@endsection
