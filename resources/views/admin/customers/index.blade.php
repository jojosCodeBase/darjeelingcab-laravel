@extends('layouts.admin-main')
@section('title', 'Customers')
@section('content')
    <!-- Main Content -->
    <main class="p-4 sm:p-6 lg:p-8">
        <!-- CUSTOMERS SECTION -->
        <div id="customersSection">
            <!-- Header with Actions -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-gray-900 text-xl font-bold mb-1">All Customers</h3>
                    <p class="text-gray-500 text-sm">Add, edit, and manage customer information</p>
                </div>

                <a href="{{ route('customer.create') }}">
                    <button
                        class="w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Add Customer</span>
                    </button>
                </a>
            </div>

            @include('include.alerts')

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="text-gray-600 text-sm mb-2 block">Search Customers</label>
                        <div class="flex items-center bg-gray-100 rounded-lg px-4 py-2">
                            <i class="fas fa-search text-gray-400 mr-2"></i>
                            <input type="text" id="searchCustomer" placeholder="Name, email, phone..."
                                class="bg-transparent text-gray-900 outline-none text-sm w-full">
                        </div>
                    </div>

                    <!-- Customer Type Filter -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Customer Type</label>
                        <select id="typeFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                            <option value="all">All Types</option>
                            <option value="direct">Direct Customer</option>
                            <option value="agent">Agent</option>
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Sort By</label>
                        <select id="sortFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                            <option value="recent">Most Recent</option>
                            <option value="name">Name (A-Z)</option>
                            <option value="bookings">Most Bookings</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Customers List -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Customer</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Contact</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Type</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Location</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Total Bookings</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Joined</th>
                                <th class="px-6 py-4 text-left text-gray-600 font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($customers as $customer)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                                <span
                                                    class="text-white font-semibold">{{ strtoupper(substr($customer->full_name, 0, 2)) }}</span>
                                            </div>
                                            <div>
                                                <p class="text-gray-900 font-medium">{{ $customer->full_name }}</p>
                                                <p class="text-gray-500 text-sm">ID: #{{ $customer->cust_id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-gray-900">{{ $customer->phone_no }}</p>
                                        <p class="text-gray-500 text-sm">{{ $customer->email ?? 'NA' }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-medium {{ $customer->customer_type == 'Agent' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700' }}">
                                            {{ $customer->customer_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 max-w-xs truncate">
                                        {{ $customer->address }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">NA</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $customer->created_at ? $customer->created_at->format('M d, Y') : 'NA' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <button class="text-blue-600 hover:text-blue-700 p-2 viewCustomerbtn"
                                                title="View" data-type="{{ $customer->customer_type }}"
                                                data-name="{{ $customer->full_name }}"
                                                data-phone="{{ $customer->phone_no }}" data-email="{{ $customer->email }}"
                                                data-address="{{ $customer->address }}" data-city="{{ $customer->city }}"
                                                data-state="{{ $customer->state }}" data-notes="{{ $customer->notes }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                                                class="text-yellow-600 hover:text-yellow-700 p-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-700 p-2 delete-button"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">No customers
                                        found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="lg:hidden p-4 space-y-4">
                    @forelse ($customers as $customer)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-start space-x-3 mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span
                                        class="text-white font-semibold">{{ strtoupper(substr($customer->full_name, 0, 2)) }}</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-semibold">{{ $customer->full_name }}</p>
                                    <p class="text-gray-500 text-sm">ID: #{{ $customer->cust_id }}</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ $customer->phone_no }}</p>
                                    <p class="text-gray-500 text-sm">{{ $customer->email ?? 'NA' }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div>
                                    <p class="text-gray-500 text-xs mb-1">Type</p>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium {{ $customer->customer_type == 'Agent' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $customer->customer_type }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs mb-1">Total Bookings</p>
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">NA</span>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-500 text-xs mb-1">Location</p>
                                    <p class="text-gray-900 text-sm">{{ $customer->address }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 pt-3 border-t border-gray-200">
                                <button
                                    class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium viewCustomerbtn"
                                    data-name="{{ $customer->full_name }}" data-phone="{{ $customer->phone_no }}"
                                    data-email="{{ $customer->email }}" data-address="{{ $customer->address }}"
                                    data-city="{{ $customer->city }}" data-state="{{ $customer->state }}"
                                    data-notes="{{ $customer->notes }}">
                                    <i class="fas fa-eye mr-2"></i>View
                                </button>
                                <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}"
                                    class="flex-1 bg-yellow-600 text-center text-white px-4 py-2 rounded-lg text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div
                            class="text-center p-8 text-gray-500 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                            No customers found
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <div id="viewCustomerModal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">

            <!-- Modal Header -->
            <div class="sticky top-0 bg-white border-b border-gray-200 p-6 flex items-center justify-between">
                <h3 class="text-gray-900 text-xl font-bold">Customer Details</h3>
                <button id="closeViewModalBtn" class="text-gray-500 hover:text-gray-900">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <div class="p-6">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-6 mb-6 text-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-3xl font-bold mb-2" id="modal-customer-name-header">...</h1>
                            <p class="text-blue-100">Customer Profile</p>
                        </div>
                        <div class="text-right"> 
                            <p class="text-blue-100 text-sm">Customer Type</p>
                            <p class="text-2xl font-bold uppercase" id="modal-customer-type">...</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h4 class="text-gray-600 text-sm mb-3 font-semibold">CONTACT DETAILS</h4>
                        <p class="text-gray-900 font-semibold mb-1" id="modal-full-name">...</p>
                        <p class="text-gray-600 text-sm" id="modal-email">...</p>
                        <p class="text-gray-600 text-sm" id="modal-phone">...</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h4 class="text-gray-600 text-sm mb-3 font-semibold">LOCATION DETAILS</h4>
                        <p class="text-gray-900 mb-1"><span class="text-gray-600">Address:</span> <span
                                id="modal-address">...</span></p>
                        <p class="text-gray-900 mb-1"><span class="text-gray-600">City:</span> <span
                                id="modal-city">...</span></p>
                        <p class="text-gray-900 mb-1"><span class="text-gray-600">State:</span> <span
                                id="modal-state">...</span></p>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                    <h4 class="text-blue-800 text-sm mb-2 font-semibold">INTERNAL NOTES</h4>
                    <p class="text-blue-700 text-sm italic" id="modal-notes">...</p>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // 1. Listen for click on the View Button
            $('.viewCustomerbtn').on('click', function() {

                // 2. Extract data from the button's data attributes
                const name = $(this).data('name');
                let type = $(this).data('type');
                const phone = $(this).data('phone');
                const email = $(this).data('email') || 'No email provided';
                const address = $(this).data('address');
                const city = $(this).data('city') || 'N/A';
                const state = $(this).data('state') || 'N/A';
                const notes = $(this).data('notes') || 'No additional notes.';

                if (type == "Customer") {
                    type = "Direct Customer";
                }

                // 3. Inject data into the modal placeholders
                $('#modal-customer-name-header').text(name);
                $('#modal-customer-type').text(type);
                $('#modal-full-name').text(name);
                $('#modal-email').text(email);
                $('#modal-phone').text(phone);
                $('#modal-address').text(address);
                $('#modal-city').text(city);
                $('#modal-state').text(state);
                $('#modal-notes').text('"' + notes + '"');

                // 4. Show the modal
                $('#viewCustomerModal').removeClass('hidden').addClass('flex');
            });

            // 5. Close Modal Logic
            $('#closeViewModal, #closeViewModalBtn').on('click', function() {
                $('#viewCustomerModal').addClass('hidden').removeClass('flex');
            });

            // Close on clicking outside the modal content
            $('#viewCustomerModal').on('click', function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden').removeClass('flex');
                }
            });
        });
    </script>
@endsection
