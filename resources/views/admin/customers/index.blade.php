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
                <button id="addCustomerBtn"
                    class="bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                    <i class="fas fa-user-plus"></i>
                    <span>Add Customer</span>
                </button>
            </div>

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
                                                <p class="text-gray-500 text-sm">ID: #CUST-{{ $customer->id }}</p>
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
                                            <button class="text-blue-600 hover:text-blue-700 p-2" title="View"
                                                data-bs-toggle="modal" data-bs-target="#customerModal"
                                                data-type="{{ $customer->customer_type }}"
                                                data-name="{{ $customer->full_name }}"
                                                data-phone="{{ $customer->phone_no }}" data-email="{{ $customer->email }}"
                                                data-address="{{ $customer->address }}">
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
                                    <p class="text-gray-500 text-sm">ID: #CUST-{{ $customer->id }}</p>
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
                                <button class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium"
                                    data-bs-toggle="modal" data-bs-target="#customerModal"
                                    data-type="{{ $customer->customer_type }}" data-name="{{ $customer->full_name }}"
                                    data-phone="{{ $customer->phone_no }}" data-email="{{ $customer->email }}"
                                    data-address="{{ $customer->address }}">
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

        <!-- ADD/EDIT CUSTOMER FORM -->
        <div id="customerFormSection" class="hidden">
            <div class="mb-6">
                <button id="backToListBtn" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Customers</span>
                </button>
                <h2 class="text-gray-900 text-2xl font-bold mb-1" id="formTitle">Add New Customer</h2>
                <p class="text-gray-500 text-sm">Fill in the customer details below</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8">
                <form id="customerForm">
                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-purple-600"></i>
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Full Name *</label>
                                <input type="text" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter full name">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Customer Type *</label>
                                <select required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="">Select customer type</option>
                                    <option value="direct">Direct Customer</option>
                                    <option value="agent">Agent</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Email</label>
                                <input type="email"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="customer@email.com">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Phone *</label>
                                <input type="tel" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="+91 98765 43210">
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-gray-700 text-sm mb-2 block">Address</label>
                                <textarea rows="3"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter full address"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                            Additional Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">City</label>
                                <input type="text"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="City name">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">State</label>
                                <input type="text"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="State name">
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-gray-700 text-sm mb-2 block">Notes</label>
                                <textarea rows="3"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Any additional notes about the customer..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-save mr-2"></i>Save Customer
                        </button>
                        <button type="button" id="cancelFormBtn"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-medium transition-all">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Add Customer Button
        document.getElementById('addCustomerBtn').addEventListener('click', () => {
            document.getElementById('customersSection').classList.add('hidden');
            document.getElementById('customerFormSection').classList.remove('hidden');
            document.getElementById('formTitle').textContent = 'Add New Customer';
            document.getElementById('customerForm').reset();
        });

        // Back to List Button
        document.getElementById('backToListBtn').addEventListener('click', () => {
            document.getElementById('customerFormSection').classList.add('hidden');
            document.getElementById('customersSection').classList.remove('hidden');
        });

        // Cancel Form Button
        document.getElementById('cancelFormBtn').addEventListener('click', () => {
            document.getElementById('customerFormSection').classList.add('hidden');
            document.getElementById('customersSection').classList.remove('hidden');
        });

        // Edit Customer Buttons
        document.querySelectorAll('.editCustomerBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('customersSection').classList.add('hidden');
                document.getElementById('customerFormSection').classList.remove('hidden');
                document.getElementById('formTitle').textContent = 'Edit Customer';
            });
        });

        // View Customer Buttons
        document.querySelectorAll('.viewCustomerBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                alert('View customer details (to be implemented)');
            });
        });

        // Delete Customer
        document.querySelectorAll('.deleteCustomerBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm('Are you sure you want to delete this customer?')) {
                    alert('Customer deleted successfully!');
                }
            });
        });

        // Form Submission
        document.getElementById('customerForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Customer saved successfully!');
            document.getElementById('customerFormSection').classList.add('hidden');
            document.getElementById('customersSection').classList.remove('hidden');
        });
    </script>
@endsection
@section('scripts')
@endsection
