<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Reset Password') }} - Reset Password</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-2 border-[#004041]">
            <div class="bg-[#004041] p-6 text-center">
                <h1 class="text-3xl font-bold text-white">Reset Password</h1>
            </div>

            <div class="p-8 space-y-6">
                <div class="text-[#004041] text-center">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-[#004041] font-semibold" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                            placeholder="Enter your email address"
                            class="mt-1 w-full border-2 border-[#004041] rounded-lg focus:ring-red-500 focus:border-red-500 transition duration-300" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                    </div>

                    <div class="flex flex-col space-y-4">
                        <x-primary-button
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                            {{ __('Send Reset Link') }}
                        </x-primary-button>

                        <a href="{{ route('login') }}"
                            class="text-center text-red-600 hover:text-red-800 transition duration-300">
                            {{ __('Back to Login') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
