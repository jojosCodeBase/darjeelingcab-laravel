@extends('layouts.admin-main')

@section('title', 'Create Invoice')

@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div id="invoiceFormSection">
            <div class="mb-6">
                <a href="{{ route('invoices') }}"
                    class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Invoices</span>
                </a>
                <h2 class="text-gray-900 text-2xl font-bold mb-1">Generate Bill</h2>
                <p class="text-gray-500 text-sm">Select a customer and their specific booking to generate a bill.</p>
            </div>

            @include('include.alerts')

            <form action="{{ route('bill.store') }}" method="POST" id="invoiceForm">
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

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-medium">Invoice Date *</label>
                                    <input type="date" name="invoice_date" value="{{ date('Y-m-d') }}" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200">
                                </div>
                                <div>
                                    <label class="text-gray-700 text-sm mb-2 block font-medium">Invoice Number *</label>
                                    <input type="text" name="invoice_no" value="DC-{{ date('Y') }}-" required
                                        class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200 font-mono">
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
                                <div id="vehicle_details" class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    {{-- Rendered via JS --}}
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                                <h3 class="text-gray-900 text-lg font-semibold">Item Details</h3>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#itemModal"
                                    class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all shadow-md">
                                    <i class="fas fa-plus mr-1"></i> Add Extra Service
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-gray-50 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                        <tr>
                                            <th class="px-6 py-3 w-16">Sl.no</th>
                                            <th class="px-6 py-3">Description</th>
                                            <th class="px-6 py-3 text-center">Date</th>
                                            <th class="px-6 py-3 w-32">Price (₹)</th>
                                            <th class="px-6 py-3 w-32 text-right">Amount (₹)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemTableBody" class="divide-y divide-gray-100">
                                        {{-- Populated from Booking via JS --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 sticky top-8">
                            <h3 class="text-gray-900 text-lg font-semibold mb-6 border-b pb-4">Payment Summary</h3>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 font-medium">Subtotal</span>
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

    <div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-2xl border-none shadow-2xl">
                <div class="modal-header border-b border-gray-100 p-6">
                    <h5 class="text-xl font-bold text-gray-900">Add Extra Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <input type="text" id="modal_description"
                            class="w-full bg-gray-50 rounded-lg px-4 py-2 border border-gray-200"
                            placeholder="e.g., Guide Charges, Extra Km">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" id="modal_dates"
                            class="w-full bg-gray-50 rounded-lg px-4 py-2 border border-gray-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price (₹)</label>
                        <input type="number" id="modal_price"
                            class="w-full bg-gray-50 rounded-lg px-4 py-2 border border-gray-200" placeholder="0.00">
                    </div>
                </div>
                <div class="modal-footer border-t border-gray-100 p-6 bg-gray-50 rounded-b-2xl">
                    <button type="button" class="px-6 py-2 text-gray-600 font-bold"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="add-manual-item-btn"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold">Add to Bill</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // 1. Fetch Bookings - Reset table on customer change
            $('#customerSelect').change(function() {
                const customerId = $(this).val();
                $('#itemTableBody').empty(); // Clear items as they belong to a specific booking
                $('#vehicle_details_container').hide();
                updateTotals();

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
                                    `<option value="${booking.id}">BK-${booking.id} (${dayDateArray[0]})</option>`
                                    );
                            });
                        } else {
                            bookingSelect.append(
                                '<option value="" disabled>No active bookings for this customer</option>'
                                );
                        }
                    });
                } else {
                    $('#bookingSelectContainer').hide();
                }
            });

            // 2. Load Booking Data
            $('#bookingSelect').change(function() {
                const bookingId = $(this).val();
                if (bookingId) {
                    $.get(`/admin/booking/${bookingId}`, function(booking) {
                        populateFromBooking(booking);
                    });
                } else {
                    $('#itemTableBody').empty();
                    $('#vehicle_details_container').hide();
                    updateTotals();
                }
            });

            function populateFromBooking(booking) {
                $('#itemTableBody').empty();
                $('#vehicle_details').empty();
                $('#vehicle_details_container').removeClass('hidden').show();

                const dayDates = JSON.parse(booking.day_date);
                const destinations = JSON.parse(booking.destination);
                const vehicleNumbers = JSON.parse(booking.vehicle_no);
                const vehicleTypes = JSON.parse(booking.vehicle_type);
                const driverNames = JSON.parse(booking.driver_name);

                // Vehicles info
                vehicleNumbers.forEach((no, i) => {
                    $('#vehicle_details').append(`
                    <div class="bg-white p-2 rounded border border-indigo-100 text-[11px] shadow-sm">
                        <p class="font-bold text-indigo-600">${vehicleTypes[i] || 'SUV'}</p>
                        <p class="text-gray-600">${no} • ${driverNames[i] || 'N/A'}</p>
                    </div>
                `);
                });

                // Itinerary items
                dayDates.forEach((date, index) => {
                    addItemToTable(destinations[index], date, 0);
                });
            }

            // 3. Manual Extras
            $('#add-manual-item-btn').click(function() {
                const desc = $('#modal_description').val();
                const date = $('#modal_dates').val();
                const price = $('#modal_price').val();

                if (desc && price) {
                    addItemToTable(desc, date, price);
                    $('#itemModal').modal('hide');
                    $('#modal_description, #modal_dates, #modal_price').val('');
                }
            });

            function addItemToTable(desc, date, price) {
                const html = `
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-400 sl-no"></td>
                    <td class="px-6 py-4">
                        <input type="text" name="description[]" value="${desc}" required class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-semibold text-gray-800">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <input type="date" name="dates[]" value="${date}" required class="bg-transparent border-none p-0 focus:ring-0 text-xs text-indigo-600 font-medium text-center">
                    </td>
                    <td class="px-6 py-4">
                        <input type="number" name="price[]" value="${price}" min="0" step="0.01" required class="price-input w-full bg-white border border-gray-200 rounded-md px-2 py-1 text-sm focus:border-blue-500 outline-none">
                    </td>
                    <td class="px-6 py-4 text-right">
                        <input type="number" name="amount[]" value="${price}" readonly class="amount-input w-full bg-transparent border-none text-right font-bold text-gray-900 p-0 focus:ring-0">
                    </td>
                </tr>
            `;
                $('#itemTableBody').append(html);
                updateTotals();
            }

            // 4. Totals Logic
            $(document).on('input', '.price-input', function() {
                $(this).closest('tr').find('.amount-input').val($(this).val());
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
                const formatter = new Intl.NumberFormat('en-IN', {
                    style: 'currency',
                    currency: 'INR'
                });

                $('#total_raw').text(formatter.format(total));
                $('input[name="total"]').val(total.toFixed(2));
                $('#balance_due_display').text(formatter.format(balance));
                $('input[name="balance_due"]').val(balance.toFixed(2));
                $('.sl-no').each(function(i) {
                    $(this).text(i + 1);
                });
            }
        });
    </script>
@endsection
