@extends('layouts.admin-main')

@section('title', 'Edit Manual Invoice')

@section('content')
    <main class="p-2 sm:p-6 lg:p-8 bg-gray-50 min-h-screen">
        <div id="editInvoiceSection" class="max-w-5xl mx-auto">

            <div class="mb-4 px-2">
                <a href="{{ route('invoices') }}" class="text-blue-600 flex items-center text-sm font-bold mb-2">
                    <i class="fas fa-chevron-left mr-2"></i> Back to Invoices
                </a>
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-black text-gray-900 tracking-tight">Edit Manual Invoice</h2>
                        <p class="text-xs text-gray-500 font-medium">Invoice: <span
                                class="text-blue-600 font-mono">{{ $invoice->invoice_no }}</span></p>
                    </div>
                </div>
            </div>

            @include('include.alerts')

            <form action="{{ route('invoice.update-instant', ['invoice' => $invoice->id]) }}" method="POST"
                id="editInvoiceForm">
                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 mx-1">
                        <div class="flex items-center gap-2 mb-4 border-b border-gray-50 pb-2">
                            <div
                                class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                <i class="fas fa-user-edit text-xs"></i>
                            </div>
                            <h3 class="text-sm font-black uppercase text-gray-700">Customer Details</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-[280px]">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Full Name *</label>
                                <input type="text" name="manual_name"
                                    value="{{ old('manual_name', $invoice->manual_customer_name) }}" required
                                    class="w-full bg-gray-50 text-sm rounded-xl px-4 py-3 border border-gray-200 focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Phone Number *</label>
                                <input type="tel" name="manual_phone"
                                    value="{{ old('manual_phone', $invoice->manual_customer_phone) }}" required
                                    class="w-full bg-gray-50 text-sm rounded-xl px-4 py-3 border border-gray-200 focus:border-blue-500 outline-none">
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-400 ml-1"><span
                                        class="uppercase">Address</span> (Optional)</label>
                                <textarea type="text" name="manual_address"
                                    class="w-full bg-gray-50 text-sm rounded-xl px-4 py-3 border border-gray-200 focus:border-blue-500 outline-none"
                                    placeholder="e.g. Peshok, Peshok Tea Garden, Darjeeling">{{ $invoice->manual_customer_address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 mx-1">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <div class="col-span-2 md:col-span-1">
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Invoice #</label>
                                <input type="text" value="{{ $invoice->invoice_no }}" required readonly
                                    class="w-full bg-gray-50 text-xs font-mono rounded-xl px-4 py-3 border border-gray-200">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Billing Date</label>
                                <input type="date" name="invoice_date"
                                    value="{{ $invoice->invoice_date->format('Y-m-d') }}" required
                                    class="w-full bg-gray-50 text-xs rounded-xl px-3 py-3 border border-gray-200">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Payment Status</label>
                                <select name="payment_status"
                                    class="w-full bg-gray-50 text-xs rounded-xl px-3 py-3 border border-gray-200">
                                    <option value="unpaid" {{ $invoice->payment_status == 'unpaid' ? 'selected' : '' }}>
                                        Unpaid</option>
                                    <option value="advance-paid"
                                        {{ $invoice->payment_status == 'advance-paid' ? 'selected' : '' }}>Advance Paid
                                    </option>
                                    <option value="paid" {{ $invoice->payment_status == 'paid' ? 'selected' : '' }}>Paid
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mx-1">
                        <div class="flex justify-between items-center mb-3 px-1">
                            <h3 class="text-sm font-black uppercase text-gray-700">Billing Items</h3>
                            <button type="button" id="openItemModal"
                                class="bg-indigo-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg active:scale-95 transition-transform">
                                <i class="fas fa-plus mr-1"></i> Add Item
                            </button>
                        </div>

                        <div id="mobileItemContainer" class="space-y-3">
                            @php
                                $descriptions = json_decode($invoice->description, true); // Assuming array casting in Model
                                $dates = json_decode($invoice->dates, true);
                                $prices = json_decode($invoice->price, true);
                                $amounts = json_decode($invoice->amount, true);
                            @endphp

                            @foreach ($descriptions as $index => $desc)
                                <div class="item-card bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center relative overflow-hidden"
                                    id="card-{{ $index }}">
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500"></div>
                                    <div class="flex-1">
                                        <input type="text" name="description[]" value="{{ $desc }}"
                                            class="w-full bg-transparent border border-gray-200 p-2 focus:ring-0 text-sm font-bold text-gray-900 mb-1"
                                            placeholder="Description">
                                        <input type="date" name="dates[]" value="{{ $dates[$index] }}"
                                            class="bg-transparent border border-gray-200 p-2 focus:ring-0 text-[10px] text-gray-500 font-bold uppercase tracking-tighter">

                                        <div class="flex items-center mt-2">
                                            <span class="text-xs text-gray-400 mr-1">₹</span>
                                            <input type="number" name="amount[]"
                                                value="{{ number_format($amounts[$index], 2, '.', '') }}" step="0.01"
                                                class="price-input bg-indigo-50 text-indigo-700 font-black rounded-lg px-2 py-1 text-sm w-24 outline-none border-none focus:ring-1 focus:ring-indigo-300">
                                            <input type="hidden" name="price[]" value="{{ $prices[$index] }}">
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="remove-card-btn p-3 text-gray-300 hover:text-red-500 transition-colors">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="sticky bottom-4 mx-1 mt-6 z-40">
                        <div class="bg-gray-900 rounded-3xl shadow-2xl p-5 text-white">
                            <div class="flex justify-between items-center mb-4 border-b border-white/10 pb-4">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Bill</p>
                                    <h2 id="total_display" class="text-2xl font-black">
                                        ₹{{ number_format($invoice->total_amount, 2) }}</h2>
                                    <input type="hidden" name="total" value="{{ $invoice->total_amount }}">
                                </div>
                                <div class="text-right border-l border-white/10 pl-4">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Due</p>
                                    <h2 id="balance_display"
                                        class="text-xl font-black {{ $invoice->balance_due > 0 ? 'text-red-400' : 'text-green-400' }}">
                                        ₹{{ number_format($invoice->balance_due, 2) }}</h2>
                                    <input type="hidden" name="balance_due" value="{{ $invoice->balance_due }}">
                                </div>
                            </div>

                            <div class="flex gap-3 mb-4">
                                <div class="flex-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Received
                                        (₹)</label>
                                    <input type="number" id="received_amount" name="received_amount"
                                        value="{{ $invoice->received_amount }}"
                                        class="w-full bg-white/10 rounded-xl px-4 py-2 text-white border border-white/20 focus:border-blue-400 outline-none font-bold text-lg">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-500 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg transition-all active:scale-95">
                                Update & Save Changes
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <div id="itemModal"
        class="hidden fixed inset-0 z-[100]  items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300">

        <div class="relative w-full max-w-md transform transition-all animate-in fade-in zoom-in duration-200">

            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h5 class="text-xl font-black text-gray-900 uppercase">New Item</h5>
                        <button type="button" class="closeModal text-gray-300 hover:text-gray-900 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div
                            class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-indigo-500 focus-within:ring-4 focus-within:ring-indigo-50 transition-all">
                            <label
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Description</label>
                            <input type="text" id="modal_description"
                                class="w-full bg-transparent border border-gray-300 p-3 focus:ring-0 text-sm font-bold text-gray-900"
                                placeholder="e.g., Local Sightseeing">
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div
                                class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-indigo-500 focus-within:ring-4 focus-within:ring-indigo-50 transition-all">
                                <label
                                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Date</label>
                                <input type="date" id="modal_date" value="{{ date('Y-m-d') }}"
                                    class="w-full bg-transparent border border-gray-300 p-3 focus:ring-0 text-sm font-bold text-gray-900">
                            </div>
                            <div
                                class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-indigo-500 focus-within:ring-4 focus-within:ring-indigo-50 transition-all">
                                <label
                                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Price
                                    (₹)</label>
                                <input type="number" id="modal_price"
                                    class="w-full bg-transparent border border-gray-300 p-3 focus:ring-0 text-sm font-bold text-gray-900"
                                    placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <button type="button" id="addItemBtn"
                        class="w-full mt-8 py-4 bg-gray-900 text-white rounded-2xl font-black shadow-xl shadow-gray-200 active:scale-95 transition-all hover:bg-black">
                        ADD TO LIST
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#openItemModal').on('click', function(e) {
                e.preventDefault();
                $('#itemModal').removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden'); // Prevent background scrolling
            });

            function closeItemModal() {
                $('#itemModal').addClass('hidden').removeClass('flex');
                $('body').removeClass('overflow-hidden');
            }

            $('.closeModal').on('click', closeItemModal);


            $('#itemModal').on('click', function(e) {
                if (e.target === this) {
                    closeItemModal();
                }
            });

            const formatter = new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR',
                minimumFractionDigits: 2
            });

            // 1. Add Item to Card List
            $('#addItemBtn').click(function() {
                const desc = $('#modal_description').val();
                const date = $('#modal_date').val();
                const price = parseFloat($('#modal_price').val()) || 0;

                if (!desc || price <= 0) return alert('Enter valid info');

                const uniqueId = Date.now();
                const cardHtml = `
            <div class="item-card bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center relative overflow-hidden" id="card-${uniqueId}">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500"></div>
                <div class="flex-1">
                    <input type="text" name="description[]" value="${desc}" required class="w-full bg-transparent border border-gray-200 p-2 focus:ring-0 text-sm font-bold text-gray-800 mb-1">
                    <input type="date" name="dates[]" value="${date}" required class="bg-transparent border border-gray-200 p-2 focus:ring-0 text-[10px] text-gray-500 font-bold uppercase tracking-tighter">
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-gray-400 mr-1">₹</span>
                        <input type="number" name="amount[]" value="${price.toFixed(2)}" step="0.01" 
                               class="price-input bg-indigo-50 text-indigo-700 font-black rounded-lg px-2 py-1 text-sm w-24 outline-none border-none focus:ring-1 focus:ring-indigo-300">
                    </div>
                    <input type="hidden" name="price[]" value="${price.toFixed(2)}">
                </div>
                <button type="button" class="remove-card-btn p-3 text-gray-300 hover:text-red-500 transition-colors">
                    <i class="fas fa-trash-alt text-sm"></i>
                </button>
            </div>
        `;

                $('#mobileItemContainer').append(cardHtml);
                $('#modal_description, #modal_price').val('');
                closeItemModal();
                updateTotals();
            });

            // 2. Remove Item
            $(document).on('click', '.remove-card-btn', function() {
                $(this).closest('.item-card').remove();
                updateTotals();
            });

            // 3. Live Price Edit
            $(document).on('input', '.price-input', function() {
                const newVal = $(this).val();
                $(this).closest('.item-card').find('input[name="price[]"]').val(newVal);
                updateTotals();
            });

            $('#received_amount').on('input', updateTotals);

            function updateTotals() {
                let total = 0;
                $('.price-input').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });

                const received = parseFloat($('#received_amount').val()) || 0;
                const balance = total - received;

                $('#total_display').text(formatter.format(total));
                $('input[name="total"]').val(total.toFixed(2));

                $('#balance_display').text(formatter.format(balance));
                $('input[name="balance_due"]').val(balance.toFixed(2));

                if (balance <= 0 && total > 0) {
                    $('#balance_display').removeClass('text-red-400').addClass('text-green-400');
                } else {
                    $('#balance_display').removeClass('text-green-400').addClass('text-red-400');
                }
            }
        });
    </script>
@endsection
