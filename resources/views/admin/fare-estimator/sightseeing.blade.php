@extends('layouts.admin-main')
@section('title', 'Sightseeing Management')
@section('content')
    <main class="p-6 space-y-8 bg-gray-50 min-h-screen">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Sightseeing Packages</h1>
                <p class="text-sm text-gray-500">Manage local tour attractions and vehicle-wise pricing.</p>
            </div>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
            <div class="xl:col-span-5 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Package Builder
                    </h2>

                    <form action="{{ route('sightseeing.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase">Internal Key
                                    (JSON)</label>
                                <input type="text" name="town_key" value="{{ old('town_key') }}" required
                                    placeholder="e.g. darjeeling"
                                    class="w-full p-2 border @error('town_key') border-red-500 @else border-gray-300 @enderror rounded text-sm font-mono">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase">Display Name</label>
                                <input type="text" name="package_name" value="{{ old('package_name') }}" required
                                    placeholder="Darjeeling Local"
                                    class="w-full p-2 border border-gray-300 rounded text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase">Short Description</label>
                            <textarea name="description" rows="2" class="w-full p-2 border border-gray-300 rounded text-sm">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-3 gap-3 p-3 bg-indigo-50 rounded-lg border border-indigo-100">
                            <div>
                                <label class="block text-[10px] font-bold text-indigo-600 uppercase">Sedan</label>
                                <input type="number" name="fares[sedan]" value="{{ old('fares.sedan') }}" required
                                    class="w-full p-2 border border-indigo-200 rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-indigo-600 uppercase">SUV</label>
                                <input type="number" name="fares[suv]" value="{{ old('fares.suv') }}" required
                                    class="w-full p-2 border border-indigo-200 rounded text-sm">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-indigo-600 uppercase">Large SUV</label>
                                <input type="number" name="fares[large_suv]" value="{{ old('fares.large_suv') }}" required
                                    class="w-full p-2 border border-indigo-200 rounded text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Sightseeing Spots (One
                                per line)</label>
                            <textarea name="spots_raw" rows="6" class="w-full p-2 border border-gray-300 rounded text-sm font-sans"
                                placeholder="Tiger Hill&#10;Batasia Loop">{{ old('spots_raw') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase">Total Duration</label>
                                <input type="text" name="duration" value="{{ old('duration') }}"
                                    placeholder="Full Day (8 hours)"
                                    class="w-full p-2 border border-gray-300 rounded text-sm">
                            </div>
                            <div class="flex items-end">
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-2 rounded font-bold hover:bg-indigo-700 transition text-sm">Save
                                    Package</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="xl:col-span-7 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($packages as $package)
                        <div
                            class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                            <div class="p-4 bg-indigo-600 text-white flex justify-between">
                                <div>
                                    <h3 class="font-bold">{{ $package->package_name }}</h3>
                                    <p class="text-xs opacity-90">{{ $package->duration }}</p>
                                </div>
                                <span
                                    class="text-[10px] bg-indigo-500 px-2 py-1 rounded h-fit font-mono">{{ $package->town_key }}</span>
                            </div>
                            <div class="p-4 space-y-3">
                                <div
                                    class="grid grid-cols-3 gap-1 text-[10px] text-center uppercase font-bold text-gray-400">
                                    <div class="bg-gray-50 p-1 rounded">Sedan: ₹{{ $package->fares['sedan'] }}</div>
                                    <div class="bg-gray-50 p-1 rounded">SUV: ₹{{ $package->fares['suv'] }}</div>
                                    <div class="bg-gray-50 p-1 rounded">L-SUV: ₹{{ $package->fares['large_suv'] }}</div>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Attractions
                                        ({{ count($package->spots) }}):</p>
                                    <ul class="text-xs text-gray-600 space-y-1">
                                        @foreach (array_slice($package->spots, 0, 3) as $spot)
                                            <li class="flex items-center gap-2">
                                                <div class="w-1 h-1 bg-indigo-400 rounded-full"></div> {{ $spot }}
                                            </li>
                                        @endforeach
                                        @if (count($package->spots) > 3)
                                            <li class="text-indigo-500 italic">+ {{ count($package->spots) - 3 }} more...
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="flex gap-2 pt-2">
                                    <form action="{{ route('sightseeing.destroy', $package->id) }}" method="POST"
                                        class="w-full flex gap-2">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            class="flex-1 text-xs font-bold py-2 border border-gray-200 rounded hover:bg-gray-50">Edit</button>
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded"
                                            onclick="return confirm('Delete package?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
