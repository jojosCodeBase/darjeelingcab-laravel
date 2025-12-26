@extends('layouts.admin-main')
@section('title', 'Transport & Location Management')
@section('content')
    <main class="p-6 space-y-8 bg-gray-50 min-h-screen">

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Transport Master Data</h1>
                <p class="text-sm text-gray-500">Manage locations, routes, and fare estimates.</p>
            </div>
        </div>
        
        @include('include.alerts')

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500 uppercase">Total Estimates</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">1,284</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500 uppercase">Top Route</p>
                <p class="text-xl font-bold text-gray-900 mt-1">NJP-DARJ</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500 uppercase">Avg. Fare</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">₹3,200</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500 uppercase">Locations</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ count($locations) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
            <div class="xl:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Location Aliases</h2>
                    <form action="{{ route('locations.store') }}" method="POST"
                        class="space-y-3 mb-6 bg-gray-50 p-3 rounded-lg border border-dashed border-gray-300">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase">Short Key (Internal)</label>
                            <input type="text" name="key" required placeholder="e.g. njp"
                                class="w-full p-2 border border-gray-300 rounded text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase">Display Name</label>
                            <input type="text" name="display_name" required placeholder="e.g. NJP Railway Station"
                                class="w-full p-2 border border-gray-300 rounded text-sm outline-none">
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-md text-sm font-semibold hover:bg-blue-700 transition">Add
                            Location</button>
                    </form>

                    <div class="max-h-[300px] overflow-y-auto space-y-2">
                        @foreach ($locations as $loc)
                            <div
                                class="flex justify-between items-center p-3 bg-white border border-gray-100 rounded-lg shadow-sm">
                                <div>
                                    <span
                                        class="text-[10px] font-bold bg-gray-100 text-gray-600 px-1 rounded uppercase">{{ $loc->key }}</span>
                                    <p class="text-sm font-medium text-gray-800">{{ $loc->display_name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="xl:col-span-8 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">Update Fare Estimator Data
                    </h2>
                    <form action="{{ route('routes.store') }}" method="POST"
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Source</label>
                            <select name="source_id" id="source_select"
                                class="w-full p-2 border @error('source_id') border-red-500 @else border-gray-300 @enderror rounded text-sm bg-white">
                                <option value="">Select Source</option>
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}" data-key="{{ $loc->key }}"
                                        {{ old('source_id') == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('source_id')
                                <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Destination</label>
                            <select name="destination_id" id="dest_select"
                                class="w-full p-2 border @error('destination_id') border-red-500 @else border-gray-300 @enderror rounded text-sm bg-white">
                                <option value="">Select Destination</option>
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}" data-key="{{ $loc->key }}"
                                        {{ old('destination_id') == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('destination_id')
                                <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Generated Route Key</label>
                            <input type="text" name="route_key" id="route_key" readonly value="{{ old('route_key') }}"
                                class="w-full p-2 border border-gray-200 bg-gray-50 rounded text-sm text-blue-500 font-mono">
                            @error('route_key')
                                <p class="text-[10px] text-red-500 mt-1 italic">Route already exists or key is missing.</p>
                            @enderror
                        </div>

                        <div
                            class="p-4 bg-gray-50 rounded-lg space-y-3 lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-100">
                            <div>
                                <label class="block text-xs font-bold text-blue-600 uppercase mb-1 italic">Sedan
                                    Price</label>
                                <input type="number" name="sedan_fare" value="{{ old('sedan_fare') }}" required
                                    placeholder="₹2500" class="w-full p-2 border border-gray-300 rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-blue-600 uppercase mb-1 italic">SUV Price</label>
                                <input type="number" name="suv_fare" value="{{ old('suv_fare') }}" required
                                    placeholder="₹3500" class="w-full p-2 border border-gray-300 rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-blue-600 uppercase mb-1 italic">Lrg SUV
                                    Price</label>
                                <input type="number" name="large_suv_fare" value="{{ old('large_suv_fare') }}" required
                                    placeholder="₹4500" class="w-full p-2 border border-gray-300 rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Distance (km)</label>
                                <input type="number" name="distance" step="0.1" value="{{ old('distance') }}" required
                                    placeholder="72" class="w-full p-2 border border-gray-300 rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Est. Travel Time</label>
                                <input type="text" name="duration" value="{{ old('duration') }}" required
                                    placeholder="3 hours" class="w-full p-2 border border-gray-300 rounded text-sm">
                            </div>
                            <div class="flex items-end">
                                <button type="submit"
                                    class="w-full bg-gray-900 text-white py-2 rounded font-bold hover:bg-black transition text-sm">
                                    Save Route Fare
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold tracking-widest">
                            <tr>
                                <th class="px-6 py-3">Route Name</th>
                                <th class="px-6 py-3">Route Key</th>
                                <th class="px-6 py-3">Sedan</th>
                                <th class="px-6 py-3">SUV</th>
                                <th class="px-6 py-3">Large SUV</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach ($routes as $route)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <span class="font-medium text-gray-900">{{ $route->source->display_name }} →
                                            {{ $route->destination->display_name }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs text-blue-500">{{ $route->route_key }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-700">₹{{ number_format($route->sedan_fare) }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-700">₹{{ number_format($route->suv_fare) }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-700">₹{{ number_format($route->large_suv_fare) }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('routes.destroy', $route->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this route?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-red-400 hover:text-red-600 italic">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Logic to automatically generate the route key (e.g., njp-darjeeling)
        const sourceSelect = document.getElementById('source_select');
        const destSelect = document.getElementById('dest_select');
        const routeKeyInput = document.getElementById('route_key');

        function updateKey() {
            const source = sourceSelect.options[sourceSelect.selectedIndex].getAttribute('data-key');
            const dest = destSelect.options[destSelect.selectedIndex].getAttribute('data-key');
            routeKeyInput.value = `${source}-${dest}`;
        }

        sourceSelect.addEventListener('change', updateKey);
        destSelect.addEventListener('change', updateKey);
        updateKey(); // Initial run
    </script>
@endsection
