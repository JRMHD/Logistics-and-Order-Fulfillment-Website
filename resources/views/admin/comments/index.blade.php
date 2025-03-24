@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">All Comments</h1>
                <p class="mt-1 text-sm text-gray-600">Manage blog comments efficiently.</p>
            </div>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.comments.index') }}" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Author or Content"
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

        <!-- Comments List -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Comments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            {{-- <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th> --}}
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Blog Title</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Author</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Comment</th>
                            {{-- <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date</th> --}}
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($comments as $comment)
                            <tr>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $comment->id }}</td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $comment->blog->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $comment->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ Str::limit($comment->comment, 50) }}</td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $comment->created_at->format('d M Y') }}</td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <a href="{{ route('admin.comments.show', $comment->id) }}"
                                        class="btn btn-info bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md">View</a>
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')"
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
                    @if ($comments->onFirstPage())
                        <li style="padding: 10px 15px; color: #ccc; cursor: not-allowed;">«</li>
                    @else
                        <li style="padding: 10px 15px;">
                            <a href="{{ $comments->previousPageUrl() }}"
                                style="text-decoration: none; color: #007bff; font-weight: bold; transition: 0.3s;">
                                «
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($comments->links()->elements[0] as $page => $url)
                        @if ($page == $comments->currentPage())
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
                    @if ($comments->hasMorePages())
                        <li style="padding: 10px 15px;">
                            <a href="{{ $comments->nextPageUrl() }}"
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

    </div>
@endsection
