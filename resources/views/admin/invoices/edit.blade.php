@extends('layouts.admin-main')

@section('title', 'Edit Invoice')

@section('content')
    <main class="p-2 sm:p-6 lg:p-8 bg-gray-50 min-h-screen">
        <div id="editInvoiceSection" class="max-w-5xl mx-auto">

            <div class="mb-6 px-2 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <a href="{{ route('invoices') }}"
                        class="text-blue-600 flex items-center text-sm font-bold mb-2 transition-colors hover:text-blue-800">
                        <i class="fas fa-chevron-left mr-2"></i> Back to Invoices
                    </a>
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Edit Customer Invoice</h2>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Invoice: <span
                            class="text-blue-600 font-mono">{{ $invoice->invoice_no }}</span></p>
                </div>

                <button type="button" id="openItemModal"
                    class="bg-indigo-600 text-white text-xs font-black px-5 py-4 rounded-2xl shadow-lg active:scale-95 transition-all flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i> ADD ITEM
                </button>
            </div>

            @include('include.alerts')

            <form action="{{ route('invoice.update', ['invoice' => $invoice->id]) }}" method="POST" id="editInvoiceForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-[280px] md:pb-20">

                    <div class="lg:col-span-2 space-y-4">

                        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-5 mx-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="text-[10px] font-black text-gray-400 uppercase ml-1 tracking-widest">Customer
                                        Name</label>
                                    <select name="party_id" required
                                        class="w-full bg-gray-50 text-sm font-bold rounded-2xl px-4 py-3 border border-gray-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-50 outline-none transition-all">
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == $invoice->customer_id ? 'selected' : '' }}>
                                                {{ $customer->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label
                                            class="text-[10px] font-black text-gray-400 uppercase ml-1 tracking-widest">Invoice
                                            Date</label>
                                        <input type="date" name="invoice_date"
                                            value="{{ $invoice->invoice_date->format('Y-m-d') }}" required
                                            class="w-full bg-gray-50 text-sm font-bold rounded-2xl px-4 py-3 border border-gray-100 focus:border-blue-500 outline-none">
                                    </div>
                                    <div>
                                        <label
                                            class="text-[10px] font-black text-gray-400 uppercase ml-1 tracking-widest">Status</label>
                                        <select name="payment_status"
                                            class="w-full bg-gray-50 text-sm font-bold rounded-2xl px-4 py-3 border border-gray-100 outline-none">
                                            <option value="unpaid"
                                                {{ $invoice->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                            <option value="paid"
                                                {{ $invoice->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 mx-1" id="mobileItemContainer">
                            <h3 class="text-xs font-black uppercase text-gray-400 ml-2 tracking-widest">Line Items</h3>

                            @php
                                $descriptions = json_decode($invoice->description, true);
                                $dates = json_decode($invoice->dates, true);
                                $prices = json_decode($invoice->price, true);
                                $quanitites = json_decode($invoice->qty, true);
                                $amounts = json_decode($invoice->amount, true);
                                $combined = array_map(null, $descriptions, $dates, $prices, $quanitites, $amounts);
                            @endphp

                            @foreach ($combined as $index => $data)
                                <div
                                    class="item-card bg-white p-5 rounded-[2rem] border border-gray-200 shadow-sm relative overflow-hidden group">
                                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-500"></div>

                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1">
                                            <input type="text" name="description[]" value="{{ $data[0] }}" required
                                                class="w-full bg-transparent border border-gray-200 p-1 focus:ring-0 text-base font-black text-gray-900 placeholder-gray-300"
                                                placeholder="Service description">
                                            <input type="date" name="dates[]" value="{{ $data[1] }}" required
                                                class="bg-transparent border border-gray-200 p-1 focus:ring-0 text-[10px] text-indigo-500 font-black uppercase tracking-tighter mt-1">
                                        </div>
                                        <button type="button"
                                            class="remove-card-btn text-gray-300 hover:text-red-500 p-2 transition-colors">
                                            <i class="fas fa-times-circle text-xl"></i>
                                        </button>
                                    </div>

                                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black text-gray-400 uppercase">Unit Price</span>
                                            <div class="relative">
                                                <span
                                                    class="absolute left-2 top-1.5 text-xs font-bold text-gray-400">₹</span>
                                                <input type="number" name="price[]" value="{{ $data[2] }}"
                                                    step="0.01"
                                                    class="price-input pl-5 pr-3 py-1.5 bg-gray-50 border-none rounded-xl text-sm font-black text-gray-800 w-28 focus:ring-2 focus:ring-indigo-100 transition-all">
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-black text-gray-400 uppercase">Quanity</span>
                                            <div class="relative">
                                                <input type="number" name="qty[]" value="{{ $data[3] }}"
                                                    step="0.01"
                                                    class="qty-input pl-5 pr-3 py-1.5 bg-gray-50 border-none rounded-xl text-sm font-black text-gray-800 w-28 focus:ring-2 focus:ring-indigo-100 transition-all">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[10px] font-black text-gray-400 uppercase">Row Total</p>
                                            <input type="number" name="amount[]" value="{{ $data[4] }}" readonly
                                                class="amount-input w-24 bg-transparent border-none text-right font-black text-lg text-gray-900 p-0 focus:ring-0">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div
                            class="fixed bottom-0 left-0 right-0 lg:sticky lg:top-8 bg-gray-900 lg:bg-white p-6 lg:rounded-3xl shadow-[0_-10px_40px_rgba(0,0,0,0.2)] lg:shadow-xl border border-white/10 lg:border-gray-200 z-20 text-white lg:text-gray-900">
                            <h3 class="hidden lg:block text-lg font-black uppercase tracking-tight mb-6">Summary</h3>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center text-gray-400 lg:text-gray-500">
                                    <span class="text-xs font-bold uppercase tracking-widest">Sub Total</span>
                                    <span id="sub_total_display" class="font-black text-lg lg:text-gray-900">₹0.00</span>
                                    <input type="hidden" name="sub_total" value="{{ $invoice->sub_total }}">
                                </div>

                                <div
                                    class="flex items-center justify-between gap-4 p-3 bg-white/5 lg:bg-gray-50 rounded-2xl border border-white/10 lg:border-gray-100">
                                    <span class="text-xs font-bold uppercase text-gray-400">Received Amount (₹)</span>
                                    <input type="number" name="received_amount" id="received_amount"
                                        value="{{ $invoice->received_amount }}"
                                        class="w-24 bg-transparent lg:bg-white text-right font-black text-blue-400 lg:text-blue-600 outline-none border-none lg:border lg:border-gray-200 lg:rounded-lg lg:px-2">
                                </div>

                                <div class="pt-4 border-t border-white/10 lg:border-gray-200">
                                    <div>
                                        <p
                                            class="text-[10px] font-black text-gray-400 lg:text-gray-500 uppercase tracking-widest">
                                            Total Payable</p>
                                        <h2 id="total_display"
                                            class="text-3xl font-black text-white lg:text-gray-900 tracking-tighter">
                                            ₹0.00</h2>
                                        <input type="hidden" name="total" value="{{ $invoice->total_amount }}">
                                    </div>
                                    <button type="submit"
                                        class="mt-3 w-full bg-blue-500 hover:bg-blue-600 text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-blue-500/20 active:scale-95 transition-all">
                                        UPDATE
                                    </button>
                                </div>
                            </div>
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

            $('.qty-input, .price-input').trigger('input');

            const mobileContainer = $('#mobileItemContainer');

            function formatCurrency(num) {
                return new Intl.NumberFormat('en-IN', {
                    style: 'currency',
                    currency: 'INR',
                    minimumFractionDigits: 2
                }).format(num);
            }

            // Add item logic
            $('#addItemBtn').click(function() {
                const desc = $('#modal_description').val();
                const date = $('#modal_date').val();
                const price = parseFloat($('#modal_price').val()) || 0;
                const qty = parseFloat($('#modal_qty').val()) || 0;

                if (!desc || price <= 0) return alert('Enter valid service info');

                const cardHtml = `
                    <div class="item-card bg-white p-5 rounded-[2rem] border border-gray-200 shadow-sm relative overflow-hidden animate-fade-in group">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-500"></div>
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <input type="text" name="description[]" value="${desc}" required class="w-full bg-transparent border-none p-0 focus:ring-0 text-base font-black text-gray-900">
                                <input type="date" name="dates[]" value="${date}" required class="bg-transparent border-none p-0 focus:ring-0 text-[10px] text-indigo-500 font-black uppercase tracking-tighter mt-1">
                            </div>
                            <button type="button" class="remove-card-btn text-gray-300 hover:text-red-500 p-2 transition-colors">
                                <i class="fas fa-times-circle text-xl"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-black text-gray-400 uppercase">Unit Price</span>
                                <div class="relative">
                                    <span class="absolute left-2 top-1.5 text-xs font-bold text-gray-400">₹</span>
                                    <input type="number" name="price[]" value="${price}" step="0.01" class="price-input pl-5 pr-3 py-1.5 bg-gray-50 border-none rounded-xl text-sm font-black text-gray-800 w-28 focus:ring-2 focus:ring-indigo-100 transition-all">
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-black text-gray-400 uppercase">Quantity</span>
                                <div class="relative">
                                    <input type="number" name="qty[]" value="${qty}" step="0.01" class="qty-input pl-5 pr-3 py-1.5 bg-gray-50 border-none rounded-xl text-sm font-black text-gray-800 w-28 focus:ring-2 focus:ring-indigo-100 transition-all">
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-black text-gray-400 uppercase">Row Total</p>
                                <input type="number" name="amount[]" value="${price}" readonly class="amount-input w-24 bg-transparent border-none text-right font-black text-lg text-gray-900 p-0 focus:ring-0">
                            </div>
                        </div>
                    </div>`;

                mobileContainer.append(cardHtml);
                $('#modal_description, #modal_price, #modal_qty').val('');
                updateTotals();
                closeItemModal();
            });

            // Remove item
            $(document).on('click', '.remove-card-btn', function() {
                if (confirm('Remove this item?')) {
                    $(this).closest('.item-card').remove();
                    updateTotals();
                }
            });

            // Calculation triggers
            $(document).on('input', '.price-input, .qty-input', function() {
                const val = parseFloat($(this).val()) || 0;

                const row = $(this).closest('.item-card');

                const qty = parseFloat(row.find('.qty-input, .mobile-qty-input').val()) || 0;

                const price = parseFloat(row.find('.price-input, .mobile-price-input').val()) || 0;

                const total = (qty * price).toFixed(2);

                row.find('.amount-input').val(total);
                row.find('.mobile-amount-display').text(total);

                updateTotals();
            });

            $('#received_amount').on('input', updateTotals);

            function updateTotals() {
                let subtotal = 0;
                $('.amount-input').each(function() {
                    subtotal += parseFloat($(this).val()) || 0;
                });

                const received_amount = parseFloat($('#received_amount').val()) || 0;
                const total = subtotal - received_amount;

                $('#sub_total_display').text(formatCurrency(subtotal));
                $('#total_display').text(formatCurrency(total));

                $('input[name="total"]').val(total.toFixed(2));
                $('input[name="sub_total"]').val(subtotal.toFixed(2));
            }

            // Initial update
            updateTotals();
        });
    </script>
@endsection
