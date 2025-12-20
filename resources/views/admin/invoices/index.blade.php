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
                <button type="button" id="createInvoiceBtn"
                    class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl flex items-center justify-center space-x-2 w-full sm:w-auto">
                    <i class="fas fa-plus"></i>
                    <span>Create Invoice</span>
                </button>
            </div>

            @include('include.alerts')

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
                            @forelse ($invoices as $invoice)
                                @php
                                    $descriptions = json_decode($invoice->description, true);
                                    $dates = json_decode($invoice->dates, true);
                                    $price = json_decode($invoice->price, true);

                                    if ($invoice->payment_status == 'unpaid') {
                                        $status_color = 'red';
                                    } elseif ($invoice->payment_status == 'paid') {
                                        $status_color = 'green';
                                    } elseif ($invoice->payment_status == 'advance-paid') {
                                        $status_color = 'yellow';
                                    } else {
                                        $status_color = 'gray';
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('invoice.show', ['invoice' => $invoice->id]) }}"
                                            class="text-blue-600 font-semibold hover:underline">
                                            {{ $invoice->invoice_no }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-gray-900 font-medium">
                                                {{ $invoice->customer?->full_name ?? $invoice->manual_customer_name }}</p>
                                            <p class="text-gray-500 text-xs">
                                                {{ $invoice->customer?->customer_type ?? 'Default Customer' }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-gray-600 text-sm italic">{{ $descriptions[0] ?? 'Default Customer' }}...</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-gray-900 font-bold">₹{{ number_format($invoice->total_amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-{{ $status_color }}-100 text-{{ $status_color }}-600 px-3 py-1 rounded-full text-xs font-medium">{{ ucfirst($invoice->payment_status) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-2">
                                            <a href="{{ route('invoice.show', ['invoice' => $invoice->id]) }}"
                                                class="text-blue-600 hover:text-blue-700 p-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('invoice.edit', ['invoice' => $invoice->id]) }}"
                                                class="editInvoiceBtn text-yellow-600 hover:text-yellow-700 p-2"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
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
                    @forelse ($invoices as $invoice)
                        @php
                            $descriptions = json_decode($invoice->description, true);
                        @endphp
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <span class="text-blue-600 font-semibold text-lg">{{ $invoice->invoice_no }}</span>
                                    <p class="text-gray-900 font-medium mt-1">
                                        {{ $invoice->customer?->full_name ?? ($invoice->manual_customer_name ?? $invoice->manual_customer_name) }}
                                    </p>
                                    <p class="text-gray-500 text-xs tracking-wider uppercase">
                                        {{ $invoice->customer?->customer_type ?? 'NA' }}</p>
                                </div>
                                <span
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium font-bold">₹{{ number_format($invoice->total_amount) }}</span>
                            </div>

                            <div class="space-y-2 mb-4">
                                <p class="text-sm text-gray-600 line-clamp-1">
                                    <i
                                        class="fas fa-info-circle mr-2 text-gray-400"></i>{{ $descriptions[0] ?? 'No description' }}
                                </p>
                                <div class="flex items-center text-gray-500 text-xs">
                                    <i class="fas fa-calendar-alt w-5 mr-2"></i>
                                    <span>Bill Date: {{ $invoice->invoice_date }}</span>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2 pt-3 border-t border-gray-200">
                                <a href="{{ route('invoice.show', ['invoice' => $invoice->id]) }}"
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

    <!-- INVOICE TYPE SELECTION MODAL -->
    <div id="invoiceTypeModal"
        class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300">
        <div class="relative w-full max-w-md transform transition-all">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
                    <h5 class="text-xl font-black text-gray-900 tracking-tight">Create Invoice</h5>
                    <button type="button"
                        class="closeModal text-gray-400 hover:text-gray-600 transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <a href="{{ route('invoice.create') }}"
                        class="group block p-5 bg-gray-50 hover:bg-blue-600 border border-gray-100 hover:border-blue-500 rounded-3xl transition-all duration-300 shadow-sm hover:shadow-blue-200">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 bg-blue-100 group-hover:bg-blue-500 rounded-2xl flex items-center justify-center text-blue-600 group-hover:text-white transition-colors duration-300">
                                <i class="fas fa-file-invoice text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 group-hover:text-white transition-colors">Normal Invoice
                                </h4>
                                <p class="text-xs text-gray-500 group-hover:text-blue-100 transition-colors">Fetch data
                                    from existing bookings.</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-white transition-colors"></i>
                        </div>
                    </a>

                    <a href="{{ route('invoice.instant') }}"
                        class="group block p-5 bg-gray-50 hover:bg-amber-500 border border-gray-100 hover:border-amber-400 rounded-3xl transition-all duration-300 shadow-sm hover:shadow-amber-200">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 bg-amber-100 group-hover:bg-amber-400 rounded-2xl flex items-center justify-center text-amber-600 group-hover:text-white transition-colors duration-300">
                                <i class="fas fa-bolt text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 group-hover:text-white transition-colors">Instant Manual
                                    Bill</h4>
                                <p class="text-xs text-gray-500 group-hover:text-amber-50 transition-colors">Quick billing
                                    for manual entry.</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-white transition-colors"></i>
                        </div>
                    </a>
                </div>

                <div class="p-4 bg-gray-50/50 text-center">
                    <button type="button"
                        class="closeModal text-gray-400 text-xs font-black uppercase tracking-widest hover:text-gray-600 transition-colors">
                        Nevermind, Go Back
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
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
    </script> --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // 1. Show Modal
            // Select the button that has the data-bs-target="#invoiceTypeModal"
            $('#createInvoiceBtn').on('click', function(e) {
                e.preventDefault();
                $('#invoiceTypeModal').removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden'); // Stop page scrolling when modal is open
            });

            // 2. Close Modal Function
            function hideInvoiceModal() {
                $('#invoiceTypeModal').addClass('hidden').removeClass('flex');
                $('body').removeClass('overflow-hidden');
            }

            // 3. Close on Close Button Click
            $('.closeModal').on('click', function() {
                hideInvoiceModal();
            });

            // 4. Close on Clicking Outside the Modal Box
            $('#invoiceTypeModal').on('click', function(e) {
                if (e.target === this) {
                    hideInvoiceModal();
                }
            });

            // 5. Close on Escape Key
            $(document).on('keydown', function(e) {
                if (e.key === "Escape") {
                    hideInvoiceModal();
                }
            });
        });
    </script>
@endsection
