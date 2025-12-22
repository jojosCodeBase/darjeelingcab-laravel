<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Darjeeling Cab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">

        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('assets/admin/img/logo.png') }}" alt="Logo" class="w-32 h-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Welcome back, Admin</h1>
            <p class="text-gray-500 text-sm mt-1">Login to your account to continue</p>
        </div>

        <form action="{{ route('login') }}" method="POST" id="loginForm" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required value="{{ old('email') }}"
                    class="w-full px-4 py-3 rounded-xl border @error('email') border-red-500 @else border-gray-300 @enderror focus:ring-1 focus:ring-teal-500 focus:border-teal-500 outline-none transition-all duration-200"
                    placeholder="Enter your email">
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border @error('password') border-red-500 @else border-gray-300 @enderror focus:ring-1 focus:ring-teal-500 focus:border-teal-500 outline-none transition-all duration-200"
                    placeholder="••••••••">
                @error('password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 shadow-md active:scale-[0.98] flex items-center justify-center disabled:bg-teal-400 disabled:cursor-not-allowed">

                <span id="btnText">Log in</span>

                <svg id="loader" class="hidden animate-spin ml-3 h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </button>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const loader = document.getElementById('loader');
            const btnText = document.getElementById('btnText');

            // Disable button and show loader
            btn.disabled = true;
            btnText.innerText = "Logging in...";
            loader.classList.remove('hidden');
        });
    </script>

</body>

</html>
