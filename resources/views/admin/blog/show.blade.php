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
    {{-- Define common styles for reuse --}}
    @php
        $cardStyle = 'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.07);';
        $labelStyle = 'display: block; font-size: 0.875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem;';
        $valueStyle = 'font-size: 1rem; color: #1f2937; font-weight: 500;';
    @endphp

    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Page Header -->
            <div id="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-1 8h.01">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Blog Post Details</h1>
                        <p style="color: #6b7280; margin: 0;">Viewing and managing this post.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0; display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.blogs.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #e5e7eb; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d1d5db';"
                        onmouseout="this.style.background='#e5e7eb';">Back</a>
                    <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #3b82f6; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Edit</a>
                    <a href="{{ url('/blog/' . $blog->slug) }}" target="_blank"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #16a34a; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">View Live</a>
                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Are you sure? This action is permanent.')">@csrf @method('DELETE')<button
                            type="submit"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #ef4444; border: none; cursor:pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Delete</button></form>
                </div>
            </div>

            <div id="details-grid" style="display: grid; gap: 2rem;">

                <!-- Main Content Column -->
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <div style="{{ $cardStyle }}; overflow: hidden;">
                        @if ($blog->image)
                            <div
                                style="background-image: url('{{ asset('storage/' . $blog->image) }}'); background-size: cover; background-position: center; padding-top: 52.5%; width: 100%;">
                            </div>
                        @endif
                        <div style="padding: 2rem;">
                            <h2
                                style="font-size: 2.25rem; font-weight: 800; color: #111827; line-height: 1.2; margin: 0 0 1rem 0;">
                                {{ $blog->title }}</h2>
                            <p style="color: #6b7280; margin-bottom: 2rem;">Published on
                                {{ $blog->created_at->format('F j, Y') }}</p>
                            <div class="prose-content">
                                {!! $blog->content !!}
                            </div>
                        </div>

                        <!-- Tags & Sharing -->
                        <div style="padding: 0 2rem 2rem 2rem;">
                            @if ($blog->keywords)
                                <div style="padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                                    <h4 style="font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Tags</h4>
                                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                        @foreach (explode(',', $blog->keywords) as $tag)
                                            <span
                                                style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 500; background-color: #f3f4f6; color: #374151;">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div style="padding-top: 1.5rem; margin-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                                <h4 style="font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Share This Post</h4>
                                <div style="display: flex; gap: 1rem;">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/blog/' . $blog->slug)) }}"
                                        target="_blank" title="Share on Facebook"
                                        style="color: #6b7280; transition: color 0.2s;"
                                        onmouseover="this.style.color='#1877F2'"
                                        onmouseout="this.style.color='#6b7280'"><svg style="width: 1.5rem; height: 1.5rem;"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                clip-rule="evenodd" />
                                        </svg></a>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url('/blog/' . $blog->slug)) }}"
                                        target="_blank" title="Share on Twitter"
                                        style="color: #6b7280; transition: color 0.2s;"
                                        onmouseover="this.style.color='#1DA1F2'"
                                        onmouseout="this.style.color='#6b7280'"><svg style="width: 1.5rem; height: 1.5rem;"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                        </svg></a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url('/blog/' . $blog->slug)) }}&title={{ urlencode($blog->title) }}"
                                        target="_blank" title="Share on LinkedIn"
                                        style="color: #6b7280; transition: color 0.2s;"
                                        onmouseover="this.style.color='#0A66C2'"
                                        onmouseout="this.style.color='#6b7280'"><svg
                                            style="width: 1.5rem; height: 1.5rem;" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <!-- Meta Info Card -->
                    <div style="{{ $cardStyle }}; padding: 2rem;">
                        <h3
                            style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                            Post Information</h3>
                        <div style="display: grid; gap: 1.5rem;">
                            <div><label style="{{ $labelStyle }}">Author</label>
                                <div style="{{ $valueStyle }}">{{ $blog->author }}</div>
                            </div>
                            <div><label style="{{ $labelStyle }}">Category</label>
                                <div style="{{ $valueStyle }}">{{ $blog->category }}</div>
                            </div>
                            <div><label style="{{ $labelStyle }}">Status</label>
                                @php $statusStyles = ['published' => 'background: #dcfce7; color: #166534;', 'draft' => 'background: #fef3c7; color: #92400e;', 'scheduled' => 'background: #ede9fe; color: #5b21b6;']; @endphp
                                <span
                                    style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.875rem; font-weight: 600; border-radius: 9999px; {{ $statusStyles[$blog->status] ?? '' }}">{{ ucfirst($blog->status) }}</span>
                            </div>
                            <div><label style="{{ $labelStyle }}">Created</label>
                                <div style="{{ $valueStyle }}">{{ $blog->created_at->format('M d, Y, h:i A') }}</div>
                            </div>
                            <div><label style="{{ $labelStyle }}">Last Updated</label>
                                <div style="{{ $valueStyle }}">{{ $blog->updated_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Info Card -->
                    <div style="{{ $cardStyle }}; padding: 2rem;">
                        <h3
                            style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                            SEO Information</h3>
                        <div style="display: grid; gap: 1.5rem;">
                            <div><label style="{{ $labelStyle }}">Meta Title</label>
                                <div style="{{ $valueStyle }}">{{ $blog->meta_title ?? $blog->title }}</div>
                            </div>
                            <div><label style="{{ $labelStyle }}">Meta Description</label>
                                <p style="{{ $valueStyle }} line-height: 1.6;">
                                    {{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}</p>
                            </div>
                            <div><label style="{{ $labelStyle }}">Keywords</label>
                                <p style="{{ $valueStyle }}">{{ $blog->keywords }}</p>
                            </div>
                            <div><label style="{{ $labelStyle }}">Slug</label>
                                <p style="{{ $valueStyle }} word-break: break-all;">{{ $blog->slug }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <style>
        #details-grid {
            grid-template-columns: 1fr;
        }

        @media (min-width: 1024px) {
            #details-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        .prose-content * {
            margin-bottom: 1em;
            line-height: 1.7;
        }

        .prose-content h1,
        .prose-content h2,
        .prose-content h3 {
            font-weight: 700;
            line-height: 1.3;
            color: #111827;
        }

        .prose-content h2 {
            font-size: 1.5rem;
            margin-top: 2em;
        }

        .prose-content h3 {
            font-size: 1.25rem;
            margin-top: 1.75em;
        }

        .prose-content p {
            color: #374151;
        }

        .prose-content a {
            color: #ED1C24;
            text-decoration: underline;
        }

        .prose-content ul,
        .prose-content ol {
            padding-left: 1.5rem;
        }

        .prose-content li {
            margin-bottom: 0.5em;
        }

        .prose-content blockquote {
            border-left: 4px solid #e5e7eb;
            padding-left: 1rem;
            color: #6b7280;
            font-style: italic;
        }
    </style>

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
        "author": [{
            "@type": "Person",
            "name": "{{ $blog->author }}"
        }],
        "publisher": {
             "@type": "Organization",
             "name": "{{ config('app.name') }}",
             "logo": {
                 "@type": "ImageObject",
                 "url": "{{-- asset('images/logo.png') --}}"
             }
        },
        "description": "{{ Str::limit(strip_tags($blog->content), 160) }}"
    }
    </script>
@endsection
