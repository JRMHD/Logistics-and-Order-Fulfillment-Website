<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Confirm Password') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-2 border-[#004041]">
            <div class="bg-[#004041] p-6 text-center">
                <h1 class="text-3xl font-bold text-white">Confirm Password</h1>
            </div>

            <div class="p-8 space-y-6">
                <div class="text-[#004041] text-center">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-[#004041] font-semibold" />
                        <x-text-input id="password" type="password" name="password" required
                            autocomplete="current-password" placeholder="Enter your password"
                            class="mt-1 w-full border-2 border-[#004041] rounded-lg focus:ring-red-500 focus:border-red-500 transition duration-300" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button
                            class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                            {{ __('Confirm') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
