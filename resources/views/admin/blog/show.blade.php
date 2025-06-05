@extends('layouts.admin')

@section('title', $blog->title . ' - Admin View')

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
<meta name="keywords" content="{{ $blog->keywords }}">
<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $blog->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
@if ($blog->image)
<meta property="og:image" content="{{ asset('storage/' . $blog->image) }}">
@endif
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $blog->title }}">
<meta property="twitter:description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
@if ($blog->image)
<meta property="twitter:image" content="{{ asset('storage/' . $blog->image) }}">
@endif
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumbs -->
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.blogs.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Blog Posts</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-500 md:ml-2 font-medium truncate max-w-xs">{{ Str::limit($blog->title, 40) }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Blog Post Details</h1>
            <p class="mt-2 text-lg text-gray-600">View and manage this blog post</p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
            <a href="{{ route('admin.blogs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to List
            </a>
            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit Post
            </a>
            <a href="{{ url('/blog/' . $blog->slug) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                </svg>
                View Live
            </a>
            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content Column -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Blog Content Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <!-- Blog Title -->
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $blog->title }}</h2>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <span>Published on {{ $blog->created_at->format('F j, Y') }}</span>
                    </div>
                </div>

                <!-- Featured Image with proper aspect ratio -->
                @if ($blog->image)
                <div class="relative w-full" style="padding-top: 56.25%;">
                    <img src="{{ asset('storage/' . $blog->image) }}" 
                         class="absolute inset-0 w-full h-full object-cover" 
                         alt="{{ $blog->title }}"
                         loading="lazy">
                </div>
                @endif

                <!-- Blog Content with proper formatting -->
                <div class="p-6 space-y-6">
                    <div class="prose prose-lg max-w-none">
                        {!! $blog->content !!}
                    </div>

                    <!-- Tags -->
                    @if($blog->tags)
                    <div class="pt-4">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $blog->tags) as $tag)
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Social Sharing -->
                    <div class="pt-6 border-t border-gray-200">
                        <h4 class="text-sm font-medium text-gray-500 mb-3">Share This Post</h4>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/blog/' . $blog->slug)) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <span class="sr-only">Share on Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url('/blog/' . $blog->slug)) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                                <span class="sr-only">Share on Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url('/blog/' . $blog->slug)) }}&title={{ urlencode($blog->title) }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                                <span class="sr-only">Share on LinkedIn</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode('Check out this blog post: ' . url('/blog/' . $blog->slug)) }}" class="text-gray-500 hover:text-gray-700">
                                <span class="sr-only">Share via Email</span>
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schema.org Markup for SEO -->
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "headline": "{{ $blog->title }}",
                "image": [
                    @if($blog->image)
                    "{{ asset('storage/' . $blog->image) }}"
                    @endif
                ],
                "datePublished": "{{ $blog->created_at->toIso8601String() }}",
                "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
                "author": {
                    "@type": "Person",
                    "name": "{{ $blog->author }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "{{ config('app.name') }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('images/logo.png') }}"
                    }
                },
                "description": "{{ Str::limit(strip_tags($blog->content), 160) }}"
            }
            </script>
        </div>

        <!-- Sidebar Column -->
        <div class="space-y-8">
            <!-- Meta Information Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Post Information</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 gap-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Author</h4>
                            <div class="mt-1 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-500">
                                        <span class="text-lg font-medium leading-none text-white">{{ substr($blog->author, 0, 1) }}</span>
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $blog->author }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Category</h4>
                            <p class="mt-1 text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $blog->category }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Status</h4>
                            <p class="mt-1 text-sm text-gray-900">
                                @if($blog->status == 'published')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                    Published
                                </span>
                                @elseif($blog->status == 'draft')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-yellow-100 text-yellow-800">
                                    Draft
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ ucfirst($blog->status) }}
                                </span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Created</h4>
                            <p class="mt-1 text-sm text-gray-900">{{ $blog->created_at->format('F j, Y \a\t g:i a') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Last Updated</h4>
                            <p class="mt-1 text-sm text-gray-900">{{ $blog->updated_at->format('F j, Y \a\t g:i a') }}</p>
                        </div>
                        @if($blog->published_at)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Published Date</h4>
                            <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($blog->published_at)->format('F j, Y \a\t g:i a') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- SEO Information Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">SEO Information</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Meta Title</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $blog->meta_title ?? $blog->title }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Meta Description</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Keywords</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $blog->keywords }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">SEO Tags</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $blog->seo_tags }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Slug</h4>
                        <p class="mt-1 text-sm text-gray-900 break-all">{{ $blog->slug }}</p>
                    </div>
                </div>
            </div>

            <!-- Analytics Card (Placeholder) -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Analytics</h3>
                </div>
                <div class="p-6">
                    <div class="text-center py-4">
                        <p class="text-gray-500 text-sm">Analytics data will appear here once the post is published.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection