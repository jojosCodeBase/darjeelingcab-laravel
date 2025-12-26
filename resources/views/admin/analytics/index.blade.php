@extends('layouts.admin-main')
@section('title', 'Platform Analytics')
@section('content')
    <main class="p-6 space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Analytics Overview</h2>
            <p class="text-gray-500 text-sm">Real-time traffic data excluding bots and duplicates.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Views</p>
                <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($totalViews) }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Unique Visitors</p>
                <p class="text-3xl font-bold text-indigo-600 mt-1">{{ number_format($uniqueVisitors) }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Today's Hits</p>
                <p class="text-3xl font-bold text-green-600 mt-1">{{ $viewsToday }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Yesterday</p>
                <p class="text-3xl font-bold text-gray-400 mt-1">{{ $viewsYesterday }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b font-bold text-gray-800">Top Visited Pages</div>
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2">URL Path</th>
                            <th class="px-4 py-2 text-right">Views</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($topPages as $page)
                            <tr>
                                <td class="px-4 py-3 text-blue-600 truncate max-w-xs">
                                    {{ Str::replace(url('/'), '', $page->url) ?: '/' }}</td>
                                <td class="px-4 py-3 text-right font-semibold">{{ $page->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <div class="font-bold text-gray-800 mb-4">Device Usage</div>
                <div class="space-y-4">
                    @foreach ($devices as $device)
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium">{{ $device->device_type }}</span>
                                <span>{{ round(($device->total / $totalViews) * 100) }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-blue-500 h-full" style="width: {{ ($device->total / $totalViews) * 100 }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-4 border-b font-bold text-gray-800">Recent Activity</div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-50 uppercase text-gray-400">
                        <tr>
                            <th class="px-4 py-3">IP Address</th>
                            <th class="px-4 py-3">URL</th>
                            <th class="px-4 py-3">Method</th>
                            <th class="px-4 py-3">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-600">
                        @foreach ($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono">{{ $log->ip_address }}</td>
                                <td class="px-4 py-3 truncate max-w-sm">{{ $log->url }}</td>
                                <td class="px-4 py-3"><span
                                        class="px-2 py-0.5 bg-gray-100 rounded">{{ $log->method }}</span></td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t">
                {{ $logs->links() }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-6">
            <div class="p-4 border-b bg-gray-50/50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800"><i class="fas fa-blog mr-2 text-blue-500"></i>Monthly Blog Performance
                </h3>
                <span class="text-xs text-gray-500 font-medium italic">Based on MonthlyVisits Table</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-gray-600 font-semibold uppercase text-[10px]">Blog Title</th>
                            <th class="px-6 py-3 text-gray-600 font-semibold uppercase text-[10px]">Period</th>
                            <th class="px-6 py-3 text-right text-gray-600 font-semibold uppercase text-[10px]">Total Visits
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($blogPerformance as $perf)
                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-gray-900 font-bold block">{{ Str::limit($perf->title, 50) }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">
                                    {{ \Carbon\Carbon::parse($perf->start_date)->format('M d') }} -
                                    {{ \Carbon\Carbon::parse($perf->end_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                        {{ number_format($perf->visits) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection




