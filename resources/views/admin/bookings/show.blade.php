@extends('layouts.admin-main')

@section('title', 'Booking Details')

@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('bookings') }}"
                        class="p-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-arrow-left text-gray-600"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Booking Details</h1>
                        <p class="text-gray-500">ID: <span
                                class="font-mono font-bold text-blue-600">#{{ $booking->booking_id }}</span></p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button
                        class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-50">
                        <i class="fas fa-print mr-2"></i> Print
                    </button>
                    <a href="{{ route('bookings.edit', $booking->id) }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 shadow-md transition-all flex items-center">
                        <i class="fas fa-edit mr-2"></i> Edit Booking
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800">Trip Overview</h3>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'confirmed' => 'bg-green-100 text-green-700',
                                    'completed' => 'bg-blue-100 text-blue-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span
                                class="{{ $statusColors[$booking->status] ?? 'bg-gray-100' }} px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                {{ $booking->status }}
                            </span>
                        </div>
                        <div class="p-6">
                            @php
                                $dates = json_decode($booking->day_date, true);
                                $destinations = json_decode($booking->destination, true);
                                $startDate = \Carbon\Carbon::parse($dates[0]);
                                $endDate = \Carbon\Carbon::parse(end($dates));
                            @endphp

                            <div class="relative flex items-center justify-between mb-8">
                                <div
                                    class="absolute left-0 right-0 top-1/2 h-0.5 border-t-2 border-dashed border-gray-200 -z-0">
                                </div>

                                <div class="relative z-10 bg-white pr-4">
                                    <p class="text-xs uppercase font-bold text-gray-400 mb-1">Start Date</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $startDate->format('d M Y') }}</p>
                                </div>

                                <div class="relative z-10 bg-white px-4 text-center">
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center border border-indigo-100 mx-auto">
                                        <i class="fas fa-calendar-alt text-indigo-600"></i>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1 font-medium">
                                        {{ $startDate->diffInDays($endDate) + 1 }} Days</p>
                                </div>

                                <div class="relative z-10 bg-white pl-4 text-right">
                                    <p class="text-xs uppercase font-bold text-gray-400 mb-1">End Date</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $endDate->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-6 pt-6 border-t border-gray-100">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1 font-medium">Total Pax</p>
                                    <p class="font-semibold text-gray-900 flex items-center gap-2">
                                        <i
                                            class="fas fa-users text-indigo-500"></i>{{ $booking->pax ?? $booking->adults + $booking->child }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1 font-medium">Fare Amount</p>
                                    <p class="font-semibold text-gray-900 flex items-center gap-2">
                                        <i
                                            class="fas fa-rupee-sign text-green-500"></i>{{ number_format($booking->fare_amount, 2) }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1 font-medium">Updated By</p>
                                    <p class="font-semibold text-gray-900 flex items-center gap-2 text-sm">
                                        <i class="fas fa-user-edit text-blue-500"></i>{{ $booking->user->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Vehicle & Driver Assignment</h3>
                        <div class="space-y-4">
                            @foreach (json_decode($booking->vehicle_type, true) as $key => $vehicleType)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                                        <div
                                            class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-gray-200 shadow-sm text-xl text-gray-700">
                                            <i class="fas fa-car-side"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Vehicle
                                                Number
                                            </p>
                                            <div
                                                class="mt-1 inline-flex items-center bg-white border-2 border-gray-800 rounded px-2 py-0.5 font-mono font-bold text-gray-900 shadow-sm">
                                                <span
                                                    class="text-[10px] border-r border-gray-800 pr-1 mr-1 text-blue-700">IND</span>
                                                {{ json_decode($booking->vehicle_no, true)[$key] }}
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1 font-medium italic">{{ $vehicleType }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                                        <div class="relative">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(json_decode($booking->driver_name, true)[$key]) }}&background=6366f1&color=fff"
                                                alt="Driver"
                                                class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Driver</p>
                                            <p class="text-md font-bold text-gray-900">
                                                {{ json_decode($booking->driver_name, true)[$key] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Day-wise Itinerary</h3>
                        <div class="relative space-y-6">
                            <div class="absolute left-4 top-2 bottom-2 w-0.5 bg-gray-100"></div>
                            @foreach ($dates as $key => $date)
                                <div class="relative pl-10">
                                    <div
                                        class="absolute left-2.5 top-1.5 w-3.5 h-3.5 rounded-full bg-indigo-500 border-4 border-white shadow-sm">
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                        <p class="text-xs font-bold text-indigo-600 mb-1">DAY {{ $key + 1 }} •
                                            {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</p>
                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $destinations[$key] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Customer Details</h3>
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold border border-indigo-200 text-lg">
                                {{ substr($booking->customer->full_name, 0, 1) }}{{ substr(strrchr($booking->customer->full_name, ' '), 1, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $booking->customer->full_name }}</p>
                                <p class="text-xs text-gray-500 font-medium capitalize">
                                    {{ $booking->customer->customer_type }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <a href="tel:{{ $booking->customer->phone_no }}"
                                class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-phone text-green-500"></i>
                                <span class="text-sm font-semibold text-gray-700">{{ $booking->customer->phone_no }}</span>
                            </a>
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                                <i class="fas fa-envelope text-blue-500"></i>
                                <span
                                    class="text-sm font-semibold text-gray-700 truncate">{{ $booking->customer->email ?? 'No Email' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-widest">System Info</h3>
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-green-500 ring-4 ring-green-100"></div>
                                    <div class="w-0.5 h-10 bg-gray-100"></div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-900 uppercase">Last Updated</p>
                                    <p class="text-[10px] text-gray-500 font-medium">
                                        {{ $booking->updated_at->format('M d, h:i A') }}</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-gray-300"></div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Booking Created</p>
                                    <p class="text-[10px] text-gray-500 font-medium">
                                        {{ $booking->created_at->format('M d, h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
