@extends('layouts.admin-main')
@section('title', 'Edit Booking')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div id="bookingFormSection">
            <div class="mb-6">
                <a href="{{ route('bookings') }}" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Bookings</span>
                </a>
                <h2 class="text-gray-900 text-2xl font-bold mb-1" id="formTitle">Edit Booking</h2>
                <p class="text-gray-500 text-sm">Update the booking details for <span
                        class="font-bold text-gray-700">{{ $booking->customer->full_name }}</span></p>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8">
                <form action="{{ route('bookings.update', $booking->id) }}" method="POST" id="bookingForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-blue-600"></i>
                            Customer & Pax Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-3">
                                <label class="text-gray-700 text-sm mb-2 block">Select Customer *</label>
                                <select name="customer_id"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    required>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id', $booking->customer_id) == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->full_name }} - {{ $customer->phone_no }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-1">
                                <label class="text-gray-700 text-sm mb-2 block">Total Pax *</label>
                                <input type="number" name="pax" value="{{ old('pax', $booking->pax) }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200"
                                    required>
                            </div>
                        </div>
                    </div>

                    @php
                        $dayDates = json_decode($booking->day_date, true) ?? [];
                        $destinations = json_decode($booking->destination, true) ?? [];
                        $startDate = !empty($dayDates) ? $dayDates[0] : '';
                        $endDate = !empty($dayDates) ? end($dayDates) : '';
                    @endphp

                    <div class="mb-8 pt-6 border-t border-gray-100">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-orange-500"></i>
                            Trip Duration
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Start Date *</label>
                                <input type="date" name="start_date" id="start_date"
                                    value="{{ old('start_date', $startDate) }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200"
                                    required>
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">End Date *</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $endDate) }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200"
                                    required>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-amber-600 italic"><i class="fas fa-info-circle mr-1"></i> Changing these
                            dates will re-generate the itinerary below.</p>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-route mr-2 text-green-600"></i>
                            Day-wise Itinerary
                        </h3>
                        <div id="itinerary-details" class="space-y-4">
                            @foreach ($dayDates as $index => $date)
                                <div
                                    class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 itinerary-item">
                                    <div class="md:col-span-1 text-center pb-2">
                                        <span class="text-xs font-black text-blue-600 uppercase">Day
                                            {{ $index + 1 }}</span>
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Edit
                                            Date</label>
                                        <input type="date" name="day_date[]" value="{{ $date }}"
                                            class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200 text-sm"
                                            required>
                                    </div>
                                    <div class="md:col-span-8">
                                        <label
                                            class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Description</label>
                                        <input type="text" name="destination[]"
                                            value="{{ $destinations[$index] ?? '' }}"
                                            class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200 text-sm"
                                            placeholder="E.g. Sightseeing in Darjeeling..." required>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-8 pt-6 border-t border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-gray-900 text-lg font-semibold flex items-center">
                                <i class="fas fa-car mr-2 text-indigo-600"></i>
                                Vehicle Details
                            </h3>
                            <button type="button" id="add-vehicle-btn"
                                class="text-sm bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg border border-indigo-200 hover:bg-indigo-600 hover:text-white transition-all">
                                <i class="fas fa-plus mr-1"></i> Add Vehicle
                            </button>
                        </div>
                        <div id="vehicle-details" class="space-y-4">
                            @php
                                $vTypes = json_decode($booking->vehicle_type, true) ?? [''];
                                $vNos = json_decode($booking->vehicle_no, true) ?? [''];
                                $dNames = json_decode($booking->driver_name, true) ?? [''];
                            @endphp
                            @foreach ($vTypes as $index => $vType)
                                <div
                                    class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 relative group">
                                    <div>
                                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Vehicle
                                            Type</label>
                                        <input type="text" name="vehicle_type[]" value="{{ $vType }}"
                                            class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200"
                                            placeholder="E.g. Innova" required>
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Vehicle
                                            Number</label>
                                        <input type="text" name="vehicle_no[]" value="{{ $vNos[$index] ?? '' }}"
                                            class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200 uppercase"
                                            placeholder="WB 76..." required>
                                    </div>
                                    <div class="relative">
                                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Driver
                                            Name</label>
                                        <input type="text" name="driver_name[]" value="{{ $dNames[$index] ?? '' }}"
                                            class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200"
                                            placeholder="Name" required>
                                        @if ($index > 0)
                                            <button type="button"
                                                class="remove-vehicle-btn absolute -right-2 -top-2 flex bg-white text-red-500 w-6 h-6 rounded-full border border-red-100 items-center justify-center shadow-sm hover:bg-red-50">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 pt-6 border-t border-gray-100">
                        <div>
                            <label class="text-gray-700 text-sm font-bold mb-2 block">Fare Amount *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-400">₹</span>
                                <input type="number" name="fare_amount"
                                    value="{{ old('fare_amount', $booking->fare_amount) }}" required step="0.01"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg pl-8 pr-4 py-3 border border-gray-200 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="text-gray-700 text-sm font-bold mb-2 block">Booking Status *</label>
                            <select name="status"
                                class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 border border-gray-200 focus:border-blue-500"
                                required>
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-bold transition-all shadow-lg">
                            <i class="fas fa-sync-alt mr-2"></i> Update Booking
                        </button>
                        <a href="{{ route('bookings') }}"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-3 rounded-lg font-bold transition-all text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function generateItinerary() {
                const startDateStr = $('#start_date').val();
                const endDateStr = $('#end_date').val();

                if (startDateStr && endDateStr) {
                    const start = new Date(startDateStr);
                    const end = new Date(endDateStr);

                    if (end >= start) {
                        // Optional: Add a confirmation before clearing existing descriptions in Edit mode
                        if (!confirm("Changing dates will reset all current itinerary descriptions. Continue?"))
                            return;

                        $('#itinerary-details').empty();
                        let current = new Date(start);
                        let dayCount = 1;

                        while (current <= end) {
                            const dateString = current.toISOString().split('T')[0];
                            const html = `
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-100 itinerary-item animate-fade-in">
                                    <div class="md:col-span-1 text-center pb-2">
                                        <span class="text-xs font-black text-blue-600 uppercase">Day ${dayCount}</span>
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Edit Date</label>
                                        <input type="date" name="day_date[]" value="${dateString}"
                                            class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200 text-sm" required>
                                    </div>
                                    <div class="md:col-span-8">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase mb-1 block">Description</label>
                                        <input type="text" name="destination[]"
                                            class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200 text-sm"
                                            placeholder="E.g. Sightseeing in Darjeeling..." required>
                                    </div>
                                </div>`;

                            $('#itinerary-details').append(html);
                            current.setDate(current.getDate() + 1);
                            dayCount++;
                        }
                    }
                }
            }

            // Only trigger generateItinerary on manual change (input), 
            // not on initial page load so we keep the saved descriptions.
            $('#start_date, #end_date').on('input', generateItinerary);

            $('#add-vehicle-btn').click(function() {
                var vehicleDetailHtml = `
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 relative group">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Vehicle Type</label>
                            <input type="text" name="vehicle_type[]" class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200" placeholder="E.g. INNOVA" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Vehicle Number</label>
                            <input type="text" name="vehicle_no[]" class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200 uppercase" placeholder="WB 76..." required>
                        </div>
                        <div class="relative">
                            <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Driver Name</label>
                            <input type="text" name="driver_name[]" class="w-full bg-white text-gray-900 rounded-lg px-3 py-2 border border-gray-200" placeholder="Name" required>
                            <button type="button" class="remove-vehicle-btn absolute -right-2 -top-2 flex bg-white text-red-500 w-6 h-6 rounded-full border border-red-100 items-center justify-center shadow-sm hover:bg-red-50">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    </div>`;
                $('#vehicle-details').append(vehicleDetailHtml);
            });

            $(document).on('click', '.remove-vehicle-btn', function() {
                $(this).closest('.grid').remove();
            });
        });
    </script>
@endsection
