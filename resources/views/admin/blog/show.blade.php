@extends('layouts.admin')

@section('title', 'View Blog Post')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Blog Post Details</h1>
                <p class="mt-1 text-sm text-gray-600">View and manage this blog post.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.blogs.index') }}"
                    class="btn btn-secondary bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                    Back
                </a>
                <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                    class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md ml-2">
                    Edit
                </a>
                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline ml-2"
                    onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Blog Content Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $blog->title }}</h3>
            </div>

            <!-- Blog Image -->
            @if ($blog->image)
                <div class="w-full">
                    <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-auto object-cover max-h-96"
                        alt="{{ $blog->title }}">
                </div>
            @endif

            <!-- Blog Content -->
            <div class="p-6 space-y-6">
                <div class="prose max-w-none">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                <!-- Blog Meta Information -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Author</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $blog->author }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Category</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $blog->category }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Published</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $blog->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Details Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">SEO Information</h3>
            </div>
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">Keywords</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $blog->keywords }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">SEO Tags</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $blog->seo_tags }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
