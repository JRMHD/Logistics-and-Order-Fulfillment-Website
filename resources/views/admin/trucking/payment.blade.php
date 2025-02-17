@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-bold mb-4">Payment for {{ $trucking->name }}</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.trucking.payment.process', $trucking->id) }}" id="paymentForm">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Amount</label>
                <input type="number" name="amount" class="border rounded p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Phone Number</label>
                <input type="text" name="phone" class="border rounded p-2 w-full" value="{{ $trucking->phone }}"
                    required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" id="submitButton">
                <span id="buttonText">Send STK Push</span>
                <span id="loadingSpinner" class="hidden">Loading...</span>
            </button>
        </form>
    </div>

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function() {
            document.getElementById('submitButton').disabled = true;
            document.getElementById('buttonText').classList.add('hidden');
            document.getElementById('loadingSpinner').classList.remove('hidden');
        });
    </script>
@endsection
