@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Blog Post</h1>
            <p class="mt-2 text-gray-600">Update your blog content and optimize for search engines</p>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md flex justify-between items-center"
                role="alert">
                <span class="text-green-700">{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none';" class="text-green-500 hover:text-green-700">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md flex justify-between items-center"
                role="alert">
                <span class="text-red-700">{{ session('error') }}</span>
                <button onclick="this.parentElement.style.display='none';" class="text-red-500 hover:text-red-700">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Blog Edit Form -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-900">Blog Information</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Blog Title -->
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" id="title"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                value="{{ old('title', $blog->title) }}" required>
                        </div>

                        <!-- Blog Author -->
                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                            <input type="text" name="author" id="author"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                value="{{ old('author', $blog->author) }}" required>
                        </div>

                        <!-- Blog Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <input type="text" name="category" id="category"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                value="{{ old('category', $blog->category) }}" required>
                        </div>

                        <!-- Blog Content -->
                        <div class="col-span-2">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea name="content" id="content" rows="8"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                required>{{ old('content', $blog->content) }}</textarea>
                        </div>

                        <!-- Keywords -->
                        <div>
                            <label for="keywords" class="block text-sm font-medium text-gray-700 mb-1">SEO Keywords</label>
                            <input type="text" name="keywords" id="keywords"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                value="{{ old('keywords', $blog->keywords) }}" required>
                            <p class="mt-1 text-xs text-gray-500">Separate keywords with commas (e.g., marketing, social
                                media, strategy)</p>
                        </div>

                        <!-- SEO Tags -->
                        <div>
                            <label for="seo_tags" class="block text-sm font-medium text-gray-700 mb-1">SEO Tags</label>
                            <input type="text" name="seo_tags" id="seo_tags"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                value="{{ old('seo_tags', $blog->seo_tags) }}" required>
                            <p class="mt-1 text-xs text-gray-500">Separate tags with commas (e.g., #digitalmarketing,
                                #contentcreation)</p>
                        </div>

                        <!-- Blog Image -->
                        <div class="col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Blog Image</label>
                            <div class="mt-1 flex flex-col sm:flex-row sm:items-center gap-4">
                                <input type="file" name="image" id="image"
                                    class="px-4 py-2 border border-gray-200 rounded-lg w-full sm:w-auto">
                                @if ($blog->image)
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                            class="h-16 w-auto object-cover rounded">
                                        <span class="text-sm text-gray-500">Current image</span>
                                    </div>
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Recommended size: 1200 x 630 pixels (16:9 ratio)</p>
                        </div>
                    </div>

                    <!-- SEO Tips Box -->
                    <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <h4 class="font-medium text-blue-800 mb-2">SEO Best Practices</h4>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>• Use comma-separated keywords that are relevant to your content</li>
                            <li>• Include 5-8 targeted keywords for better search visibility</li>
                            <li>• Add hashtags in the SEO Tags field to improve social sharing</li>
                            <li>• Make sure your title contains primary keywords</li>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.blogs.index') }}"
                            class="px-6 py-2.5 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors shadow-sm">
                            Update Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
