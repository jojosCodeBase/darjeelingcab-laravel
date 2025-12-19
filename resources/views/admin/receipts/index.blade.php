@extends('layouts.admin-main')
@section('title', 'Receipts')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div class="w-full">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <div>
                    <h4 class="text-xl font-extrabold text-gray-800 uppercase tracking-wider">Receipts</h4>
                    <p class="text-sm text-gray-500">Manage and generate payment receipts</p>
                </div>
                <a href="{{ route('receipt.create') }}"
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-semibold transition-all shadow-md active:scale-95">
                    <i class="fa fa-plus text-xs"></i> Create Receipt
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">#</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Receipt ID</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Invoice ID</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Customer Name</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Amount Paid</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Method</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Status</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($receipts as $receipt)
                                <tr class="hover:bg-gray-50 transition-colors cursor-pointer group" data-bs-toggle="modal"
                                    data-bs-target="#receiptModal" data-id="{{ $receipt->id }}"
                                    data-bill-id="{{ $receipt->bill_id }}"
                                    data-customer-name="{{ $receipt->customer->full_name }}"
                                    data-amount="{{ $receipt->amount }}"
                                    data-payment-method="{{ $receipt->payment_method }}"
                                    data-payment-status="{{ $receipt->payment_status }}"
                                    data-balance="{{ $receipt->balance }}" data-payment-date="{{ $receipt->payment_date }}">

                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-indigo-600">#{{ $receipt->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $receipt->bill_id }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $receipt->customer->full_name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                        ₹{{ number_format($receipt->amount, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-xs font-medium text-gray-500 uppercase italic">{{ $receipt->payment_method }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide 
                                {{ $receipt->payment_status == 'Paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $receipt->payment_status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900 group-hover:scale-110 transition-transform">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500 italic bg-gray-50/50">
                                        No receipts found in the database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
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
                modal.find('#receipt_id').val(id);
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
