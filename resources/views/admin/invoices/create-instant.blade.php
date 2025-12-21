@extends('layouts.admin-main')

@section('title', 'Instant Invoice')

@section('content')
    <main class="p-2 sm:p-6 lg:p-8 bg-gray-50 min-h-screen">
        <div id="instantInvoiceSection" class="max-w-7xl mx-auto">

            <div class="mb-4 px-2">
                <a href="{{ route('invoices') }}" class="text-blue-600 flex items-center text-sm font-bold mb-2">
                    <i class="fas fa-chevron-left mr-2"></i> Back to List
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-black text-gray-900 tracking-tight">Manual Billing</h2>
                        <p class="text-xs text-gray-500 font-medium">Create a quick bill on the go</p>
                    </div>
                    <div class="bg-amber-100 p-2 rounded-lg">
                        <i class="fas fa-bolt text-amber-600"></i>
                    </div>
                </div>
            </div>

            @include('include.alerts')

            <form action="{{ route('invoice.store_instant') }}" method="POST" id="instantInvoiceForm">
                @csrf

                <div class="space-y-4">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 mx-1">
                        <div class="flex items-center gap-2 mb-4 border-b border-gray-50 pb-2">
                            <div
                                class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <h3 class="text-sm font-black uppercase text-gray-700">Customer Info</h3>
                        </div>

                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Full Name *</label>
                                    <input type="text" name="manual_name" required
                                        class="w-full bg-gray-50 text-sm rounded-xl px-4 py-3 border border-gray-200 focus:border-blue-500 outline-none"
                                        placeholder="e.g. John Doe">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Phone Number *</label>
                                    <input type="tel" name="manual_phone" required
                                        class="w-full bg-gray-50 text-sm rounded-xl px-4 py-3 border border-gray-200 focus:border-blue-500 outline-none"
                                        placeholder="+91 00000 00000">
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-400 ml-1"><span
                                        class="uppercase">Address</span> (Optional)</label>
                                <textarea type="text" name="manual_address"
                                    class="w-full bg-gray-50 text-sm rounded-xl px-4 py-3 border border-gray-200 focus:border-blue-500 outline-none"
                                    placeholder="e.g. Peshok, Peshok Tea Garden, Darjeeling"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 mx-1">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Date</label>
                                <input type="date" name="invoice_date" value="{{ date('Y-m-d') }}" required
                                    class="w-full bg-gray-50 text-xs rounded-xl px-3 py-3 border border-gray-200">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Status</label>
                                <select name="payment_status"
                                    class="w-full bg-gray-50 text-xs rounded-xl px-3 py-3 border border-gray-200">
                                    <option value="advance-paid">Advance Paid</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mx-1">
                        <div class="flex justify-between items-center mb-3 px-1">
                            <h3 class="text-sm font-black uppercase text-gray-700">Trip Items</h3>
                            <button type="button" id="openItemModal"
                                class="bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg active:scale-95 transition-transform">
                                <i class="fas fa-plus mr-1"></i> Add Item
                            </button>
                        </div>

                        <div id="mobileItemContainer" class="space-y-3">
                            <div id="emptyRow"
                                class="text-center py-10 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                                <i class="fas fa-file-invoice-dollar text-3xl text-gray-200 mb-2"></i>
                                <p class="text-xs text-gray-400">No items added to this bill yet.</p>
                            </div>
                        </div>
                        <div id="hiddenInputsContainer"></div>
                    </div>

                    <div class="ticky bottom-4 mx-1 mt-6 z-40">
                        <div class="md:max-w-xl mx-auto bg-gray-900 rounded-3xl shadow-2xl p-5 text-white">
                            <div class="flex justify-between items-center mb-4 border-b border-white/10 pb-4">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Amount
                                    </p>
                                    <h2 id="total_display" class="text-2xl font-black">₹0.00</h2>
                                    <input type="hidden" name="total" value="0">
                                </div>
                                <div class="text-right border-l border-white/10 pl-4">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Balance</p>
                                    <h2 id="balance_display" class="text-xl font-black text-red-400">₹0.00</h2>
                                    <input type="hidden" name="balance_due" value="0">
                                </div>
                            </div>

                            <div class="flex gap-3 mb-4">
                                <div class="flex-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Received
                                        (₹)</label>
                                    <input type="number" id="received_amount" name="received_amount" value="0"
                                        class="w-full bg-white/10 rounded-xl px-4 py-2 text-white border border-white/20 focus:border-blue-400 outline-none font-bold">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg transition-all active:scale-95">
                                Create & Download PDF
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <div id="instantItemModal"
        class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300">

        <div class="relative w-full max-w-md transform transition-all animate-in fade-in zoom-in duration-200">

            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20">
                <div class="p-8">

                    <h5 class="text-xl font-black text-gray-900 mb-6 flex items-center uppercase tracking-tight">
                        <i class="fas fa-plus-circle text-blue-500 mr-2"></i> Add Bill Item
                    </h5>

                    <div class="space-y-5">
                        <div
                            class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-50 transition-all">
                            <label
                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Service
                                Description</label>
                            <input type="text" id="modal_description"
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900"
                                placeholder="e.g. SUV Drop Bagdogra">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div
                                class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-50 transition-all">
                                <label
                                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Date</label>
                                <input type="date" id="modal_date" value="{{ date('Y-m-d') }}"
                                    class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900">
                            </div>
                            <div
                                class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-50 transition-all">
                                <label
                                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 block">Amount
                                    (₹)</label>
                                <input type="number" id="modal_price"
                                    class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900"
                                    placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button type="button"
                            class="closeModal flex-1 py-4 text-gray-500 font-black text-xs uppercase tracking-widest">
                            Cancel
                        </button>
                        <button type="button" id="addItemBtn"
                            class="flex-2 px-8 py-4 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg active:scale-95 transition-all">
                            ADD ITEM
                        </button>
                    </div>
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
                $('#instantItemModal').removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden'); // Prevent background scrolling
            });

            function closeItemModal() {
                $('#instantItemModal').addClass('hidden').removeClass('flex');
                $('body').removeClass('overflow-hidden');
            }

            $('.closeModal').on('click', closeItemModal);


            $('#instantItemModal').on('click', function(e) {
                if (e.target === this) {
                    closeItemModal();
                }
            });

            $('#addItemBtn').click(function() {
                const desc = $('#modal_description').val();
                const date = $('#modal_date').val();
                const unit_price = parseFloat($('#modal_price').val()) || 0;

                if (!desc || unit_price <= 0) {
                    alert('Please enter description and amount');
                    return;
                }

                const qty = 1; // Default
                const row_total = (qty * unit_price);
                const uniqueId = Date.now();

                $('#emptyRow').remove();

                const cardHtml = `
        <div class="item-card bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center relative overflow-hidden mb-3" id="card-${uniqueId}">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500"></div>
            
            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-900 mb-0.5">${desc}</h4>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-3">${date}</p>
                
                <div class="flex items-center gap-4">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-gray-400 uppercase font-bold mb-1">Price</span>
                        <div class="flex items-center bg-blue-50 rounded-lg px-2 py-1">
                            <span class="text-xs text-blue-400 mr-1">₹</span>
                            <input type="number" name="price[]" value="${unit_price}" step="0.01" 
                                   class="price-input bg-transparent text-blue-700 font-black text-sm w-20 outline-none border-none focus:ring-0">
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <span class="text-[10px] text-gray-400 uppercase font-bold mb-1">Qty</span>
                        <div class="flex items-center bg-blue-50 rounded-lg px-2 py-1">
                            <input type="number" name="qty[]" value="${qty}" step="1" 
                                   class="qty-input bg-transparent text-blue-700 font-black text-sm w-12 text-center outline-none border-none focus:ring-0">
                        </div>
                    </div>

                    <div class="flex flex-col ml-auto pr-4 text-right">
                        <span class="text-[10px] text-gray-400 uppercase font-bold mb-1">Amount</span>
                        <p class="text-sm font-black text-gray-900">
                            ₹<span class="row-total-display">${row_total.toFixed(2)}</span>
                        </p>
                        <input type="hidden" name="amount[]" class="row-amount-hidden" value="${row_total.toFixed(2)}">
                    </div>
                </div>

                <input type="hidden" name="description[]" value="${desc}">
                <input type="hidden" name="dates[]" value="${date}">
            </div>

            <button type="button" class="remove-card-btn p-2 text-gray-300 hover:text-red-500 transition-colors" data-id="${uniqueId}">
                <i class="fas fa-trash-alt text-sm"></i>
            </button>
        </div>`;

                $('#mobileItemContainer').append(cardHtml);
                $('#modal_description, #modal_price').val('');
                closeItemModal();
                updateTotals();
            });

            // Handle Input Changes on the Cards
            $(document).on('input', '.price-input, .qty-input', function() {
                let card = $(this).closest('.item-card');
                let price = parseFloat(card.find('.price-input').val()) || 0;
                let qty = parseInt(card.find('.qty-input').val()) || 0;

                let row_total = price * qty;

                // Update display and hidden row total
                card.find('.row-total-display').text(row_total.toFixed(2));
                card.find('.row-amount-hidden').val(row_total.toFixed(2));

                updateTotals();
            });

            // Remove logic
            $(document).on('click', '.remove-card-btn', function() {
                const id = $(this).data('id');
                $(`#card-${id}`).remove();
                if ($('.item-card').length === 0) {
                    $('#mobileItemContainer').html(`
                <div id="emptyRow" class="text-center py-10 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                    <i class="fas fa-file-invoice-dollar text-3xl text-gray-200 mb-2"></i>
                    <p class="text-xs text-gray-400">No items added to this bill yet.</p>
                </div>`);
                }
                updateTotals();
            });

            $('#received_amount').on('input', updateTotals);

            function updateTotals() {
                let grandTotal = 0;

                // Sum up every row's hidden amount field
                $('.row-amount-hidden').each(function() {
                    grandTotal += parseFloat($(this).val()) || 0;
                });

                const received = parseFloat($('#received_amount').val()) || 0;
                const balance = grandTotal - received;

                const formatter = new Intl.NumberFormat('en-IN', {
                    style: 'currency',
                    currency: 'INR',
                    minimumFractionDigits: 2
                });

                $('#total_display').text(formatter.format(grandTotal));
                $('input[name="total"]').val(grandTotal.toFixed(2));

                $('#balance_display').text(formatter.format(balance));
                $('input[name="balance_due"]').val(balance.toFixed(2));

                // Dynamic Balance Color
                if (balance <= 0 && grandTotal > 0) {
                    $('#balance_display').removeClass('text-red-400').addClass('text-green-400');
                } else {
                    $('#balance_display').removeClass('text-green-400').addClass('text-red-400');
                }
            }
        });
    </script>
@endsection
