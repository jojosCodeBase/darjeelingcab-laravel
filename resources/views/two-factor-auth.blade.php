<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Two Factor Auth | Darjeeling Cab</title>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100 transition-all duration-500">

        <div class="flex flex-col items-center mb-8">
            <img src="https://darjeelingcab.in/assets/admin/img/logo.png" alt="Logo" class="w-32 h-auto mb-3">
        </div>

        <div id="verifyStep" class="animate-in fade-in zoom-in duration-300">
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-amber-400 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-bold text-amber-800">New Device Detected</h3>
                        <div class="mt-1 text-xs text-amber-700 leading-relaxed">
                            We've detected a login attempt from a new location: <span
                                class="font-bold underline">Kolkata, WB</span>.
                            Please enter the code sent to your email.
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Two-Step Verification</h1>
                <p class="text-gray-500 text-sm mt-1">A 6-digit code has been sent to your registered email.</p>
            </div>

            <form action="{{ route('auth.2fa-verify') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="auth_code" class="block text-sm font-semibold text-gray-700 mb-2 text-center">Enter
                        6-Digit Code</label>
                    <input type="text" id="auth_code" name="auth_code" maxlength="6" pattern="[0-9]{6}" required
                        class="w-full text-center tracking-[1rem] text-2xl font-bold px-4 py-4 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="000000">
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition-colors duration-300 shadow-md active:transform active:scale-[0.98]">
                    Verify & Login
                </button>

                <button type="button" onclick="location.reload()"
                    class="w-full text-gray-400 text-xs font-semibold hover:text-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>
