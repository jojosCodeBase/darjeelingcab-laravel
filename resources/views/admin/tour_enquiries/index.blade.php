@extends('layouts.admin-main')
@section('title', 'Tour Enquiries')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-inbox"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">New Enquiries</p>
                    <p class="text-2xl font-bold text-gray-900">24</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pending Review</p>
                    <p class="text-2xl font-bold text-gray-900">12</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-check-double"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Converted</p>
                    <p class="text-2xl font-bold text-gray-900">158</p>
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
                            <th class="px-6 py-4 text-gray-600 font-semibold text-sm text-right">Actions</th>
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
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href=""
                                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <button
                                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                        <form action="" method="POST"
                                            onsubmit="return confirm('Delete this enquiry?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
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
@endsection
@section('scripts')
@endsection
