@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Trucking Order</h1>
                <p class="mt-1 text-sm text-gray-600">Update the status of this trucking order.</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden p-6">
            <form action="{{ route('admin.trucking.update', $trucking->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Status Field -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Pending" {{ $trucking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Transit" {{ $trucking->status == 'In Transit' ? 'selected' : '' }}>In Transit
                        </option>
                        <option value="Delivered" {{ $trucking->status == 'Delivered' ? 'selected' : '' }}>Delivered
                        </option>
                        <option value="Cancelled" {{ $trucking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="btn btn-success bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
