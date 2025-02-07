<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Login') }} - Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-2 border-[#004041]">
            <div class="bg-[#004041] p-6 text-center">
                <h1 class="text-3xl font-bold text-white">
                    {{ config('app.name', 'Welcome') }} Login
                </h1>
            </div>

            <form method="POST" action="{{ route('login') }}" class="p-8 space-y-6">
                @csrf

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Email Input -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-[#004041] font-semibold" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder="Enter your email"
                        class="mt-1 w-full border-2 border-[#004041] rounded-lg focus:ring-red-500 focus:border-red-500 transition duration-300" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password Input -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-[#004041] font-semibold" />
                    <x-text-input id="password" type="password" name="password" required
                        autocomplete="current-password" placeholder="Enter your password"
                        class="mt-1 w-full border-2 border-[#004041] rounded-lg focus:ring-red-500 focus:border-red-500 transition duration-300" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-[#004041] text-red-600 shadow-sm focus:ring-red-500">
                        <span class="ms-2 text-sm text-[#004041]">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-red-600 hover:text-red-800 transition duration-300">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <x-primary-button
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Registration Link -->
        <div class="text-center mt-6">
            <p class="text-[#004041]">
                Don't have an account?
                <a href="{{ route('register') }}"
                    class="text-red-600 hover:text-red-800 font-semibold transition duration-300">
                    Register here
                </a>
            </p>
        </div>
    </div>
</body>

</html>
