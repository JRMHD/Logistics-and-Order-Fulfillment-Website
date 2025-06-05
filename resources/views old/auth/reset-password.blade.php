<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Reset Password') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-2 border-[#004041]">
            <div class="bg-[#004041] p-6 text-center">
                <h1 class="text-3xl font-bold text-white">Reset Password</h1>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="p-8 space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-[#004041] font-semibold" />
                    <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus
                        autocomplete="username"
                        class="mt-1 w-full border-2 border-[#004041] rounded-lg focus:ring-red-500 focus:border-red-500 transition duration-300" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- New Password -->
                <div>
                    <x-input-label for="password" :value="__('New Password')" class="text-[#004041] font-semibold" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="Enter new password"
                        class="mt-1 w-full border-2 border-[#004041] rounded-lg focus:ring-red-500 focus:border-red-500 transition duration-300" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#004041] font-semibold" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Confirm new password"
                        class="mt-1 w-full border-2 border-[#004041] rounded-lg focus:ring-red-500 focus:border-red-500 transition duration-300" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <x-primary-button
                        class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
