@extends('layouts/admin-main')
@section('title', 'Profile Edit')
@section('content')

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
            <p class="text-sm text-gray-500">Manage your account settings and security preferences.</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800">Profile Information</h4>
                        <p class="text-sm text-gray-500">Update your account's profile information and email address.</p>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email"
                                value="{{ session('errors') ? old('email') : Auth::user()->email }}" required
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-md active:scale-95">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-800">Update Password</h4>
                        <p class="text-sm text-gray-500">Ensure your account is using a long, random password to stay
                            secure.</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Current Password</label>
                            <input type="password" name="current_password"
                                class="w-full px-4 py-2.5 rounded-xl border @if ($errors->updatePassword->has('current_password')) border-red-500 @else border-gray-300 @endif focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                            @if ($errors->updatePassword->has('current_password'))
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $errors->updatePassword->first('current_password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">New Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2.5 rounded-xl border @if ($errors->updatePassword->has('password')) border-red-500 @else border-gray-300 @endif focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                            @if ($errors->updatePassword->has('password'))
                                <p class="mt-1 text-xs text-red-500">{{ $errors->updatePassword->first('password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-md active:scale-95">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
