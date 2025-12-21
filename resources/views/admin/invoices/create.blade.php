@extends('layouts.admin-main')

@section('title', 'Create Invoice')

@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div id="invoiceFormSection">
            <div class="mb-6">
                <a href="{{ route('invoices') }}" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Invoices</span>
                </a>
                <h2 class="text-gray-900 text-2xl font-bold mb-1">Generate Invoice</h2>
                <p class="text-gray-500 text-sm">Select a customer and their specific booking to generate a bill.</p>
            </div>

            @include('include.alerts')

            <form action="{{ route('invoice.store') }}" method="POST" id="invoiceForm">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                            <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                                <i class="fas fa-file-invoice mr-2 text-blue-600"></i>
                                Invoice Basics
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-medium">Select Customer *</label>
                                    <select name="party_id" id="customerSelect" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        <option value="">Please select customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->full_name }} -
                                                {{ $customer->phone_no }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="bookingSelectContainer" style="display: none;">
                                    <label class="text-gray-700 text-sm mb-2 block font-medium">Select Booking *</label>
                                    <select name="booking_id" id="bookingSelect" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                        <option value="">Select a booking</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-medium">Invoice Date *</label>
                                    <input type="date" name="invoice_date" value="{{ date('Y-m-d') }}" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200">
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-medium">Payment Status *</label>
                                    <select name="payment_status" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200">
                                        <option value="unpaid">Unpaid</option>
                                        <option value="advance-paid">Advance Paid</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                            </div>

                            <div id="vehicle_details_container"
                                class="hidden mt-4 p-4 bg-indigo-50 border border-indigo-100 rounded-xl">
                                <h4 class="text-indigo-900 text-xs font-bold uppercase mb-2">Trip Vehicle Assignment</h4>
                                <div id="vehicle_details" class="grid grid-cols-1 md:grid-cols-2 gap-2"></div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                            <div class="p-4 sm:p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                                <h3 class="text-gray-900 text-lg font-bold">Item Details</h3>
                                <button type="button" id="openItemModal"
                                    class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all shadow-md flex items-center">
                                    <i class="fas fa-plus mr-2"></i> Add Item
                                </button>
                            </div>

                            <div class="hidden lg:block overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead
                                        class="bg-gray-50 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                                        <tr>
                                            <th class="px-4 py-3 w-16">Sl.no</th>
                                            <th class="px-4 py-3">Description</th>
                                            <th class="px-2 py-3 text-center">Date</th>
                                            <th class="px-0 py-3 w-32">Price (₹)</th>
                                            <th class="px-4 py-3 w-32 text-right">Amount (₹)</th>
                                            <th class="px-4 py-3 w-10"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemTableBody" class="divide-y divide-gray-100">
                                        <tr id="emptyStateRow">
                                            <td colspan="6">
                                                <p class="text-center text-sm p-5 italic text-gray-400">No items added</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="itemCardContainer" class="lg:hidden divide-y divide-gray-100 bg-gray-50/30">
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 sticky top-8">
                            <h3 class="text-gray-900 text-lg font-semibold mb-6 border-b pb-4">Payment Summary</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 font-medium">Total Payable</span>
                                    <span id="total_raw" class="font-bold text-gray-900 text-lg">₹0.00</span>
                                    <input type="hidden" name="total" value="0">
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-1 block">Received Amount</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2.5 text-gray-400 text-sm">₹</span>
                                        <input type="number" id="received_amount" name="received_amount" value="0"
                                            min="0" step="0.01"
                                            class="w-full bg-gray-50 text-gray-900 rounded-lg pl-7 pr-4 py-2 border border-gray-200 focus:ring-2 focus:ring-green-200 outline-none">
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-dashed border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-900 font-bold uppercase text-sm">Balance Due</span>
                                        <div class="text-right">
                                            <span id="balance_due_display"
                                                class="text-2xl font-black text-red-600">₹0.00</span>
                                            <input type="hidden" name="balance_due" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full mt-8 bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5">
                                <i class="fas fa-check-circle mr-2"></i>GENERATE & SAVE
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <div id="itemModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="relative w-full max-w-md transform animate-in fade-in zoom-in duration-200">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
                    <h5 class="text-xl font-black text-gray-900 uppercase tracking-tight">Add Extra Service</h5>
                    <button type="button"
                        class="closeModal text-gray-400 hover:text-gray-900 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <label
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Description</label>
                        <input type="text" id="modal_description"
                            class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900"
                            placeholder="e.g., Guide Charges">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Date</label>
                            <input type="date" id="modal_dates" value="{{ date('Y-m-d') }}"
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900">
                        </div>
                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Price
                                (₹)</label>
                            <input type="number" id="modal_price"
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900"
                                placeholder="0.00">
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-gray-50/50 flex gap-3">
                    <button type="button"
                        class="closeModal flex-1 py-4 text-gray-500 font-black text-xs uppercase tracking-widest">Cancel</button>
                    <button type="button" id="add-manual-item-btn"
                        class="flex-2 px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg">Add
                        to Bill</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // --- Modal Logic ---
            $('#openItemModal').click(function() {
                $('#itemModal').removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden');
            });

            function closeItemModal() {
                $('#itemModal').addClass('hidden').removeClass('flex');
                $('body').removeClass('overflow-hidden');
            }

            $('.closeModal').click(closeItemModal);

            // --- Data Fetching ---
            $('#customerSelect').change(function() {
                const customerId = $(this).val();
                resetTable();
                if (customerId) {
                    $.get('{{ route('billing.getBookings') }}', {
                        customer_id: customerId
                    }, function(data) {
                        const bookingSelect = $('#bookingSelect');
                        $('#bookingSelectContainer').fadeIn();
                        bookingSelect.empty().append('<option value="">Select a Booking</option>');
                        if (data.bookings && data.bookings.length > 0) {
                            data.bookings.forEach(booking => {
                                let dayDateArray = JSON.parse(booking.day_date);
                                bookingSelect.append(
                                    `<option value="${booking.id}">${booking.booking_id} (${dayDateArray[0]})</option>`
                                    );
                            });
                        }
                    });
                } else {
                    $('#bookingSelectContainer').hide();
                }
            });

            $('#bookingSelect').change(function() {
                const bookingId = $(this).val();
                if (bookingId) {
                    $.get(`/admin/booking/${bookingId}`, function(booking) {
                        populateFromBooking(booking);
                    });
                } else {
                    resetTable();
                }
            });

            function resetTable() {
                $('#itemTableBody').empty().append(
                    '<tr id="emptyStateRow"><td colspan="6"><p class="text-center text-sm p-5 italic text-gray-400">No items added</p></td></tr>'
                    );
                $('#itemCardContainer').empty();
                $('#vehicle_details_container').hide();
                updateTotals();
            }

            function populateFromBooking(booking) {
                $('#itemTableBody').empty();
                $('#itemCardContainer').empty();
                $('#vehicle_details').empty();
                $('#vehicle_details_container').removeClass('hidden').show();

                const vehicleNumbers = JSON.parse(booking.vehicle_no || "[]");
                const vehicleTypes = JSON.parse(booking.vehicle_type || "[]");
                const driverNames = JSON.parse(booking.driver_name || "[]");

                vehicleNumbers.forEach((no, i) => {
                    $('#vehicle_details').append(`
                    <div class="bg-white p-2 rounded border border-indigo-100 text-[11px] shadow-sm">
                        <p class="font-bold text-indigo-600">${vehicleTypes[i] || 'Vehicle'}</p>
                        <p class="text-gray-600">${no} • ${driverNames[i] || 'N/A'}</p>
                    </div>`);
                });

                const vehicle_count = vehicleTypes.length || 1;
                const dayDates = Array.isArray(booking.day_date) ? booking.day_date : JSON.parse(booking.day_date ||
                    "[]");
                const destinations = Array.isArray(booking.destination) ? booking.destination : JSON.parse(booking
                    .destination || "[]");

                dayDates.forEach((date, index) => {
                    const currentDest = destinations[index] || "Trip Service";
                    addItemToTable(currentDest, date, 0, vehicle_count);
                });
            }

            // --- Core: Add Item to Both Views ---
            $('#add-manual-item-btn').click(function() {
                const desc = $('#modal_description').val();
                const date = $('#modal_dates').val();
                const price = $('#modal_price').val();
                if (desc && price) {
                    addItemToTable(desc, date, price);
                    $('#modal_description, #modal_price').val('');
                    closeItemModal();
                }
            });

            function addItemToTable(desc, date, price, qty = 1) {
                $('#emptyStateRow').remove();
                const uniqueId = 'row-' + Date.now() + Math.floor(Math.random() * 1000);
                const totalAmount = (price * qty).toFixed(2);

                // Desktop Row
                const desktopHtml = `
                <tr class="hover:bg-gray-50/50 transition-colors desktop-row" data-id="${uniqueId}">
                    <td class="px-4 py-4 text-sm text-gray-400 sl-no"></td>
                    <td class="px-4 py-4"><input type="text" name="description[]" value="${desc}" class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-semibold text-gray-800"></td>
                    <td class="px-2 py-4 text-center"><input type="date" name="dates[]" value="${date}" class="bg-transparent border-none p-0 focus:ring-0 text-xs text-indigo-600 font-medium text-center"></td>
                    <td class="px-0 py-4">
                        <div class="flex items-center gap-2">
                            <input type="number" name="qty[]" value="${qty}" class="qty-input w-10 border border-gray-200 rounded px-1 py-1 text-sm">
                            <span>×</span>
                            <input type="number" name="price[]" value="${price}" class="price-input w-20 border border-gray-200 rounded px-1 py-1 text-sm">
                        </div>
                    </td>
                    <td class="px-4 py-4 text-right"><input type="number" name="amount[]" value="${totalAmount}" readonly class="amount-input w-full bg-transparent border-none text-right font-bold p-0"></td>
                    <td class="px-4 py-4"><button type="button" class="remove-item text-red-400 hover:text-red-600"><i class="fas fa-trash-alt"></i></button></td>
                </tr>`;

                // Mobile Card
                const mobileHtml = `
                <div class="p-4 bg-white mobile-card" data-id="${uniqueId}">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[10px] font-black text-gray-400 uppercase">Item #<span class="sl-no-mobile"></span></span>
                        <button type="button" class="remove-item text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                    <input type="text" value="${desc}" class="w-full bg-gray-50 border border-gray-200 p-2 rounded mb-2 text-sm font-bold">
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="text-[9px] uppercase text-gray-400">Qty x Price</label>
                            <div class="flex items-center gap-1">
                                <input type="number" value="${qty}" class="mobile-qty-input w-12 bg-gray-50 border border-gray-200 p-2 rounded text-xs px-2 py-2">
                                <input type="number" value="${price}" class="mobile-price-input w-full bg-gray-50 border border-gray-200 p-2 rounded text-xs px-2 py-2">
                            </div>
                        </div>
                        <div class="text-right">
                            <label class="text-[9px] uppercase text-gray-400">Subtotal</label>
                            <div class="text-sm font-black text-blue-600">₹<span class="mobile-amount-display">${totalAmount}</span></div>
                        </div>
                    </div>
                </div>`;

                $('#itemTableBody').append(desktopHtml);
                $('#itemCardContainer').append(mobileHtml);
                updateTotals();
            }

            // --- Sync and Calculations ---
            $(document).on('input', '.qty-input, .price-input, .mobile-qty-input, .mobile-price-input', function() {
                const container = $(this).closest('[data-id]');
                const id = container.data('id');
                const qty = parseFloat(container.find('.qty-input, .mobile-qty-input').val()) || 0;
                const price = parseFloat(container.find('.price-input, .mobile-price-input').val()) || 0;
                const total = (qty * price).toFixed(2);

                const synced = $(`[data-id="${id}"]`);
                synced.find('.qty-input, .mobile-qty-input').val(qty);
                synced.find('.price-input, .mobile-price-input').val(price);
                synced.find('.amount-input').val(total);
                synced.find('.mobile-amount-display').text(total);

                updateTotals();
            });

            $(document).on('click', '.remove-item', function() {
                const id = $(this).closest('[data-id]').data('id');
                $(`[data-id="${id}"]`).remove();
                if ($('#itemTableBody tr').length === 0) {
                    $('#itemTableBody').append(
                        '<tr id="emptyStateRow"><td colspan="6"><p class="text-center text-sm p-5 italic text-gray-400">No items added</p></td></tr>'
                        );
                }
                updateTotals();
            });

            $('#received_amount').on('input', updateTotals);

            function updateTotals() {
                let total = 0;
                $('.amount-input').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });

                const received = parseFloat($('#received_amount').val()) || 0;
                const balance = total - received;

                $('#total_raw').text('₹' + total.toLocaleString('en-IN', {
                    minimumFractionDigits: 2
                }));
                $('input[name="total"]').val(total.toFixed(2));
                $('#balance_due_display').text('₹' + balance.toLocaleString('en-IN', {
                    minimumFractionDigits: 2
                }));
                $('input[name="balance_due"]').val(balance.toFixed(2));

                $('.sl-no').each((i, el) => $(el).text(i + 1));
                $('.sl-no-mobile').each((i, el) => $(el).text(i + 1));
            }
        });
    </script>
@endsection
