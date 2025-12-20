@extends('layouts.admin-main')

@section('title', 'Manage Bookings')

@section('content')
    <!-- Main Content -->
    <main class="p-4 sm:p-6 lg:p-8">
        <!-- BOOKINGS SECTION -->
        <div id="bookingsSection">
            <!-- Header with Actions -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-gray-900 text-xl font-bold mb-1">All Bookings</h3>
                    <p class="text-gray-500 text-sm">Create and manage cab bookings</p>
                </div>

                <a href="{{ route('bookings.create') }}">
                    <button
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>New Booking</span>
                    </button>
                </a>
            </div>

            @include('include.alerts')

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="text-gray-600 text-sm mb-2 block">Search Bookings</label>
                        <div class="flex items-center bg-gray-100 rounded-lg px-4 py-2">
                            <i class="fas fa-search text-gray-400 mr-2"></i>
                            <input type="text" id="searchBooking" placeholder="Booking ID, Customer name..."
                                class="bg-transparent text-gray-900 outline-none text-sm w-full">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Status</label>
                        <select id="statusFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                            <option value="all">All Status</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Date Filter -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Date</label>
                        <input type="date" id="dateFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Bookings List -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Booking ID</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Customer</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Pax Details</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Route</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Trip Dates</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Vehicle</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Status</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($bookings as $booking)
                                @php
                                    $dayDates = json_decode($booking->day_date, true);
                                    $startDate = isset($dayDates[0]) ? $dayDates[0] : 'N/A';
                                    $endDate = isset($dayDates[count($dayDates) - 1])
                                        ? $dayDates[count($dayDates) - 1]
                                        : 'N/A';
                                    $vehicles = json_decode($booking->vehicle_type);
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="text-blue-600 font-semibold">#{{ $booking->booking_id }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-gray-900 font-medium">{{ $booking->customer->full_name }}</p>
                                            <p class="text-gray-500 text-sm">{{ $booking->customer->phone_no ?? 'NA' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p>{{ $booking->pax ?? 0 }} pax</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-gray-900">Darjeeling → Gangtok</p>
                                            <p class="text-gray-500 text-sm">95 km</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm">
                                            <p class="text-gray-900 font-medium">
                                                {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }}</p>
                                            <p class="text-gray-400 text-xs">To:
                                                {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-gray-600 text-sm">{{ is_array($vehicles) ? implode(', ', $vehicles) : $booking->vehicle_type }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">Confirmed</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('bookings.show', $booking->id) }}"
                                                class="text-blue-600 hover:text-blue-700 p-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('bookings.edit', $booking->id) }}"
                                                class="text-yellow-600 hover:text-yellow-700 p-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700 p-2"
                                                    onclick="return confirm('Are you sure, you want to delete this booking?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">No bookings found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="lg:hidden p-4 space-y-4">
                    @forelse ($bookings as $booking)
                        @php
                            $dayDates = json_decode($booking->day_date, true);
                            $startDate = isset($dayDates[0]) ? $dayDates[0] : 'N/A';
                            $endDate = isset($dayDates[count($dayDates) - 1]) ? $dayDates[count($dayDates) - 1] : 'N/A';
                            $vehicles = json_decode($booking->vehicle_type);
                        @endphp
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <span class="text-blue-600 font-semibold text-lg">#{{ $booking->booking_id }}</span>
                                    <p class="text-gray-900 font-medium mt-1">{{ $booking->customer->full_name }}</p>
                                </div>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">NA</span>
                            </div>
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-users w-5 mr-2 text-gray-400"></i>
                                    <span>{{ $booking->pax }} Pax</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-calendar w-5 mr-2 text-gray-400"></i>
                                    <span>{{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} —
                                        {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-car w-5 mr-2 text-gray-400"></i>
                                    <span>{{ is_array($vehicles) ? implode(', ', $vehicles) : $booking->vehicle_type }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 pt-3 border-t border-gray-200">
                                <a href="{{ route('bookings.show', $booking->id) }}"
                                    class="viewBookingBtn flex-1 bg-blue-600 text-center text-white px-4 py-2 rounded-lg text-sm font-medium">
                                    <i class="fas fa-eye mr-2"></i>View
                                </a>
                                <a href="{{ route('bookings.edit', $booking->id) }}"
                                    class="editBookingBtn flex-1 bg-yellow-600 text-center text-white px-4 py-2 rounded-lg text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-8 text-gray-500">No bookings found</div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script>
        // Create Booking Button
        document.getElementById('createBookingBtn').addEventListener('click', () => {
            document.getElementById('bookingsSection').classList.add('hidden');
            document.getElementById('bookingFormSection').classList.remove('hidden');
            document.getElementById('formTitle').textContent = 'Create New Booking';
            document.getElementById('bookingForm').reset();
        });

        // Back to List Button
        document.getElementById('backToListBtn').addEventListener('click', () => {
            document.getElementById('bookingFormSection').classList.add('hidden');
            document.getElementById('bookingsSection').classList.remove('hidden');
        });

        // Cancel Form Button
        document.getElementById('cancelFormBtn').addEventListener('click', () => {
            document.getElementById('bookingFormSection').classList.add('hidden');
            document.getElementById('bookingsSection').classList.remove('hidden');
        });

        // Edit Booking Buttons
        document.querySelectorAll('.editBookingBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('bookingsSection').classList.add('hidden');
                document.getElementById('bookingFormSection').classList.remove('hidden');
                document.getElementById('formTitle').textContent = 'Edit Booking';
            });
        });

        // View Booking Buttons
        document.querySelectorAll('.viewBookingBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                alert('View booking details (to be implemented)');
            });
        });

        // Delete Booking
        document.querySelectorAll('.deleteBookingBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm('Are you sure you want to delete this booking?')) {
                    alert('Booking deleted successfully!');
                }
            });
        });

        // Form Submission
        document.getElementById('bookingForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Booking saved successfully!');
            document.getElementById('bookingFormSection').classList.add('hidden');
            document.getElementById('bookingsSection').classList.remove('hidden');
        });

        // Dynamic Day-wise Itinerary Generation
        const numberOfDaysInput = document.getElementById('numberOfDays');
        const itineraryContainer = document.getElementById('itineraryContainer');
        const totalDistanceInput = document.getElementById('totalDistance');

        numberOfDaysInput.addEventListener('input', function() {
            const days = parseInt(this.value) || 0;
            generateItinerary(days);
        });

        function generateItinerary(days) {
            // Clear existing itinerary
            itineraryContainer.innerHTML = '';

            if (days < 1 || days > 30) {
                return;
            }

            // Generate fields for each day
            for (let i = 1; i <= days; i++) {
                const daySection = document.createElement('div');
                daySection.className = 'bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-4 border-2 border-blue-200';
                daySection.innerHTML = `
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm">${i}</span>
                        </div>
                        <h4 class="text-gray-900 font-semibold text-lg">Day ${i} Itinerary</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="text-gray-700 text-sm mb-2 block">From *</label>
                            <input type="text" required name="day${i}_from" 
                                class="day-from w-full bg-white text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Starting location">
                        </div>
                        <div>
                            <label class="text-gray-700 text-sm mb-2 block">To *</label>
                            <input type="text" required name="day${i}_to"
                                class="day-to w-full bg-white text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Destination">
                        </div>
                        <div>
                            <label class="text-gray-700 text-sm mb-2 block">Distance (km) *</label>
                            <input type="number" required name="day${i}_distance" min="0" step="0.1"
                                class="day-distance w-full bg-white text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="0">
                        </div>
                    </div>
                `;
                itineraryContainer.appendChild(daySection);
            }

            // Add event listeners to distance inputs for total calculation
            addDistanceListeners();
        }

        function addDistanceListeners() {
            const distanceInputs = document.querySelectorAll('.day-distance');
            distanceInputs.forEach(input => {
                input.addEventListener('input', calculateTotalDistance);
            });
        }

        function calculateTotalDistance() {
            const distanceInputs = document.querySelectorAll('.day-distance');
            let total = 0;
            distanceInputs.forEach(input => {
                const value = parseFloat(input.value) || 0;
                total += value;
            });
            totalDistanceInput.value = total.toFixed(1);
        }
    </script>
@endsection
