@extends('layouts.admin-main')
@section('title', 'Invoices')
@section('content')
    <!-- Main Content -->
    <main class="p-4 sm:p-6 lg:p-8">
        <!-- INVOICES SECTION -->
        <div id="invoicesSection">
            <!-- Header with Actions -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-gray-900 text-xl font-bold mb-1">All Invoices</h3>
                    <p class="text-gray-500 text-sm">Create, edit, and manage invoices</p>
                </div>
                <button id="createInvoiceBtn"
                    class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Create Invoice</span>
                </button>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label class="text-gray-600 text-sm mb-2 block">Search Invoices</label>
                        <div class="flex items-center bg-gray-100 rounded-lg px-4 py-2">
                            <i class="fas fa-search text-gray-400 mr-2"></i>
                            <input type="text" id="searchInvoice" placeholder="Invoice #, Customer name..."
                                class="bg-transparent text-gray-900 outline-none text-sm w-full">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Status</label>
                        <select id="statusFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                            <option value="all">All Status</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>

                    <!-- Date Filter -->
                    <div>
                        <label class="text-gray-600 text-sm mb-2 block">Date Range</label>
                        <select id="dateFilter"
                            class="w-full bg-gray-100 text-gray-900 rounded-lg px-4 py-2 outline-none border border-gray-200 focus:border-blue-500">
                            <option value="all">All Time</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Invoices List -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Invoice #</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Customer</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Description (Primary)</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Date</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Amount</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Status</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($bills as $bill)
                                @php
                                    $descriptions = json_decode($bill->description, true);
                                    $dates = json_decode($bill->dates, true);
                                    $price = json_decode($bill->price, true);
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('bill.show', ['bill' => $bill->id]) }}"
                                            class="text-blue-600 font-semibold hover:underline">
                                            {{ $bill->bill_no }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-gray-900 font-medium">{{ $bill->customer->full_name }}</p>
                                            <p class="text-gray-500 text-xs">{{ $bill->customer->customer_type }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-600 text-sm italic">{{ $descriptions[0] ?? 'NA' }}...</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ \Carbon\Carbon::parse($bill->bill_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-gray-900 font-bold">₹{{ number_format($bill->total_amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Generated</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-2">
                                            <a href="{{ route('bill.show', ['bill' => $bill->id]) }}"
                                                class="text-blue-600 hover:text-blue-700 p-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="editInvoiceBtn text-yellow-600 hover:text-yellow-700 p-2"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="deleteInvoiceBtn text-red-600 hover:text-red-700 p-2"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">No bills found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="lg:hidden p-4 space-y-4">
                    @forelse ($bills as $bill)
                        @php
                            $descriptions = json_decode($bill->description, true);
                        @endphp
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <span class="text-blue-600 font-semibold text-lg">{{ $bill->bill_no }}</span>
                                    <p class="text-gray-900 font-medium mt-1">{{ $bill->customer->full_name }}</p>
                                    <p class="text-gray-500 text-xs tracking-wider uppercase">
                                        {{ $bill->customer->customer_type }}</p>
                                </div>
                                <span
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium font-bold">₹{{ number_format($bill->total_amount) }}</span>
                            </div>

                            <div class="space-y-2 mb-4">
                                <p class="text-sm text-gray-600 line-clamp-1">
                                    <i
                                        class="fas fa-info-circle mr-2 text-gray-400"></i>{{ $descriptions[0] ?? 'No description' }}
                                </p>
                                <div class="flex items-center text-gray-500 text-xs">
                                    <i class="fas fa-calendar-alt w-5 mr-2"></i>
                                    <span>Bill Date: {{ $bill->bill_date }}</span>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2 pt-3 border-t border-gray-200">
                                <a href="{{ route('bill.show', ['bill' => $bill->id]) }}"
                                    class="flex-1 bg-blue-600 text-center text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors hover:bg-blue-700">
                                    <i class="fas fa-eye mr-2"></i>View Invoice
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-8 text-gray-500">No bills found</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- CREATE/EDIT INVOICE FORM -->
        <div id="invoiceFormSection" class="hidden">
            <div class="mb-6">
                <button id="backToListBtn" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Invoices</span>
                </button>
                <h2 class="text-gray-900 text-2xl font-bold mb-1" id="formTitle">Create New Invoice</h2>
                <p class="text-gray-500 text-sm">Fill in the details below</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8">
                <form id="invoiceForm">
                    <!-- Customer Information -->
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-blue-600"></i>
                            Customer Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Customer Name *</label>
                                <input type="text" id="customerName" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter customer name">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Email</label>
                                <input type="email" id="customerEmail"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="customer@email.com">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Phone *</label>
                                <input type="tel" id="customerPhone" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="+91 98765 43210">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Address</label>
                                <input type="text" id="customerAddress"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter address">
                            </div>
                        </div>
                    </div>

                    <!-- Trip Details -->
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-route mr-2 text-green-600"></i>
                            Trip Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">From *</label>
                                <input type="text" id="tripFrom" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Starting location">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">To *</label>
                                <input type="text" id="tripTo" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Destination">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Trip Date *</label>
                                <input type="date" id="tripDate" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Vehicle Type *</label>
                                <select id="vehicleType" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="">Select vehicle</option>
                                    <option value="sedan">Sedan</option>
                                    <option value="suv">SUV</option>
                                    <option value="tempo">Tempo Traveller</option>
                                    <option value="bus">Mini Bus</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-gray-700 text-sm mb-2 block">Trip Description</label>
                                <textarea id="tripDescription" rows="3"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Additional trip details..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Details -->
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-rupee-sign mr-2 text-purple-600"></i>
                            Billing Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Base Fare *</label>
                                <input type="number" id="baseFare" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="0.00" step="0.01">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Distance (km)</label>
                                <input type="number" id="distance"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="0" step="0.1">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Extra Charges</label>
                                <input type="number" id="extraCharges"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="0.00" step="0.01">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Discount</label>
                                <input type="number" id="discount"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="0.00" step="0.01">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Tax (%)</label>
                                <input type="number" id="taxPercent"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="0" step="0.1" value="5">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Payment Status *</label>
                                <select id="paymentStatus" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                            </div>
                        </div>

                        <!-- Total Calculation -->
                        <div
                            class="mt-6 bg-gradient-to-br from-blue-50 to-purple-50 rounded-lg p-6 border border-blue-200">
                            <div class="space-y-3">
                                <div class="flex justify-between text-gray-700">
                                    <span>Subtotal:</span>
                                    <span id="subtotalDisplay" class="font-medium">₹0.00</span>
                                </div>
                                <div class="flex justify-between text-gray-700">
                                    <span>Tax:</span>
                                    <span id="taxDisplay" class="font-medium">₹0.00</span>
                                </div>
                                <div class="flex justify-between text-gray-700">
                                    <span>Discount:</span>
                                    <span id="discountDisplay" class="font-medium text-red-600">-₹0.00</span>
                                </div>
                                <div
                                    class="border-t border-blue-300 pt-3 flex justify-between text-gray-900 text-xl font-bold">
                                    <span>Total Amount:</span>
                                    <span id="totalDisplay">₹0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-save mr-2"></i>Save Invoice
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

    <!-- VIEW INVOICE MODAL -->
    <div id="viewInvoiceModal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white border-b border-gray-200 p-6 flex items-center justify-between">
                <h3 class="text-gray-900 text-xl font-bold">Invoice Details</h3>
                <button id="closeViewModal" class="text-gray-500 hover:text-gray-900">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Invoice Content -->
            <div class="p-6">
                <!-- Invoice Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-6 mb-6 text-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">Darjeeling Cab</h1>
                            <p class="text-blue-100">Professional Cab Services</p>
                        </div>
                        <div class="text-right">
                            <p class="text-blue-100 text-sm">Invoice Number</p>
                            <p class="text-2xl font-bold">#INV-001</p>
                        </div>
                    </div>
                </div>

                <!-- Customer & Trip Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h4 class="text-gray-600 text-sm mb-3 font-semibold">CUSTOMER DETAILS</h4>
                        <p class="text-gray-900 font-semibold mb-1">Rajesh Kumar</p>
                        <p class="text-gray-600 text-sm">rajesh@email.com</p>
                        <p class="text-gray-600 text-sm">+91 98765 43210</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h4 class="text-gray-600 text-sm mb-3 font-semibold">TRIP DETAILS</h4>
                        <p class="text-gray-900 mb-1"><span class="text-gray-600">From:</span> Darjeeling</p>
                        <p class="text-gray-900 mb-1"><span class="text-gray-600">To:</span> Gangtok</p>
                        <p class="text-gray-900 mb-1"><span class="text-gray-600">Date:</span> Dec 15, 2025</p>
                        <p class="text-gray-900"><span class="text-gray-600">Vehicle:</span> SUV</p>
                    </div>
                </div>

                <!-- Billing Table -->
                <div class="bg-gray-50 rounded-lg overflow-hidden mb-6 border border-gray-200">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-700 text-sm font-semibold">Description</th>
                                <th class="px-4 py-3 text-right text-gray-700 text-sm font-semibold">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-3 text-gray-900">Base Fare</td>
                                <td class="px-4 py-3 text-gray-900 text-right">₹4,000</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-gray-900">Extra Charges</td>
                                <td class="px-4 py-3 text-gray-900 text-right">₹300</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-gray-900">Tax (5%)</td>
                                <td class="px-4 py-3 text-gray-900 text-right">₹215</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-gray-900">Discount</td>
                                <td class="px-4 py-3 text-red-600 text-right">-₹15</td>
                            </tr>
                            <tr class="bg-gray-100">
                                <td class="px-4 py-4 text-gray-900 font-bold text-lg">Total</td>
                                <td class="px-4 py-4 text-gray-900 font-bold text-lg text-right">₹4,500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Payment Status -->
                <div class="flex items-center justify-between mb-6">
                    <span class="text-gray-700">Payment Status:</span>
                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-medium">Paid</span>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-gray-200 p-6 flex flex-col sm:flex-row gap-3 bg-gray-50">
                <button
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <i class="fas fa-print mr-2"></i>Print Invoice
                </button>
                <button
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <i class="fas fa-download mr-2"></i>Download PDF
                </button>
                <button id="closeViewModalBtn"
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-medium transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const sidebar = document.getElementById('sidebar');
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

        openSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            mobileMenuOverlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });

        mobileMenuOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });

        // Invoice Form Calculations
        const baseFareInput = document.getElementById('baseFare');
        const extraChargesInput = document.getElementById('extraCharges');
        const discountInput = document.getElementById('discount');
        const taxPercentInput = document.getElementById('taxPercent');

        function calculateTotal() {
            const baseFare = parseFloat(baseFareInput.value) || 0;
            const extraCharges = parseFloat(extraChargesInput.value) || 0;
            const discount = parseFloat(discountInput.value) || 0;
            const taxPercent = parseFloat(taxPercentInput.value) || 0;

            const subtotal = baseFare + extraCharges;
            const tax = (subtotal * taxPercent) / 100;
            const total = subtotal + tax - discount;

            document.getElementById('subtotalDisplay').textContent = `₹${subtotal.toFixed(2)}`;
            document.getElementById('taxDisplay').textContent = `₹${tax.toFixed(2)}`;
            document.getElementById('discountDisplay').textContent = `-₹${discount.toFixed(2)}`;
            document.getElementById('totalDisplay').textContent = `₹${total.toFixed(2)}`;
        }

        [baseFareInput, extraChargesInput, discountInput, taxPercentInput].forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        // Create Invoice Button
        document.getElementById('createInvoiceBtn').addEventListener('click', () => {
            document.getElementById('invoicesSection').classList.add('hidden');
            document.getElementById('invoiceFormSection').classList.remove('hidden');
            document.getElementById('formTitle').textContent = 'Create New Invoice';
            document.getElementById('invoiceForm').reset();
            calculateTotal();
        });

        // Back to List Button
        document.getElementById('backToListBtn').addEventListener('click', () => {
            document.getElementById('invoiceFormSection').classList.add('hidden');
            document.getElementById('invoicesSection').classList.remove('hidden');
        });

        // Cancel Form Button
        document.getElementById('cancelFormBtn').addEventListener('click', () => {
            document.getElementById('invoiceFormSection').classList.add('hidden');
            document.getElementById('invoicesSection').classList.remove('hidden');
        });

        // Edit Invoice Buttons
        document.querySelectorAll('.editInvoiceBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('invoicesSection').classList.add('hidden');
                document.getElementById('invoiceFormSection').classList.remove('hidden');
                document.getElementById('formTitle').textContent = 'Edit Invoice';
            });
        });

        // View Invoice Modal
        const viewInvoiceModal = document.getElementById('viewInvoiceModal');
        const closeViewModal = document.getElementById('closeViewModal');
        const closeViewModalBtn = document.getElementById('closeViewModalBtn');

        document.querySelectorAll('.viewInvoiceBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                viewInvoiceModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        });

        [closeViewModal, closeViewModalBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                viewInvoiceModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
        });

        // Close modal on outside click
        viewInvoiceModal.addEventListener('click', (e) => {
            if (e.target === viewInvoiceModal) {
                viewInvoiceModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Delete Invoice
        document.querySelectorAll('.deleteInvoiceBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm('Are you sure you want to delete this invoice?')) {
                    alert('Invoice deleted successfully!');
                }
            });
        });

        // Form Submission
        document.getElementById('invoiceForm').addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Invoice saved successfully!');
            document.getElementById('invoiceFormSection').classList.add('hidden');
            document.getElementById('invoicesSection').classList.remove('hidden');
        });
    </script>
@endsection
