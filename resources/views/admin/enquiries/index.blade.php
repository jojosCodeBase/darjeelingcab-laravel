@extends('layouts.admin-main')
@section('title', 'Enquiries')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">

        <div id="contactSection">
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-gray-900 text-xl font-bold mb-1">General Contact Leads</h3>
                    <p class="text-gray-500 text-sm">Direct messages and support requests from the website</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">4 New</span>
                    <button class="text-gray-500 hover:text-blue-600 text-sm font-medium transition-colors">Mark all
                        as
                        read</button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Sender</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Subject & Message</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Submitted At</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-blue-50/30 transition-colors bg-blue-50/10">
                                <td class="px-6 py-4 align-top">
                                    <div class="flex items-start gap-3">
                                        <div class="w-2 h-2 mt-2 bg-blue-600 rounded-full shrink-0 animate-pulse">
                                        </div>
                                        <div>
                                            <p class="text-gray-900 font-bold">Anjali Rai</p>
                                            <p class="text-gray-500 text-xs">anjali@gmail.com</p>
                                            <p class="text-indigo-600 text-xs font-medium mt-1 tracking-wide">+91
                                                70012 34567
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-top">
                                    <div class="max-w-md">
                                        <span class="block text-sm font-bold text-gray-900 mb-1">Partnership
                                            Enquiry</span>
                                        <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">
                                            I am from a local travel agency in Kolkata and we are looking for a
                                            reliable cab
                                            partner in Darjeeling for our upcoming winter peak season...
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-top whitespace-nowrap">
                                    <div class="text-sm">
                                        <p class="text-gray-900 font-medium">Dec 19, 2025</p>
                                        <p class="text-gray-400 text-xs">10:45 PM (2 mins ago)</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right align-top">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors"
                                            title="Reply Email">
                                            <i class="fas fa-reply"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-red-600 rounded-lg transition-colors"
                                            title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 align-top">
                                    <div class="flex items-start gap-3 pl-5">
                                        <div>
                                            <p class="text-gray-700 font-medium">Vikram Singh</p>
                                            <p class="text-gray-500 text-xs">vikram@outlook.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-top">
                                    <div class="max-w-md opacity-70">
                                        <span class="block text-sm font-semibold text-gray-800 mb-1">Lost Item
                                            Found</span>
                                        <p class="text-sm text-gray-600 line-clamp-1">
                                            I think I left my umbrella in the SUV we booked yesterday. The vehicle
                                            number was WB
                                            74...
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-top">
                                    <div class="text-sm opacity-60">
                                        <p class="text-gray-900">Dec 18, 2025</p>
                                        <p class="text-xs">03:20 PM</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right align-top">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition-colors"><i
                                                class="fas fa-eye"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="lg:hidden p-4 space-y-4">
                    <div class="bg-blue-50/30 rounded-xl p-4 border border-blue-100 relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 p-2 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-tighter">
                            New</div>

                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                AR</div>
                            <div>
                                <h4 class="text-gray-900 font-bold">Anjali Rai</h4>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Dec 19 •
                                    10:45 PM</p>
                            </div>
                        </div>

                        <div class="space-y-2 mb-4">
                            <p class="text-xs font-bold text-indigo-600 flex items-center gap-2">
                                <i class="fas fa-phone-alt"></i> +91 70012 34567
                            </p>
                            <p class="text-sm font-bold text-gray-800">Subject: Partnership Enquiry</p>
                            <p class="text-sm text-gray-600 italic">"I am from a local travel agency in Kolkata and
                                we are
                                looking for a reliable cab partner..."</p>
                        </div>

                        <div class="flex gap-2 border-t border-blue-100 pt-3">
                            <button class="flex-1 bg-blue-600 text-white py-2 rounded-lg text-xs font-bold">Reply</button>
                            <button class="px-4 bg-white text-gray-400 border border-gray-200 rounded-lg"><i
                                    class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
@endsection
