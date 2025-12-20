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
                                <div id="vehicle_details" class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    {{-- Rendered via JS --}}
                                </div>
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
                                        </tr>
                                    </thead>
                                    <tbody id="itemTableBody" class="divide-y divide-gray-100">
                                        {{-- Desktop rows appended here --}}
                                        <tr>
                                            <td colspan="5">
                                                <p class="text-center text-sm p-5 italic">No items added</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="itemCardContainer" class="lg:hidden divide-y divide-gray-100 bg-gray-50/30">
                                {{-- Mobile cards appended here --}}
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

    <div id="itemModal"
        class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300">

        <div class="relative w-full max-w-md transform transition-all animate-in fade-in zoom-in duration-200">

            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20">

                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
                    <h5 class="text-xl font-black text-gray-900 uppercase tracking-tight">Add Extra Service</h5>
                    <button type="button"
                        class="closeModal text-gray-400 hover:text-gray-900 transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div
                        class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-50 transition-all">
                        <label
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Description</label>
                        <input type="text" id="modal_description"
                            class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900"
                            placeholder="e.g., Guide Charges, Extra Km">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-50 transition-all">
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Date</label>
                            <input type="date" id="modal_dates" value="{{ date('Y-m-d') }}"
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-900">
                        </div>
                        <div
                            class="bg-gray-50 p-4 rounded-2xl border border-gray-100 focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-50 transition-all">
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
                        class="closeModal flex-1 py-4 text-gray-500 font-black text-xs uppercase tracking-widest hover:text-gray-700">
                        Cancel
                    </button>
                    <button type="button" id="add-manual-item-btn"
                        class="flex-2 px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-200 active:scale-95 transition-all">
                        Add to Bill
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

            // 1. Fetch Bookings - Reset table on customer change
            $('#customerSelect').change(function() {
                const customerId = $(this).val();
                $('#itemTableBody').empty(); // Clear items as they belong to a specific booking
                $('#vehicle_details_container').hide();

                $('.qty-input, .price-input').trigger('input');
                $('.mobile-qty-input, .mobile-price-input').trigger('input');

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
                                    `<option value="${booking.id}">${booking.booking_id} (${dayDateArray[0]})</option>`
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

                // const dayDates = JSON.parse(booking.day_date);
                // const destinations = JSON.parse(booking.destination);
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

                const vehicle_count = vehicleTypes.length;

                // 1. Ensure dayDates is an array
                const dayDates = Array.isArray(booking.day_date) ? booking.day_date : JSON.parse(booking.day_date ||
                    "[]");
                const destinations = Array.isArray(booking.destination) ? booking.destination : JSON.parse(booking
                    .destination || "[]");

                    console.log(destinations);

                alert('Vehicle count: ' + vehicle_count); // This one works

                // 2. Use a safer loop
                dayDates.forEach((date, index) => {
                    // Fallback values if data is missing for a specific day
                    const currentDest = (destinations && destinations[index]) ? destinations[index] :
                        "No Destination Set";
                    const currentDate = date ? date : "";

                    alert(`Processing Day ${index}: ${currentDest}`);

                    // Call the function
                    addItemToTable(currentDest, currentDate, 0, vehicle_count);
                });

                alert('If you see this, the loop finished successfully!');

                // alert(vehicle_count);

                // // Itinerary items
                // dayDates.forEach((date, index) => {
                //     addItemToTable(destinations[index], date, 0, vehicle_count);
                // });

                // alert(vehicle_count);
            }

            // 3. Manual Extras
            $('#add-manual-item-btn').click(function() {
                const desc = $('#modal_description').val();
                const date = $('#modal_dates').val();
                const price = $('#modal_price').val();

                if (desc && price) {
                    addItemToTable(desc, date, price);
                    $('#modal_description, #modal_dates, #modal_price').val('');
                    closeItemModal();
                }
            });

            function addItemToTable(desc, date, price, qty = 1) { // Added qty parameter with default 1
                const uniqueId = crypto.randomUUID();
                const totalAmount = (price * qty).toFixed(2); // Calculate initial total

                // 1. DESKTOP ROW
                const desktopHtml = `
                    <tr class="hover:bg-gray-50/50 transition-colors desktop-row" data-id="${uniqueId}">
                        <td class="px-4 py-4 text-sm text-gray-400 sl-no"></td>
                        <td class="px-4 py-4">
                            <input type="text" name="description[]" value="${desc}" required 
                                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-semibold text-gray-800">
                        </td>
                        <td class="px-2 py-4 text-center">
                            <input type="date" name="dates[]" value="${date}" required 
                                class="bg-transparent border-none p-0 focus:ring-0 text-xs text-indigo-600 font-medium text-center">
                        </td>
                        <td class="px-0 py-4">
                            <div class="flex items-center gap-2">
                                <input type="number" name="qty[]" value="${qty}" min="1" 
                                    class="qty-input w-8 bg-white border border-gray-200 rounded-md px-1 py-1 text-sm focus:border-blue-500 outline-none" placeholder="Qty">
                                
                                <span class="text-gray-400">×</span>
                                
                                <input type="number" name="price[]" value="${price}" min="0" step="0.01" required 
                                    class="price-input w-full bg-white border border-gray-200 rounded-md px-1 py-1 text-sm focus:border-blue-500 outline-none" placeholder="Price">
                            </div>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <input type="number" name="amount[]" value="${totalAmount}" readonly 
                                class="amount-input w-full bg-transparent border-none text-right font-bold text-gray-900 p-0 focus:ring-0">
                        </td>
                    </tr>
                `;

                // 2. MOBILE CARD
                const mobileHtml = `
                    <div class="p-4 bg-white mobile-card space-y-3" data-id="${uniqueId}">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black uppercase text-gray-400">Item #<span class="sl-no-mobile"></span></span>
                            <button type="button" class="remove-item text-red-500 text-xs"><i class="fas fa-trash"></i></button>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-2">
                            <input type="text" name="description[]" value="${desc}" placeholder="Description"
                                class="w-full bg-gray-50 border-none rounded-lg px-3 py-2 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-blue-100">
                            
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <label class="text-[9px] uppercase font-bold text-gray-400 ml-1">Qty</label>
                                    <input type="number" name="qty[]" value="${qty}" min="1"
                                        class="mobile-qty-input w-full bg-gray-50 border-none rounded-lg px-3 py-2 text-xs">
                                </div>
                                <div class="col-span-2">
                                    <label class="text-[9px] uppercase font-bold text-gray-400 ml-1">Price (₹)</label>
                                    <input type="number" name="price[]" value="${price}" step="0.01"
                                        class="mobile-price-input w-full bg-blue-50 border-none rounded-lg px-3 py-2 text-sm font-black text-blue-700">
                                </div>
                            </div>
                        </div>
                        <div class="text-right pt-2 border-t border-dashed border-gray-100">
                            <span class="text-[10px] text-gray-400 uppercase font-bold mr-2">Subtotal:</span>
                            <span class="text-sm font-black text-gray-900">₹<span class="mobile-amount-display">${totalAmount}</span></span>
                        </div>
                    </div>
                `;

                $('#itemTableBody').append(desktopHtml);
                $('#itemCardContainer').append(mobileHtml);

                // updateTotals();
            }

            // Combine the selectors into ONE string separated by a comma
            $(document).on('input', '.qty-input, .price-input, .mobile-qty-input, .mobile-price-input', function() {
                const row = $(this).closest('.desktop-row, .mobile-card');
                const uniqueId = row.data('id'); // Get the unique ID for this itinerary item

                const qty = parseFloat(row.find('.qty-input, .mobile-qty-input').val()) || 0;
                const price = parseFloat(row.find('.price-input, .mobile-price-input').val()) || 0;
                const total = (qty * price).toFixed(2);

                // Find BOTH the Desktop Row and the Mobile Card with this ID
                const syncedElements = $(`[data-id="${uniqueId}"]`);

                // Update values in both places so they stay in sync
                syncedElements.find('.qty-input, .mobile-qty-input').val(qty);
                syncedElements.find('.price-input, .mobile-price-input').val(price);
                syncedElements.find('.amount-input').val(total);
                syncedElements.find('.mobile-amount-display').text(total);

                updateTotals();
            });

            $('#received_amount').on('input', updateTotals);

            function updateTotals() {
                let total = 0;

                // We use the desktop 'amount-input' as the source of truth for the calculation
                $('.amount-input').each(function() {
                    const val = parseFloat($(this).val()) || 0;
                    total += val;
                });

                const received = parseFloat($('#received_amount').val()) || 0;
                const balance = total - received;

                const formatter = new Intl.NumberFormat('en-IN', {
                    style: 'currency',
                    currency: 'INR'
                });

                // Update UI Displays
                $('#total_raw').text(formatter.format(total));
                $('input[name="total"]').val(total.toFixed(2));

                $('#balance_due_display').text(formatter.format(balance));
                $('input[name="balance_due"]').val(balance.toFixed(2));

                // Update Serial Numbers for both views
                $('.sl-no').each(function(i) {
                    $(this).text(i + 1);
                });
                $('.sl-no-mobile').each(function(i) {
                    $(this).text(i + 1);
                });
            }
        });
    </script>
@endsection
