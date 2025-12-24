@extends('layouts.admin-main')
@section('title', 'Tour Enquiries')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-envelopes-bulk"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Enquiries</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($tour_enquiries) }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-inbox"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">New Enquiries</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $counts['new_enquiries'] }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Quote Sent</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $counts['quote_sent'] }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-check-double"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Confirmed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $counts['confirmed'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div
                class="p-4 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="relative w-full md:w-96">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Search by name or route..."
                        class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <select class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                        <option>All Dates</option>
                        <option>Next 7 Days</option>
                    </select>
                    <button
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        Export CSV
                    </button>
                </div>
            </div>

            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Traveller Info</th>
                            <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Route</th>
                            <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Pax / Vehicle</th>
                            <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Trip Dates</th>
                            <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Status</th>
                            <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($tour_enquiries as $enquiry)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900 font-bold">{{ $enquiry->name ?? 'Guest User' }}</span>
                                        <span
                                            class="text-gray-500 text-xs tracking-wide uppercase mt-0.5">#{{ $enquiry->enq_id }}</span>
                                        <div class="flex gap-3 mt-2 text-blue-600 text-xs font-medium">
                                            <span><i class="fas fa-phone mr-1"></i>{{ $enquiry->phone ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col text-sm">
                                        <span class="text-gray-900 font-medium">{{ $enquiry->from_location }}</span>
                                        <i class="fas fa-arrow-down text-[10px] text-gray-400 my-0.5 ml-2"></i>
                                        <span class="text-gray-900 font-medium">{{ $enquiry->to_location }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <span class="block text-sm text-gray-700 font-semibold">
                                            <i class="fas fa-users text-gray-400 mr-2"></i>{{ $enquiry->no_of_pax ?? 0 }}
                                            Pax
                                        </span>
                                        <span
                                            class="block text-xs bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded border border-indigo-100 inline-block uppercase">
                                            {{ $enquiry->vehicle_type ?? 'No Preference' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm">
                                        <p class="text-gray-900 font-medium">
                                            {{ \Carbon\Carbon::parse($enquiry->start_date)->format('M d') }} —
                                            {{ \Carbon\Carbon::parse($enquiry->end_date)->format('M d') }}
                                        </p>
                                        <p class="text-gray-500 text-xs">
                                            {{ \Carbon\Carbon::parse($enquiry->start_date)->diffInDays(\Carbon\Carbon::parse($enquiry->end_date)) }}
                                            Days Trip
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'new' => 'bg-blue-100 text-blue-700',
                                            'quote_sent' => 'bg-yellow-100 text-yellow-700',
                                            'confirmed' => 'bg-green-100 text-green-700',
                                        ];
                                        $class = $statusClasses[$enquiry->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span
                                        class="{{ $class }} px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">
                                        {{ str_replace('_', ' ', $enquiry->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="relative inline-block dropdown-container">
                                        <button type="button"
                                            class="dropdown-toggle w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors focus:outline-none">
                                            <i class="fas fa-ellipsis-h text-gray-400 text-xs pointer-events-none"></i>
                                        </button>

                                        <div
                                            class="dropdown-menu hidden origin-top-right absolute right-0 mt-2 w-48 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50 divide-y divide-gray-100 outline-none">
                                            <div class="py-1">
                                                <button type="button" data-enquiry="{{ json_encode($enquiry) }}"
                                                    class="viewEnquiryBtn flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                                    <i class="fas fa-eye w-5 mr-2"></i> View Details
                                                </button>
                                            </div>
                                            <div class="py-1">
                                                <button type="button"
                                                    onclick="updateStatus('{{ $enquiry->id }}', 'quote_sent')"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600">
                                                    <i class="fas fa-paper-plane w-5 mr-2"></i> Quote Sent
                                                </button>
                                                <button type="button"
                                                    onclick="updateStatus('{{ $enquiry->id }}', 'confirmed')"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">
                                                    <i class="fas fa-check-circle w-5 mr-2"></i> Confirm Trip
                                                </button>
                                            </div>
                                            <div class="py-1">
                                                <button type="button" onclick="deleteEnquiry('{{ $enquiry->id }}')"
                                                    class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                    <i class="fas fa-trash-alt w-5 mr-2"></i> Delete Enquiry
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">No enquiries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="lg:hidden p-4 space-y-4">
                @forelse($tour_enquiries as $enquiry)
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg leading-none">{{ $enquiry->name }}</h4>
                                <span class="text-gray-400 text-xs font-mono">#{{ $enquiry->enq_id }}</span>
                            </div>
                            <span
                                class="{{ $statusClasses[$enquiry->status] ?? 'bg-gray-100' }} px-2 py-1 rounded text-[10px] font-bold uppercase">
                                {{ str_replace('_', ' ', $enquiry->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-y-4 mb-4">
                            <div class="col-span-2">
                                <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Route</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $enquiry->from_location }} <i
                                        class="fas fa-long-arrow-alt-right mx-1 text-gray-400"></i>
                                    {{ $enquiry->to_location }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Pax / Vehicle</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $enquiry->no_of_pax }} Pax /
                                    {{ $enquiry->vehicle_type }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Start Date</p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($enquiry->start_date)->format('M d, Y') }}</p>
                            </div>
                        </div>

                        @if ($enquiry->message)
                            <div class="bg-white p-3 rounded-lg border border-gray-200 mb-4 italic text-sm text-gray-600">
                                "{{ Str::limit($enquiry->message, 100) }}"
                            </div>
                        @endif

                        <div class="flex gap-2">
                            <a href=""
                                class="flex-1 bg-blue-600 text-center text-white py-2 rounded-lg text-sm font-bold shadow-md shadow-blue-200">
                                <i class="fas fa-eye mr-2"></i>Details
                            </a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enquiry->phone) }}" target="_blank"
                                class="flex-1 bg-white text-center text-gray-700 border border-gray-200 py-2 rounded-lg text-sm font-bold hover:bg-gray-100">
                                WhatsApp
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-10">No enquiries available.</p>
                @endforelse
            </div>
        </div>
    </main>

    <div id="enquiryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" onclick="closeModal()"></div>
            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Enquiry #<span id="m_id"></span></h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600"><i
                                class="fas fa-times"></i></button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-3 bg-blue-50 rounded-xl">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg"
                                id="m_initials"></div>
                            <div>
                                <p class="font-bold text-gray-900" id="m_name"></p>
                                <p class="text-sm text-gray-500" id="m_phone"></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-y py-4 border-gray-100">
                            <div>
                                <p class="text-[10px] uppercase font-bold text-gray-400">Route</p>
                                <p class="text-sm font-semibold" id="m_route"></p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-gray-400">Pax & Vehicle</p>
                                <p class="text-sm font-semibold" id="m_pax"></p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-gray-400">Trip Dates</p>
                                <p class="text-sm font-semibold" id="m_dates"></p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-gray-400">Duration</p>
                                <p class="text-sm font-semibold" id="m_duration"></p>
                            </div>
                        </div>

                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 mb-1">Customer Note</p>
                            <div class="p-3 bg-gray-50 rounded-lg text-sm text-gray-600 italic border border-gray-100"
                                id="m_message"></div>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button onclick="closeModal()"
                            class="flex-1 px-4 py-2 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50">Close</button>
                        <a id="m_whatsapp" target="_blank"
                            class="flex-1 px-4 py-2 bg-green-600 text-white text-center rounded-lg font-semibold hover:bg-green-700">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // 1. Toggle Dropdown on Click
            $(document).on('click', '.dropdown-toggle', function(e) {
                e.stopPropagation();

                // Find the specific menu for this button
                let currentMenu = $(this).siblings('.dropdown-menu');

                // Close all other open dropdowns first
                $('.dropdown-menu').not(currentMenu).addClass('hidden');

                // Toggle current menu
                currentMenu.toggleClass('hidden');
            });

            // 2. Close Dropdowns when clicking anywhere else on the document
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown-container').length) {
                    $('.dropdown-menu').addClass('hidden');
                }
            });

            // 3. Close Dropdown when an option is clicked
            $(document).on('click', '.dropdown-menu button', function() {
                $(this).closest('.dropdown-menu').addClass('hidden');
            });

            // 4. Modal Population (View Details)
            $(document).on('click', '.viewEnquiryBtn', function() {
                const data = $(this).data('enquiry');

                // Fill Modal Data (Matches the IDs from your modal HTML)
                $('#m_id').text(data.enq_id);
                $('#m_name').text(data.name || 'Guest User');
                $('#m_initials').text((data.name || 'GU').substring(0, 2).toUpperCase());
                $('#m_phone').text(data.phone);
                $('#m_route').text(`${data.from_location} ➔ ${data.to_location}`);
                $('#m_pax').text(`${data.no_of_pax} Pax (${data.vehicle_type})`);
                $('#m_dates').text(`${data.start_date} to ${data.end_date}`);
                $('#m_message').text(data.message || 'No specific message provided.');
                $('#m_whatsapp').attr('href', `https://wa.me/${data.phone.replace(/\D/g,'')}`);

                // Show Modal
                $('#enquiryModal').removeClass('hidden');
            });
        });

        // Close Modal Function
        function closeModal() {
            $('#enquiryModal').addClass('hidden');
        }

        function updateStatus(enquiry_id, status) {
            // Generate the URL with a placeholder string 'ID_PLACEHOLDER'
            let url = "{{ route('tour-enquiry.update', ':id') }}";
            url = url.replace(':id', enquiry_id);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PATCH',
                    status: status
                },
                success: function(response) {
                    // Reloading is usually best to refresh all the status badges/colors
                    location.reload();
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        function deleteEnquiry(enquiry_id) {}
    </script>
@endsection
