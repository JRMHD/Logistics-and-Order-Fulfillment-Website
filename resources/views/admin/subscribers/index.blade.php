@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Subscribed Users</h1>
                <p class="mt-1 text-sm text-gray-600">Manage and export the list of subscribed users.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.subscribers.export') }}"
                    class="btn btn-success bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                    Export to CSV
                </a>
            </div>
        </div>

        <!-- Subscribers Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subscribed At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($subscribers as $subscriber)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $subscriber->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $subscriber->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $subscriber->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <nav
                style="display: inline-block; border-radius: 5px; overflow: hidden; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <ul
                    style="list-style: none; display: flex; padding: 0; margin: 0; background: #f8f9fa; border-radius: 5px;">

                    {{-- Previous Page Link --}}
                    @if ($subscribers->onFirstPage())
                        <li style="padding: 10px 15px; color: #ccc; cursor: not-allowed;">«</li>
                    @else
                        <li style="padding: 10px 15px;">
                            <a href="{{ $subscribers->previousPageUrl() }}"
                                style="text-decoration: none; color: #007bff; font-weight: bold; transition: 0.3s;">
                                «
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($subscribers->links()->elements[0] as $page => $url)
                        @if ($page == $subscribers->currentPage())
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
                    @if ($subscribers->hasMorePages())
                        <li style="padding: 10px 15px;">
                            <a href="{{ $subscribers->nextPageUrl() }}"
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
    @endsection
