@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Trucking Orders</h1>
                <p class="mt-1 text-sm text-gray-600">Manage all trucking orders efficiently.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.trucking.create') }}"
                    class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Add Trucking Order
                </a>
            </div>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.trucking.index') }}" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by Name or Tracking Number"
                    class="form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <button type="submit"
                    class="ml-2 btn btn-secondary bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                    Search
                </button>
            </div>
        </form>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button"
                        onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button"
                        onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif
        <!-- Active Trucking Orders -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Active Trucking Orders</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tracking Number</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            {{-- <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th> --}}
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($truckings->where('status', '!=', 'Delivered') as $trucking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $trucking->tracking_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('admin.trucking.payment', $trucking->id) }}"
                                        class="text-blue-600 underline hover:text-blue-800">
                                        {{ $trucking->name }}
                                    </a>
                                </td>

                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->email }}</td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->from_location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->to_location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <a href="{{ route('admin.trucking.show', $trucking->id) }}"
                                        class="btn btn-info bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md">View</a>
                                    <a href="{{ route('admin.trucking.edit', $trucking->id) }}"
                                        class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md">Edit</a>
                                    <form action="{{ route('admin.trucking.destroy', $trucking->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Container --}}
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <nav
                style="display: inline-block; border-radius: 5px; overflow: hidden; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <ul
                    style="list-style: none; display: flex; padding: 0; margin: 0; background: #f8f9fa; border-radius: 5px;">

                    {{-- Previous Page Link --}}
                    @if ($truckings->onFirstPage())
                        <li style="padding: 10px 15px; color: #ccc; cursor: not-allowed;">«</li>
                    @else
                        <li style="padding: 10px 15px;">
                            <a href="{{ $truckings->previousPageUrl() }}"
                                style="text-decoration: none; color: #007bff; font-weight: bold; transition: 0.3s;">
                                «
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($truckings->links()->elements[0] as $page => $url)
                        @if ($page == $truckings->currentPage())
                            <li
                                style="padding: 10px 15px; background: #007bff; color: #fff; font-weight: bold; border-radius: 5px; margin: 0 5px;">
                                {{ $page }}
                            </li>
                        @else
                            <li style="padding: 10px 15px; margin: 0 5px;">
                                <a href="{{ $url }}"
                                    style="text-decoration: none; color: #007bff; font-weight: bold; transition: 0.3s;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($truckings->hasMorePages())
                        <li style="padding: 10px 15px;">
                            <a href="{{ $truckings->nextPageUrl() }}"
                                style="text-decoration: none; color: #007bff; font-weight: bold; transition: 0.3s;">
                                »
                            </a>
                        </li>
                    @else
                        <li style="padding: 10px 15px; color: #ccc; cursor: not-allowed;">»</li>
                    @endif

                </ul>
            </nav>
        </div>

        <!-- Completed Trucking Orders -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-6">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Completed Trucking Orders</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tracking Number</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            {{-- <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th> --}}
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Phone
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($truckings->where('status', 'Delivered') as $trucking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $trucking->tracking_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('admin.trucking.payment', $trucking->id) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">
                                        {{ $trucking->name }}
                                    </a>
                                </td>

                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->email }}</td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $trucking->from_location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->to_location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trucking->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <a href="{{ route('admin.trucking.show', $trucking->id) }}"
                                        class="btn btn-info bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md">View</a>
                                    <form action="{{ route('admin.trucking.destroy', $trucking->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination for Completed Orders -->
        {{-- <div class="mt-4 d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    @if ($truckings->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $truckings->previousPageUrl() }}"
                                rel="prev">«</a></li>
                    @endif

                    @foreach ($truckings->links()->elements[0] as $page => $url)
                        @if ($page == $truckings->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($truckings->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $truckings->nextPageUrl() }}"
                                rel="next">»</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">»</span></li>
                    @endif
                </ul>
            </nav>
        </div> --}}
    </div>
@endsection
