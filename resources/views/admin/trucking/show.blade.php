@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Trucking Order Details</h1>
                <p class="mt-1 text-sm text-gray-600">View and manage the details of this trucking order.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.trucking.index') }}"
                    class="btn btn-secondary bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                    Back
                </a>
                <a href="{{ route('admin.trucking.edit', $trucking->id) }}"
                    class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md ml-2">
                    Edit
                </a>
                <form action="{{ route('admin.trucking.destroy', $trucking->id) }}" method="POST" class="inline ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Details Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Order Information</h3>
            </div>
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">Tracking Number</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->tracking_number }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">Name</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">Email</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->email }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">Phone</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->phone }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">From</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->from_location }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">To</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->to_location }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">Load Description</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->load_description }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">Status</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
