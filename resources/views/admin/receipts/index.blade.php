@extends('layouts.admin-main')
@section('title', 'Receipts')
@section('content')
    <div class="container-fluid p-0">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col">
                <h4 class="header-title text-uppercase">Receipts</h4>
            </div>
            <div class="col-auto">
                <a href="{{ route('receipt.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Receipt ID</th>
                            <th>Invoice ID</th>
                            <th>Customer Name</th>
                            <th>Amount Paid</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Balance Due</th>
                            <th>Payment Date</th>
                        </thead>
                        <tbody>
                            @forelse ($receipts as $receipt)
                                <tr style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#receiptModal"
                                    data-id="{{ $receipt->id }}"
                                    data-bill-id="{{ $receipt->bill_id }}"
                                    data-customer-name="{{ $receipt->customer->full_name }}"
                                    data-amount="{{ $receipt->amount }}"
                                    data-payment-method="{{ $receipt->payment_method }}"
                                    data-payment-status="{{ $receipt->payment_status }}"
                                    data-balance="{{ $receipt->balance }}"
                                    data-payment-date="{{ $receipt->payment_date }}" class="cursor">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $receipt->id }}</td>
                                    <td>{{ $receipt->bill_id }}</td>
                                    <td>{{ $receipt->customer->full_name }}</td>
                                    <td>{{ $receipt->amount }}</td>
                                    <td>{{ $receipt->payment_method }}</td>
                                    <td>{{ $receipt->payment_status }}</td>
                                    <td>{{ $receipt->balance }}</td>
                                    <td>{{ $receipt->payment_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No receipts found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Receipt Modal -->
        <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="receiptModalLabel">Receipt Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Receipt ID:</strong> <span id="modal-receipt-id"></span></p>
                        <p><strong>Invoice ID:</strong> <span id="modal-bill-id"></span></p>
                        <p><strong>Customer Name:</strong> <span id="modal-customer-name"></span></p>
                        <p><strong>Amount Paid:</strong> <span id="modal-amount-paid"></span></p>
                        <p><strong>Payment Method:</strong> <span id="modal-payment-method"></span></p>
                        <p><strong>Payment Status:</strong> <span id="modal-payment-status"></span></p>
                        <p><strong>Balance Due:</strong> <span id="modal-balance-due"></span></p>
                        <p><strong>Payment Date:</strong> <span id="modal-payment-date"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#receiptModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var billId = button.data('bill-id');
                var customerName = button.data('customer-name');
                var amount = button.data('amount');
                var paymentMethod = button.data('payment-method');
                var paymentStatus = button.data('payment-status');
                var balance = button.data('balance');
                var paymentDate = button.data('payment-date');

                var modal = $(this);
                modal.find('#modal-receipt-id').text(id);
                modal.find('#modal-bill-id').text(billId);
                modal.find('#modal-customer-name').text(customerName);
                modal.find('#modal-amount-paid').text(amount);
                modal.find('#modal-payment-method').text(paymentMethod);
                modal.find('#modal-payment-status').text(paymentStatus);
                modal.find('#modal-balance-due').text(balance);
                modal.find('#modal-payment-date').text(paymentDate);
            });
        });
    </script>
@endsection
