@extends('layouts.admin-main')
@section('title', 'Dashboard')
@section('content')
    <!-- Dashboard Content -->
    <main class="p-4 sm:p-6 lg:p-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <!-- Stat Card 1 -->
            <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <span class="text-xs bg-white bg-opacity-20 px-2 py-1 rounded-full">+12%</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">1,234</h3>
                <p class="text-white text-opacity-90 text-sm">Total Customers</p>
            </div>

            <!-- Stat Card 2 -->
            <div class="stat-card bg-gradient-to-br from-pink-500 to-rose-700 rounded-xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-2xl"></i>
                    </div>
                    <span class="text-xs bg-white bg-opacity-20 px-2 py-1 rounded-full">+8%</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">567</h3>
                <p class="text-white text-opacity-90 text-sm">Active Bookings</p>
            </div>

            <!-- Stat Card 3 -->
            <div class="stat-card bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-invoice-dollar text-2xl"></i>
                    </div>
                    <span class="text-xs bg-white bg-opacity-20 px-2 py-1 rounded-full">+15%</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">₹2.4L</h3>
                <p class="text-white text-opacity-90 text-sm">Total Revenue</p>
            </div>

            <!-- Stat Card 4 -->
            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-blog text-2xl"></i>
                    </div>
                    <span class="text-xs bg-white bg-opacity-20 px-2 py-1 rounded-full">+5%</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">89</h3>
                <p class="text-white text-opacity-90 text-sm">Published Blogs</p>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Recent Bookings -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-900 text-lg font-semibold">Recent Bookings</h3>
                        <a href="bookings.html" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View
                            All</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-car text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-medium">Darjeeling to Gangtok</p>
                                    <p class="text-gray-500 text-sm">Customer: Rajesh Kumar</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-900 font-semibold">₹4,500</p>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Confirmed</span>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-pink-500 to-red-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-car text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-medium">Siliguri to Darjeeling</p>
                                    <p class="text-gray-500 text-sm">Customer: Priya Sharma</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-900 font-semibold">₹2,800</p>
                                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Pending</span>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-car text-white"></i>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-medium">Kalimpong Tour</p>
                                    <p class="text-gray-500 text-sm">Customer: Amit Patel</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-900 font-semibold">₹6,200</p>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Confirmed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-gray-900 text-lg font-semibold">Quick Actions</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="bookings.html"
                            class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl text-center">
                            <i class="fas fa-plus mr-2"></i>New Booking
                        </a>
                        <a href="customers.html"
                            class="block w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-4 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl text-center">
                            <i class="fas fa-user-plus mr-2"></i>Add Customer
                        </a>
                        <a href="invoices.html"
                            class="block w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-4 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl text-center">
                            <i class="fas fa-file-invoice mr-2"></i>Generate Invoice
                        </a>
                        <a href="blogs.html"
                            class="block w-full bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white px-4 py-3 rounded-lg font-medium transition-all shadow-lg hover:shadow-xl text-center">
                            <i class="fas fa-pen mr-2"></i>Write Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-gray-900 text-lg font-semibold">Revenue Overview</h3>
                </div>
                <div class="p-6">
                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500">Chart will be displayed here</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Routes -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-gray-900 text-lg font-semibold">Popular Routes</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">1</span>
                                </div>
                                <span class="text-gray-900">Darjeeling - Gangtok</span>
                            </div>
                            <span class="text-gray-500">234 trips</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">2</span>
                                </div>
                                <span class="text-gray-900">Siliguri - Darjeeling</span>
                            </div>
                            <span class="text-gray-500">189 trips</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">3</span>
                                </div>
                                <span class="text-gray-900">Kalimpong Tour</span>
                            </div>
                            <span class="text-gray-500">156 trips</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">4</span>
                                </div>
                                <span class="text-gray-900">Mirik - Darjeeling</span>
                            </div>
                            <span class="text-gray-500">142 trips</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">5</span>
                                </div>
                                <span class="text-gray-900">Pelling - Gangtok</span>
                            </div>
                            <span class="text-gray-500">128 trips</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
