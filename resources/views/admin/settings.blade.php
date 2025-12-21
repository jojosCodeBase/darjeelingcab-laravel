@extends('layouts.admin-main')
@section('title', 'Security Settings')

@section('content')
    @php
        // Generate the signature for the device the user is currently using to view this page
        $currentSignature = hash('sha256', request()->userAgent() . request()->ip());
    @endphp

    <main class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl mx-auto space-y-8">

            <div>
                <h2 class="text-2xl font-bold text-gray-900">Security Settings</h2>
                <p class="text-gray-500">Manage your active sessions and review recent login attempts.</p>
            </div>

            {{-- Section 1: Trusted / Active Devices --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">Currently Logged In</h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($trustedDevices as $device)
                        <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 {{ $device->browser_fingerprint === $currentSignature ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }} rounded-xl flex items-center justify-center text-xl">
                                    <i
                                        class="fas {{ $device->device_type === 'mobile' ? 'fa-mobile-alt' : 'fa-desktop' }}"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-bold text-gray-900">{{ $device->platform }} • {{ $device->browser }}
                                        </p>
                                        @if ($device->browser_fingerprint === $currentSignature)
                                            <span
                                                class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-tight">This
                                                Device</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500">IP: {{ $device->ip_address }} • {{ $device->location }}
                                    </p>
                                    <p class="text-[11px] text-gray-400 mt-1">Last active:
                                        {{ $device->last_active_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            @if ($device->browser_fingerprint === $currentSignature)
                                <button class="text-sm font-semibold text-gray-400 cursor-not-allowed">Active Now</button>
                            @else
                                {{-- <form action="{{ route('admin.devices.destroy', $device->id) }}" method="POST"> --}}
                                    {{-- @csrf --}}
                                    {{-- @method('DELETE') --}}
                                    <button type="submit"
                                        class="text-sm font-bold text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg transition-colors border border-transparent hover:border-red-100">
                                        Log Out
                                    </button>
                                {{-- </form> --}}
                            @endif
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">No active sessions found.</div>
                    @endforelse
                </div>
            </div>

            {{-- Section 2: History Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Recent Login History</h3>
                    <a href="#" class="text-xs font-bold text-indigo-600 hover:underline">Download CSV</a>
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
                            @foreach ($loginHistory as $log)
                                <tr
                                    class="hover:bg-gray-50/50 transition-colors {{ $log->status === 'Denied' ? 'bg-red-50/20' : '' }}">
                                    <td class="px-6 py-4">
                                        <span class="font-medium text-gray-900">{{ $log->event_name }}</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 font-mono {{ $log->status === 'Denied' ? 'text-red-600' : 'text-gray-600' }} text-xs">
                                        {{ $log->ip_address }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $log->location }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $log->created_at->format('d M Y, h:i A') }}</td>
                                    <td class="px-6 py-4">
                                        @if ($log->status === 'Success')
                                            <span class="flex items-center gap-1.5 text-green-600 font-bold text-xs">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Success
                                            </span>
                                        @else
                                            <span class="flex items-center gap-1.5 text-red-600 font-bold text-xs">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-ping"></span>
                                                Denied
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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