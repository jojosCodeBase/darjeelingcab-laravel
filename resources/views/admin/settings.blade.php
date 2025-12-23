@extends('layouts.admin-main')
@section('title', 'Settings')

@section('content')
    @php
        $currentSignature = hash('sha256', request()->userAgent() . request()->ip());
    @endphp

    <main class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl mx-auto space-y-6">

            {{-- Header --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Settings</h2>
                <p class="text-gray-500 text-sm">Configure your cab portal and manage security.</p>
            </div>

            @include('include.alerts')

            {{-- Tab Navigation --}}
            <div class="flex items-center gap-2 border-b border-gray-200">
                <button type="button" data-target="#company-tab"
                    class="tab-btn px-4 py-2 border-b-2 font-bold text-sm transition-all border-blue-600 text-blue-600">
                    <i class="fas fa-building mr-2"></i>Company Profile
                </button>
                <button type="button" data-target="#security-tab"
                    class="tab-btn px-4 py-2 border-b-2 font-bold text-sm transition-all border-transparent text-gray-500 hover:text-gray-700">
                    <i class="fas fa-shield-alt mr-2"></i>Security
                </button>
                <button type="button" data-target="#login-sessions-tab"
                    class="tab-btn px-4 py-2 border-b-2 font-bold text-sm transition-all border-transparent text-gray-500 hover:text-gray-700">
                    <i class="fas fa-user-shield mr-2"></i>Login Sessions
                </button>
            </div>

            {{-- Tab 1: Company Details --}}
            <div id="company-tab" class="tab-content space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 text-lg">Company Details</h3>
                        <p class="text-xs text-gray-500">Publicly visible information for customers.</p>
                    </div>

                    <form action="{{ route('update-company-details') }}" method="POST" class="px-6 space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Basic Info --}}
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="text-xs font-black uppercase tracking-widest text-gray-400 mb-1 block">Company
                                        Name</label>
                                    <input type="text" name="company_name"
                                        value="{{ $company_details->company_name ?? '' }}"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                </div>
                                <div>
                                    <label
                                        class="text-xs font-black uppercase tracking-widest text-gray-400 mb-1 block">Official
                                        Email</label>
                                    <input type="email" name="company_email"
                                        value="{{ $company_details->company_email ?? '' }}"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                </div>
                                <div>
                                    <label
                                        class="text-xs font-black uppercase tracking-widest text-gray-400 mb-1 block">WhatsApp
                                        Number</label>
                                    <div class="relative">
                                        <i class="fab fa-whatsapp absolute left-4 top-3.5 text-green-500"></i>
                                        <input type="text" name="whatsapp_number"
                                            value="{{ $company_details->whatsapp_number ?? '' }}" placeholder="+91..."
                                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                    </div>
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="text-xs font-black uppercase tracking-widest text-gray-400 mb-1 block">Office
                                        Address</label>
                                    <textarea name="address" rows="5"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                        placeholder="Enter full address...">{{ $company_details->address ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        {{-- Multi-Phone Section --}}
                        <div id="phone-section">
                            <label class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3 block">Phone
                                Numbers</label>
                            <div id="phone-inputs" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach (json_decode($company_details->phones) as $phone)
                                    <div class="flex gap-2">
                                        <input type="text" name="phones[]"
                                            placeholder="Contact number {{ $loop->iteration }}" value="{{ $phone ?? '' }}"
                                            class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                    </div>
                                @endforeach
                            </div>
                            @if (count(json_decode($company_details->phones)) < 3)
                                <button type="button" id="add-phone-btn"
                                    class="mt-3 text-sm font-bold text-blue-600 hover:text-blue-700">
                                    <i class="fas fa-plus-circle mr-1"></i> Add Another Phone
                                </button>
                            @endif
                        </div>

                        <hr class="border-gray-100">

                        {{-- Social Links --}}
                        <div>
                            <label class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3 block">Social
                                Presence</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <i class="fab fa-facebook text-blue-600 text-xl"></i>
                                    <input type="text" name="facebook_url" placeholder="Facebook URL"
                                        value="{{ $company_details->facebook_url ?? '' }}"
                                        class="bg-transparent text-sm w-full outline-none">
                                </div>
                                <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <i class="fab fa-instagram text-pink-600 text-xl"></i>
                                    <input type="text" name="instagram_url" placeholder="Instagram URL"
                                        value="{{ $company_details->instagram_url ?? '' }}"
                                        class="bg-transparent text-sm w-full outline-none">
                                </div>
                                <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <i class="fab fa-x-twitter text-gray-900 text-xl"></i>
                                    <input type="text" name="twitter_url" placeholder="Twitter URL"
                                        value="{{ $company_details->twitter_url ?? '' }}"
                                        class="bg-transparent text-sm w-full outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-0 py-4 pb-5">
                            <button type="submit"
                                class="bg-gray-900 text-white px-10 py-3 rounded-xl font-bold hover:shadow-lg transition-all active:scale-95">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tab 2: Security --}}
            <div id="security-tab" class="tab-content hidden space-y-8">
                {{-- Active Devices (Same as your original code) --}}
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
                                            <p class="font-bold text-gray-900">{{ $device->platform }} •
                                                {{ $device->browser }}</p>
                                            @if ($device->browser_fingerprint === $currentSignature)
                                                <span
                                                    class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-tight">This
                                                    Device</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500">IP: {{ $device->ip_address }} •
                                            {{ $device->location }}</p>
                                        <p class="text-[11px] text-gray-400 mt-1">Last active:
                                            {{ $device->last_active_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @if ($device->browser_fingerprint !== $currentSignature)
                                    <button
                                        class="text-sm font-bold text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg transition-colors border border-transparent hover:border-red-100">
                                        Log Out
                                    </button>
                                @endif
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-500">No active sessions found.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Tab 3: Login Sessions --}}
            <div id="login-sessions-tab" class="tab-content hidden space-y-8">
                {{-- History Table (Same as your original code) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800">Recent Login History</h3>
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
                                        <td class="px-6 py-4"><span
                                                class="font-medium text-gray-900">{{ $log->event_name }}</span></td>
                                        <td class="px-6 py-4 font-mono text-xs">{{ $log->ip_address }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $log->location }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $log->created_at->format('d M Y, h:i A') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="flex items-center gap-1.5 {{ $log->status === 'Success' ? 'text-green-600' : 'text-red-600' }} font-bold text-xs">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full {{ $log->status === 'Success' ? 'bg-green-600' : 'bg-red-600 animate-ping' }}"></span>
                                                {{ $log->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    {{-- jQuery logic --}}
    <script>
        $(document).ready(function() {
            // Tab Switching Logic
            $('.tab-btn').on('click', function() {
                const target = $(this).data('target');

                // Update Button Styles
                $('.tab-btn').removeClass('border-blue-600 text-blue-600').addClass(
                    'border-transparent text-gray-500 hover:text-gray-700');
                $(this).addClass('border-blue-600 text-blue-600').removeClass(
                    'border-transparent text-gray-500');

                // Show/Hide Content
                $('.tab-content').addClass('hidden');
                $(target).removeClass('hidden');
            });

            // Dynamic Phone Numbers Logic
            $('#add-phone-btn').on('click', function() {
                const html = `
                    <div class="flex gap-2">
                        <input type="text" name="phones[]" placeholder="Contact number" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <button type="button" class="remove-phone p-2 text-red-500 hover:bg-red-50 rounded-lg">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                $('#phone-inputs').append(html);
            });

            // Remove Phone Number (Event Delegation)
            $(document).on('click', '.remove-phone', function() {
                $(this).closest('div').remove();
            });
        });
    </script>
@endsection
