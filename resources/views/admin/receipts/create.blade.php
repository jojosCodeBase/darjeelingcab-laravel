@extends('layouts.admin-main')
@section('title', 'Add Receipt')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <h4 class="text-xl font-extrabold text-gray-800 uppercase tracking-wider">New Receipt Details</h4>
                    <p class="text-sm text-gray-500 mt-1">Record a new payment transaction for an existing bill.</p>
                </div>

                <div class="p-8">
                    <form class="space-y-6" method="post" action="{{ route('receipt.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6">

                            <div class="flex flex-col">
                                <label for="customer_id" class="text-sm font-semibold text-gray-700 mb-2">
                                    Customer <span class="text-red-500">*</span>
                                </label>
                                <select name="customer_id" id="customer_id" required
                                    class="w-full bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-0 focus:border-indigo-600 block p-2.5 transition-colors outline-none appearance-none">
                                    <option value="">Please select</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label for="bill_id" class="text-sm font-semibold text-gray-700 mb-2">
                                    Bill ID <span class="text-red-500">*</span>
                                </label>
                                <select name="bill_id" id="bill_id" disabled required
                                    class="w-full bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-0 focus:border-indigo-600 block p-2.5 transition-colors outline-none disabled:opacity-50 disabled:bg-gray-100 cursor-not-allowed">
                                    <option value="">Please select</option>
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label for="bill_amount" class="text-sm font-semibold text-gray-700 mb-2">Bill
                                    Amount</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">₹</span>
                                    <input type="text" id="bill_amount" disabled
                                        class="w-full pl-7 bg-gray-100 border-b-2 border-gray-200 text-gray-500 text-sm rounded-t-lg block p-2.5 outline-none cursor-not-allowed font-medium">
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <label for="amount" class="text-sm font-semibold text-gray-700 mb-2">
                                    Amount Paid <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold">₹</span>
                                    <input type="text" name="amount" id="amount" value="{{ old('amount') }}"
                                        placeholder="0.00" required
                                        class="w-full pl-7 bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-0 focus:border-green-600 block p-2.5 transition-colors outline-none font-bold">
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <label for="balance_due" class="text-sm font-semibold text-gray-700 mb-2">Balance
                                    Due</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">₹</span>
                                    <input type="text" id="balance_due" disabled
                                        class="w-full pl-7 bg-gray-100 border-b-2 border-gray-200 text-red-500 text-sm rounded-t-lg block p-2.5 outline-none cursor-not-allowed font-bold">
                                    <input type="hidden" id="balance_due_hidden" name="balance">
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <label for="payment_method" class="text-sm font-semibold text-gray-700 mb-2">
                                    Payment Method <span class="text-red-500">*</span>
                                </label>
                                <select name="payment_method" id="payment_method" required
                                    class="w-full bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-0 focus:border-indigo-600 block p-2.5 transition-colors outline-none appearance-none">
                                    <option value="">Please select</option>
                                    <option value="Credit Card"
                                        {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash
                                    </option>
                                    <option value="Bank Transfer"
                                        {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer
                                    </option>
                                    <option value="UPI" {{ old('payment_method') == 'UPI' ? 'selected' : '' }}>UPI
                                    </option>
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label for="payment_status" class="text-sm font-semibold text-gray-700 mb-2">
                                    Payment Status <span class="text-red-500">*</span>
                                </label>
                                <select name="payment_status" id="payment_status" required
                                    class="w-full bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-0 focus:border-indigo-600 block p-2.5 transition-colors outline-none appearance-none">
                                    <option value="">Please select</option>
                                    <option value="Fully Paid"
                                        {{ old('payment_status') == 'Fully Paid' ? 'selected' : '' }}>Fully Paid</option>
                                    <option value="Advance Paid"
                                        {{ old('payment_status') == 'Advance Paid' ? 'selected' : '' }}>Advance Paid
                                    </option>
                                    <option value="Failed" {{ old('payment_status') == 'Failed' ? 'selected' : '' }}>Failed
                                    </option>
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label for="payment_date" class="text-sm font-semibold text-gray-700 mb-2">
                                    Payment Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="payment_date" id="payment_date"
                                    value="{{ old('payment_date', \Carbon\Carbon::today()->format('Y-m-d')) }}" required
                                    class="w-full bg-gray-50 border-b-2 border-gray-300 text-gray-900 text-sm rounded-t-lg focus:ring-0 focus:border-indigo-600 block p-2.5 transition-colors outline-none">
                            </div>

                        </div>

                        <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-gray-100">
                            <button type="reset"
                                class="px-6 py-2.5 text-sm font-bold text-gray-600 hover:text-gray-800 transition-colors uppercase tracking-widest">
                                Reset
                            </button>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-2.5 rounded-xl font-bold transition-all shadow-lg shadow-indigo-100 active:scale-95 uppercase tracking-widest">
                                Submit Receipt
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
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
                if ($(this).val() === 'Fully Paid') {
                    const billAmount = parseFloat($billAmountInput.val() || 0);
                    $amountPaidInput.val(billAmount);
                    $balanceDueInput.val(0);
                    $amountPaidInput.prop('readOnly', true);
                } else {
                    $amountPaidInput.prop('readOnly', false);
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
