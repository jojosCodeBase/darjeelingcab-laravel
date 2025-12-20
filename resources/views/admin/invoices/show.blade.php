@extends('layouts.admin-main')
@section('title', 'View Invoice')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
         <a href="{{ route('invoices') }}" class="text-blue-600 flex items-center text-sm font-bold mb-2">
                    <i class="fas fa-chevron-left mr-2"></i> Back to Invoices
                </a>
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight text-uppercase">View Invoice</h1>
                <p class="text-sm text-gray-500">Invoice details and breakdown for your records</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('invoice.edit', ['invoice' => $invoice->id]) }}"
                    class="flex-1 sm:flex-none inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all shadow-sm">
                    <i class="fas fa-edit mr-2 text-blue-600"></i> Edit
                </a>
                <button type="button"
                    onclick="window.location.href='{{ route('invoice.pdf', ['invoice' => $invoice->id]) }}'"
                    class="flex-1 sm:flex-none inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-red-700 transition-all shadow-md shadow-red-100">
                    <i class="fas fa-file-pdf mr-2"></i> PDF
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-100 bg-gray-50/50 border-b border-gray-200">
                <div class="p-6 text-center md:text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Customer</label>
                    <p class="text-lg font-bold text-gray-900">
                        {{ $invoice->customer->full_name ?? $invoice->manual_customer_name }}</p>
                    <p class="text-xs text-gray-500">Party ID: #{{ $invoice->party_id ?? 'NA' }}</p>
                </div>
                <div class="p-6 text-center md:text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Invoice Date</label>
                    <p class="text-lg font-bold text-gray-900">
                        <i class="far fa-calendar-alt mr-2 text-indigo-500"></i>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}
                    </p>
                </div>
                <div class="p-6 text-center md:text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Invoice Number</label>
                    <p class="text-lg font-mono font-bold text-blue-600 leading-none mt-1">
                        {{ $invoice->invoice_no }}
                    </p>
                </div>
            </div>

            @php
                $descriptions = json_decode($invoice->description, true);
                $dates = json_decode($invoice->dates, true);
                $price = json_decode($invoice->price, true);
                $amount = json_decode($invoice->amount, true);
                $combined = array_map(null, $descriptions, $dates, $price, $amount);
            @endphp

            <div class="hidden lg:block p-0 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-gray-200">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider w-16">Sl.no</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider w-1/2">Description</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Date</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Price</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($combined as $index => $data)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $data[0] }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                        {{ \Carbon\Carbon::parse($data[1])->format('D, d M Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium text-gray-600">₹{{ number_format($data[2]) }}</td>
                                <td class="px-6 py-4 text-right text-sm font-bold text-gray-900">₹{{ number_format($data[3]) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="block lg:hidden divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-2 border-b border-gray-100">
                    <span class="text-[10px] font-black text-gray-400 uppercase">Item Breakdown</span>
                </div>
                @foreach ($combined as $index => $data)
                    <div class="p-4 bg-white space-y-3">
                        <div class="flex justify-between items-start">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-500 text-[10px] font-bold">
                                {{ $index + 1 }}
                            </span>
                            <span class="text-xs font-bold text-indigo-600">
                                {{ \Carbon\Carbon::parse($data[1])->format('d M, Y') }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 leading-tight">{{ $data[0] }}</p>
                        </div>
                        <div class="flex justify-between items-end pt-2 border-t border-gray-50">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold">Unit Price</p>
                                <p class="text-sm text-gray-600">₹{{ number_format($data[2]) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-bold">Subtotal</p>
                                <p class="text-base font-black text-gray-900">₹{{ number_format($data[3]) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-gray-50/50 p-6 flex flex-col items-center md:items-end">
                <div class="w-full md:w-80 space-y-3 border-t md:border-t-0 pt-4 md:pt-0">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 font-medium">Total Amount</span>
                        <span class="text-gray-900 font-bold">₹{{ number_format($invoice->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 font-medium">Received Amount</span>
                        <span class="text-green-600 font-bold">₹{{ number_format($invoice->received_amount, 2) }}</span>
                    </div>
                    <div class="pt-3 border-t border-gray-200 flex justify-between items-center">
                        <span class="text-base font-bold text-gray-900 uppercase">Balance Due</span>
                        <div class="text-right">
                            <span class="text-xl font-black text-red-600 leading-none">
                                ₹{{ number_format($invoice->balance_due, 2) }}
                            </span>
                            @if ($invoice->balance_due <= 0)
                                <p class="text-[10px] text-green-600 font-bold uppercase tracking-tighter leading-none mt-1">
                                    Paid in Full
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection