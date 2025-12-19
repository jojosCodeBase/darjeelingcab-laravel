@extends('layouts.admin-main')
@section('title', 'Settings')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl mx-auto space-y-8">

            <div>
                <h2 class="text-2xl font-bold text-gray-900">Security Settings</h2>
                <p class="text-gray-500">Manage your active sessions and review recent login attempts to keep your account
                    secure.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">Currently Logged In</h3>
                </div>
                <div class="divide-y divide-gray-100">

                    <div class="p-6 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl">
                                <i class="fas fa-desktop"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-gray-900">Windows 11 • Chrome Browser</p>
                                    <span
                                        class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-tight">This
                                        Device</span>
                                </div>
                                <p class="text-sm text-gray-500">IP: 103.45.12.88 • Kolkata, India</p>
                            </div>
                        </div>
                        <button class="text-sm font-semibold text-gray-400 cursor-not-allowed">Active Now</button>
                    </div>

                    <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center text-xl">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">iPhone 15 Pro • Safari</p>
                                <p class="text-sm text-gray-500">IP: 42.106.190.21 • Siliguri, India</p>
                                <p class="text-[11px] text-gray-400 mt-1">Last active: 2 hours ago</p>
                            </div>
                        </div>
                        <button
                            class="text-sm font-bold text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg transition-colors border border-transparent hover:border-red-100">
                            Log Out
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Recent Login History</h3>
                    <button class="text-xs font-bold text-indigo-600 hover:underline">Download CSV</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] font-black tracking-widest">
                            <tr>
                                <th class="px-6 py-3">Event</th>
                                <th class="px-6 py-3">Source IP</th>
                                <th class="px-6 py-3">Location</th>
                                <th class="px-6 py-3">Date & Time</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">Admin Login</span>
                                </td>
                                <td class="px-6 py-4 font-mono text-gray-600 text-xs">103.45.12.88</td>
                                <td class="px-6 py-4 text-gray-500">Kolkata, WB</td>
                                <td class="px-6 py-4 text-gray-500">20 Dec 2025, 09:12 AM</td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-1.5 text-green-600 font-bold text-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Success
                                    </span>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50/50 transition-colors bg-red-50/20">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">Failed Attempt</span>
                                </td>
                                <td class="px-6 py-4 font-mono text-red-600 text-xs">192.168.1.1</td>
                                <td class="px-6 py-4 text-gray-500">Unknown</td>
                                <td class="px-6 py-4 text-gray-500">19 Dec 2025, 11:45 PM</td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-1.5 text-red-600 font-bold text-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-ping"></span> Denied
                                    </span>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">Password Change</span>
                                </td>
                                <td class="px-6 py-4 font-mono text-gray-600 text-xs">103.45.12.88</td>
                                <td class="px-6 py-4 text-gray-500">Kolkata, WB</td>
                                <td class="px-6 py-4 text-gray-500">15 Dec 2025, 02:30 PM</td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-400 font-bold text-xs uppercase tracking-tighter">System</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
                    <button class="text-xs font-bold text-gray-500 hover:text-gray-900 transition-colors">Load Older
                        Activity</button>
                </div>
            </div>

        </div>
    </main>
@endsection
