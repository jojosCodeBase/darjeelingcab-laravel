@extends('layouts.admin-main')
@section('title', 'Edit Customer')
@section('content')
    <!-- Main Content -->
    <main class="p-4 sm:p-6 lg:p-8">
        <!-- ADD CUSTOMER FORM -->
        <div id="customerFormSection">
            <div class="mb-6">
                <a href="{{ route('customers') }}" class="text-gray-600 hover:text-gray-900 flex items-center space-x-2 mb-4">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Customers</span>
                </a>
                <h2 class="text-gray-900 text-2xl font-bold mb-1" id="formTitle">Edit Customer Details</h2>
                <p class="text-gray-500 text-sm">Update the information for <strong>{{ $customer->full_name }}</strong></p>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8">
                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-8">
                        <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-purple-600"></i>
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Full Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name', $customer->full_name) }}"
                                    required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border @error('full_name') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter full name">
                                @error('full_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Customer Type <span
                                        class="text-red-500">*</span></label>
                                <select name="customer_type" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border @error('customer_type') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="" disabled>Select customer type</option>
                                    <option value="Agent"
                                        {{ old('customer_type', $customer->customer_type) == 'Agent' ? 'selected' : '' }}>
                                        Agent
                                    </option>
                                    <option value="Customer"
                                        {{ old('customer_type', $customer->customer_type) == 'Customer' ? 'selected' : '' }}>
                                        Customer</option>
                                </select>
                                @error('customer_type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Email</label>
                                <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border @error('email') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="customer@email.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">Phone <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" name="phone_no" value="{{ old('phone_no', $customer->phone_no) }}"
                                    required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border @error('phone_no') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="+91 98765 43210">
                                @error('phone_no')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="text-gray-700 text-sm mb-2 block">Address <span
                                        class="text-red-500">*</span></label>
                                <textarea rows="3" name="address" required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border @error('address') border-red-500 @else border-gray-200 @enderror focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Enter full address">{{ old('address', $customer->address) }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
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
                                <input type="text" name="city" value="{{ old('city', $customer->city ?? '') }}"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="City name">
                            </div>
                            <div>
                                <label class="text-gray-700 text-sm mb-2 block">State <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="state" value="{{ old('state', $customer->state ?? '') }}"
                                    required
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="State name">
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-gray-700 text-sm mb-2 block">Notes</label>
                                <textarea rows="3" name="notes"
                                    class="w-full bg-gray-50 text-gray-900 rounded-lg px-4 py-3 outline-none border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                    placeholder="Any additional notes about the customer...">{{ old('notes', $customer->notes ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-sync-alt mr-2"></i>Update Customer
                        </button>
                        <a href="{{ route('customers') }}"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-medium transition-all text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
