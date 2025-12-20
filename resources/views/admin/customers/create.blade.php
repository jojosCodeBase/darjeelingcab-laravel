@extends('layouts.admin-main')
@section('title', 'Add Customer')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div id="customerFormSection">
            <div class="mb-6">
                <a href="{{ url()->previous() ?? route('customers') }}">
                    <button class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Customers</span>
                    </button>
                </a>
                <h2 class="text-gray-900 text-2xl font-bold mb-1" id="formTitle">Add New Customer</h2>
                <p class="text-gray-500 text-sm">Fill in the customer details below</p>
            </div>

            @include('include.alerts')

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8">
                <form id="customerForm" method="POST" action="{{ route('customer.store') }}" class="needs-validation">
                    @csrf

                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-purple-600"></i>
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Full Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter full name">
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Customer Type <span
                                        class="text-danger">*</span></label>
                                <select name="customer_type" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="">Select customer type</option>
                                    <option value="Agent" @if (old('customer_type') == 'Agent') selected @endif>Agent</option>
                                    <option value="Customer" @if (old('customer_type') == 'Customer') selected @endif>Direct Customer
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="customer@email.com">
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Phone <span
                                        class="text-danger">*</span></label>
                                <input type="tel" name="phone_no" value="{{ old('phone_no') }}" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="+91 98765 43210">
                            </div>

                            <div class="md:col-span-2">
                                <label class="text-gray-700 text-sm mb-2 block">Address <span
                                        class="text-danger">*</span></label>
                                <textarea rows="3" name="address" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter full address">{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                            Additional Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">City</label>
                                <input type="text" name="city" value="{{ old('city') }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="City name">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">State</label>
                                <input type="text" name="state" value="{{ old('state') }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="State name">
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-gray-700 text-sm mb-2 block">Notes</label>
                                <textarea rows="3" name="notes"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Any additional notes about the customer...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-save mr-2"></i>Save Customer
                        </button>
                        <button type="reset" id="cancelFormBtn"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-medium transition-all">
                            <i class="fas fa-times mr-2"></i>Reset Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
