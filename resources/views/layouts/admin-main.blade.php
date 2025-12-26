<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Darjeeling Cab Admin</title>
    <meta name="description" content="Admin dashboard for managing Darjeeling cab business">

    <!-- Tailwind CSS -->
    <script src="{{ asset('assets/admin/css/tailwind.css.js') }}"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .transition-transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-full w-64 bg-white border-r border-gray-200 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-lg">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-taxi text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-gray-900 font-bold text-lg">Darjeeling Cab</h1>
                            <p class="text-gray-500 text-xs">Admin Panel</p>
                        </div>
                    </div>
                    <button id="closeSidebar" class="lg:hidden text-gray-500 hover:text-gray-900">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('dashboard') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-home w-5"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('customers') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('customers') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-users w-5"></i>
                            <span class="font-medium">Customers</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('bookings') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('bookings') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-calendar-check w-5"></i>
                            <span class="font-medium">Bookings</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('invoices') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('invoices') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-file-invoice-dollar w-5"></i>
                            <span class="font-medium">Invoices</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('receipts') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('receipts') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-file-invoice w-5"></i>
                            <span class="font-medium">Receipts</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('blogs') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('blogs') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-blog w-5"></i>
                            <span class="font-medium">Blogs</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('enquiries') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('enquiries') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-message w-5"></i>
                            <span class="font-medium">Enquiries</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('tour-enquiries') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('tour-enquiries') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-route w-5"></i>
                            <span class="font-medium">Tour Enquiries</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('platform-analytics') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('platform-analytics') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fa-solid fa-chart-line w-5"></i>
                            <span class="font-medium">Analytics</span>
                        </a>
                    </li>

                    <li class="nav-item-dropdown">
                        <a href="javascript:void(0)" id="fare-estimator-btn"
                            class="flex items-center justify-between px-4 py-3 rounded-lg text-gray-700 transition-colors {{ Request::is('admin/transport*', 'admin/sightseeing*') ? 'bg-gray-100' : 'hover:bg-gray-100' }}">
                            <div class="flex items-center space-x-3">
                                <i class="fa-solid fa-calculator w-5 text-gray-500"></i>
                                <span class="font-medium">Fare Estimator</span>
                            </div>
                            <i
                                class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 arrow-icon {{ Request::is('admin/transport*', 'admin/sightseeing*') ? 'rotate-180' : '' }}"></i>
                        </a>

                        <ul id="fare-estimator-menu"
                            class="mt-1 ml-9 space-y-1 {{ Request::is('admin/fare-estimator*', 'admin/sightseeing*') ? '' : 'hidden' }}">
                            <li>
                                <a href="{{ route('fare-estimator') }}"
                                    class="block py-2 text-sm {{ Route::is('fare-estimator') ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-500' }}">
                                    Transport & Location
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('fare-estimator.sightseeing') }}"
                                    class="block py-2 text-sm {{ Route::is('fare-estimator.sightseeing') ? 'text-indigo-600 font-bold' : 'text-gray-600 hover:text-indigo-500' }}">
                                    Sightseeing
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="my-6 border-t border-gray-200"></div>

                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('settings') }}"
                            class="nav-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ Route::is('settings') ? 'active' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-cog w-5"></i>
                            <span class="font-medium">Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Top Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="openSidebar" class="lg:hidden text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                        <div>
                            <h2 class="text-gray-900 text-xl sm:text-2xl font-bold">Dashboard</h2>
                            <p class="text-gray-500 text-sm">Welcome back, Admin!</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 sm:space-x-4">

                        <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-4 py-2">
                            <span class="text-gray-600 font-semibold">v2</span>
                        </div>

                        <button class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User Profile -->
                        <div class="relative inline-block text-left">
                            <div id="profileDropdownBtn"
                                class="flex items-center space-x-3 px-4 py-2 rounded-lg cursor-pointer transition-all">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center shadow-sm">
                                    <span
                                        class="text-white font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                                </div>
                                <div class="hidden sm:block">
                                    <p class="text-gray-900 font-medium text-sm leading-none">{{ Auth::user()->name }}
                                    </p>
                                    <p class="text-gray-500 text-xs mt-1">{{ Auth::user()->email }}</p>
                                </div>
                                <i id="chevronIcon"
                                    class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"></i>
                            </div>

                            <div id="profileMenu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50 transform opacity-0 transition-all duration-200 scale-95">

                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-user-circle mr-3 text-gray-400"></i> My Profile
                                </a>

                                <hr class="my-1 border-gray-100">

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <i class="fas fa-sign-out-alt mr-3 text-red-400"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
    </div>

    <script src="{{ asset('assets/admin/js/jquery-3.1.1.min.js') }}"></script>

    <script src="{{ asset('assets/admin/tinymce/tinymce.min.js') }}"></script>

    <script src="{{ asset('assets/admin/tinymce/script.js') }}"></script>

    <script>
        // Mobile menu toggle
        const sidebar = document.getElementById('sidebar');
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

        openSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            mobileMenuOverlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });

        mobileMenuOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
        });

        const profileBtn = document.getElementById('profileDropdownBtn');
        const profileMenu = document.getElementById('profileMenu');
        const chevronIcon = document.getElementById('chevronIcon');

        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent immediate closing from the window listener
            toggleMenu();
        });

        function toggleMenu() {
            const isOpen = !profileMenu.classList.contains('hidden');

            if (isOpen) {
                // Close logic
                profileMenu.classList.add('opacity-0', 'scale-95');
                chevronIcon.classList.remove('rotate-180');
                setTimeout(() => {
                    profileMenu.classList.add('hidden');
                }, 100); // Matches transition duration
            } else {
                // Open logic
                profileMenu.classList.remove('hidden');
                chevronIcon.classList.add('rotate-180');
                // Timeout ensures the browser registers the removal of 'hidden' before animating
                setTimeout(() => {
                    profileMenu.classList.remove('opacity-0', 'scale-95');
                    profileMenu.classList.add('opacity-100', 'scale-100');
                }, 10);
            }
        }

        // Close menu when clicking anywhere else on the page
        window.addEventListener('click', function(e) {
            if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                if (!profileMenu.classList.contains('hidden')) {
                    toggleMenu();
                }
            }
        });

        $(document).ready(function() {
            $('#fare-estimator-btn').on('click', function(e) {
                e.preventDefault();

                // Toggle the submenu with a slide animation
                $('#fare-estimator-menu').slideToggle(200);

                // Rotate the arrow icon
                $(this).find('.arrow-icon').toggleClass('rotate-180');
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
