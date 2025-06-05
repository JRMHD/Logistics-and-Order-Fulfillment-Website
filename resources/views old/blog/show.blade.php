<!DOCTYPE html>
<html class="no-js" lang="en">



<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Essential Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Dynamic SEO Meta Tags -->
    <title>{{ $blog->title }} | Motor Speed Courier Blog</title>
    <meta name="description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
    <meta name="keywords" content="{{ $blog->keywords }}">

    <!-- Geo Location Tags -->
    <meta name="geo.region" content="KE">
    <meta name="geo.placename" content="Nairobi">
    <meta name="geo.position" content="-1.2921;36.8219">
    <meta name="ICBM" content="-1.2921, 36.8219">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Motor Speed Courier Blog">
    <meta property="og:image"
        content="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/img/blog-hero.jpg') }}">
    <meta property="og:locale" content="en_KE">
    <meta property="article:author" content="{{ $blog->author }}">
    <meta property="article:published_time" content="{{ $blog->created_at }}">
    <meta property="article:tag" content="{{ $blog->seo_tags }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
    <meta name="twitter:image"
        content="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/img/blog-hero.jpg') }}">

    <!-- Additional SEO Tags -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large">
    <meta name="author" content="{{ $blog->author }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">

    <!-- Base URL to Fix Asset Paths -->
    <base href="{{ url('/') }}/">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon-log.png') }}" type="image/png">

    <!-- Favicon -->
    <link rel="icon" href="/assets/img/favicon log.png">

    {{-- SEO Optimization --}}
    <meta name="keywords" content="{{ $blog->keywords }}">
    <meta name="description" content="{{ Str::limit(strip_tags($blog->content), 150) }}">
    <meta name="author" content="{{ $blog->author }}">
    <!-- Stylesheets (Ensuring They Load Correctly) -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap.min.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <script src="https://cdn.tiny.cloud/1/qjdgdss7zdjs5zce0uo4jwbz307a78l0lmmi15r1yyur61so/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'link lists image table code help wordcount',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | removeformat',
            height: 400
        });
    </script>
    <!-- JavaScript Fixes (Optional) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</head>



<body>


    <!-- End Preloader -->

    <!-- Start Header Section -->
    @include('header')
    <!-- End Sidebar -->

    <!-- Start Common BreadCrumb -->
    <section>
        <div class="cs-braidcrumb-wrap img-scroll-object-zoom" data-src="assets/img/logi-breadcrumb-main1.jpg">
            <div class="container">
                <div class="row cs_center">
                    <div class="cs-bread-page-title-area">
                        <div class="cs-page-title-in">

                            <div class="cs-page-title">
                                <h2 class="cs_white_color">Our Blog</h2>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb">
                        <ul class="cs_mp0">
                            <li>
                                <a href="/" class="cs-text_b_line"><span>Home</span></a>
                            </li>

                            <li>Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Common BreadCrumb -->

    <div class="cs-section-height"></div>
    <!-- Section to Section Gap -->

    <section class="container mt-5 mb-5">
        <div class="row">
            <!-- Left Column: Main Blog Content -->
            <div class="col-lg-8">
                <div class="card shadow border-0" style="border-radius: 16px; overflow: hidden;">
                    @if ($blog->image)
                        <div style="height: 400px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $blog->image) }}"
                                style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $blog->title }}">
                        </div>
                    @endif
                    <div class="card-body" style="padding: 2.5rem;">
                        <div class="mb-4">
                            <span class="badge"
                                style="background-color: #e9f7fe; color: #3498db; font-weight: 500; padding: 8px 16px; border-radius: 8px; font-size: 0.95rem;">
                                {{ $blog->category }}
                            </span>
                        </div>

                        <h1
                            style="font-weight: 800; font-size: 2.5rem; margin-bottom: 1.5rem; color: #333; line-height: 1.3;">
                            {{ $blog->title }}
                        </h1>

                        <div class="d-flex align-items-center mb-4">
                            <div
                                style="width: 55px; height: 55px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <span
                                    style="font-size: 1.3rem; color: #6c757d;">{{ substr($blog->author, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="mb-0" style="font-weight: 600; color: #333; font-size: 1.2rem;">
                                    {{ $blog->author }}</p>
                                <p class="mb-0" style="font-size: 0.95rem; color: #6c757d;">
                                    Published {{ $blog->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <div class="blog-content"
                            style="font-size: 1.1rem; line-height: 1.8; color: #444; margin-bottom: 2rem;">
                            {!! $blog->content !!}
                        </div>
                        <div class="social-sharing mt-4 mb-2">
                            <p class="mb-2" style="font-size: 1rem; color: #555; font-weight: 600;">Share this
                                article:</p>
                            <div class="d-flex gap-3 align-items-center">
                                <!-- Facebook Share Button -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank" class="share-btn facebook-btn" aria-label="Share on Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#3b5998" stroke="#3b5998" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                        </path>
                                    </svg>
                                </a>

                                <!-- Twitter/X Share Button -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                    target="_blank" class="share-btn twitter-btn" aria-label="Share on X">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#1da1f2">
                                        <path
                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"
                                            stroke="#1da1f2" stroke-width="1" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>

                                <!-- LinkedIn Share Button -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}"
                                    target="_blank" class="share-btn linkedin-btn" aria-label="Share on LinkedIn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#0077b5" stroke="#0077b5" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                        </path>
                                        <rect x="2" y="9" width="4" height="12"></rect>
                                        <circle cx="4" cy="4" r="2"></circle>
                                    </svg>
                                </a>

                                <!-- Instagram Button -->
                                <a href="https://www.instagram.com/" target="_blank" class="share-btn instagram-btn"
                                    aria-label="Share on Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="2" y="2" width="20" height="20" rx="5"
                                            ry="5" fill="url(#instagram-gradient)"
                                            stroke="url(#instagram-gradient)"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" fill="white"
                                            stroke="white"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"
                                            stroke="white" stroke-width="2"></line>
                                        <defs>
                                            <linearGradient id="instagram-gradient" x1="2" y1="2"
                                                x2="22" y2="22" gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#405DE6" />
                                                <stop offset="20%" stop-color="#5851DB" />
                                                <stop offset="40%" stop-color="#833AB4" />
                                                <stop offset="60%" stop-color="#C13584" />
                                                <stop offset="80%" stop-color="#E1306C" />
                                                <stop offset="100%" stop-color="#FD1D1D" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </a>

                                <!-- Copy Link Button -->
                                <button onclick="copyArticleLink()" class="share-btn link-btn"
                                    aria-label="Copy link to article">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="#27ae60" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                    </svg>
                                    <span class="ms-1 d-none d-sm-inline"
                                        style="font-size: 0.85rem; color: #27ae60;">Copy Link</span>
                                </button>

                                <!-- Success message for copy link (hidden by default) -->
                                <span id="copy-success" class="copy-success-message"
                                    style="display: none; font-size: 0.85rem; color: #0d9c27; font-weight: 500;">
                                    Link copied!
                                </span>
                            </div>
                        </div>
                        {{-- Hidden SEO Tags for Search Engines --}}
                        <span class="d-none">{{ $blog->keywords }}</span>
                        <span class="d-none">{{ $blog->seo_tags }}</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar with Recent Blogs and Comments -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 30px; z-index: 10;">
                    <!-- Recent Blogs Section -->
                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px; overflow: hidden;">
                        <div class="card-body" style="padding: 1.8rem;">
                            <h2 style="font-weight: 700; font-size: 1.6rem; margin-bottom: 1.5rem; color: #333;">Recent
                                Blogs</h2>

                            @foreach ($recentBlogs as $recent)
                                <a href="{{ route('blog.show', $recent->slug) }}" class="text-decoration-none">
                                    <div class="d-flex mb-4 hover-effect-subtle" style="transition: transform 0.2s;">
                                        @if ($recent->image)
                                            <div
                                                style="width: 80px; height: 80px; border-radius: 10px; overflow: hidden; flex-shrink: 0;">
                                                <img src="{{ asset('storage/' . $recent->image) }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;"
                                                    alt="{{ $recent->title }}">
                                            </div>
                                        @else
                                            <div
                                                style="width: 80px; height: 80px; border-radius: 10px; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <span style="color: #adb5bd; font-size: 0.8rem;">No image</span>
                                            </div>
                                        @endif
                                        <div class="ms-3">
                                            <h6
                                                style="font-weight: 600; font-size: 1rem; margin-bottom: 0.4rem; color: #333; line-height: 1.3;">
                                                {{ Str::limit($recent->title, 50) }}
                                            </h6>
                                            <p style="font-size: 0.85rem; color: #6c757d; margin-bottom: 0;">
                                                {{ $recent->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Comments Section - Only visible on desktop -->
                    <div class="card shadow-sm border-0 d-none d-lg-block"
                        style="border-radius: 16px; overflow: hidden;">
                        <div class="card-body" style="padding: 1.5rem;">
                            <h2 style="font-weight: 700; font-size: 1.4rem; margin-bottom: 1rem; color: #333;">Comments
                            </h2>
                            <div id="comment-section-sidebar" class="compact-comments"
                                style="max-height: 350px; overflow-y: auto;">
                                <!-- Comments will be loaded here -->
                            </div>
                            <div class="text-center mt-3">
                                <button id="show-comment-form" class="btn btn-sm btn-outline-primary"
                                    style="border-radius: 8px; padding: 6px 16px; font-size: 0.9rem;">
                                    Add Comment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section - For mobile devices only -->
        <div class="mt-5 d-lg-none">
            <h2 style="font-weight: 700; font-size: 1.8rem; margin-bottom: 1.5rem; color: #333;">Comments</h2>
            <div id="comment-section-mobile" class="mb-4" style="min-height: 100px;">
                <!-- Comments will be loaded here -->
            </div>
        </div>

        <!-- Comment Form - Hidden initially on desktop, always visible on mobile -->
        <div id="comment-form-container" class="mt-4 d-lg-none">
            <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
                <div class="card-body" style="padding: 1.8rem;">
                    <h3 style="font-weight: 600; font-size: 1.5rem; margin-bottom: 1.5rem; color: #333;">Leave a
                        Comment</h3>
                    <form id="comment-form">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <input type="hidden" name="parent_id" id="parent_id">

                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="name" class="form-control"
                                    style="border-radius: 12px; border: 1px solid #e2e8f0; padding: 15px 20px; font-size: 1rem;"
                                    placeholder="First Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" class="form-control"
                                    style="border-radius: 12px; border: 1px solid #e2e8f0; padding: 15px 20px; font-size: 1rem;"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <textarea name="comment" class="form-control"
                                style="border-radius: 12px; border: 1px solid #e2e8f0; padding: 15px 20px; font-size: 1rem; min-height: 120px;"
                                placeholder="Write a comment..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"
                            style="border-radius: 12px; padding: 12px 30px; font-weight: 600; font-size: 1rem;">
                            <span id="submit-text">Post Comment</span>
                            <span id="loading" class="spinner-border spinner-border-sm d-none ms-2"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Related Blogs Section --}}
        @if ($relatedBlogs->count() > 0)
            <div class="mt-5">
                <h2 style="font-weight: 700; font-size: 2rem; margin-bottom: 1.5rem; color: #333;">Related Topics</h2>
                <div class="row g-4">
                    @foreach ($relatedBlogs as $related)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none">
                                <div class="card h-100 shadow-sm hover-effect"
                                    style="border-radius: 16px; border: none; transition: transform 0.3s, box-shadow 0.3s; overflow: hidden;">
                                    <div class="card-img-wrapper" style="height: 230px; overflow: hidden;">
                                        @if ($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}"
                                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;"
                                                alt="{{ $related->title }}">
                                        @else
                                            <div
                                                style="width: 100%; height: 100%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center;">
                                                <span style="color: #adb5bd; font-size: 1.2rem;">No image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body" style="padding: 1.5rem;">
                                        <h5 class="card-title"
                                            style="font-weight: 700; font-size: 1.3rem; margin-bottom: 0.8rem; color: #333; line-height: 1.3;">
                                            {{ $related->title }}
                                        </h5>
                                        <p class="card-text"
                                            style="font-size: 0.95rem; color: #6c757d; margin-bottom: 1rem;">
                                            Published {{ $related->created_at->diffForHumans() }}
                                        </p>
                                        <div class="text-primary" style="font-weight: 600; font-size: 0.95rem;">Read
                                            More</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                loadComments();

                document.getElementById("comment-form").addEventListener("submit", function(event) {
                    event.preventDefault();
                    submitComment();
                });

                // Show comment form on desktop when button is clicked
                if (document.getElementById("show-comment-form")) {
                    document.getElementById("show-comment-form").addEventListener("click", function() {
                        document.getElementById("comment-form-container").classList.remove("d-lg-none");
                        document.getElementById("comment-form-container").scrollIntoView({
                            behavior: 'smooth'
                        });
                    });
                }
            });

            function loadComments() {
                let blogId = "{{ $blog->id }}";
                fetch(`/comments/${blogId}`)
                    .then(response => response.json())
                    .then(comments => {
                        console.log("Loaded Comments:", comments);

                        // Load compact comments for sidebar
                        let compactHTML = renderCompactComments(comments);
                        const sidebarCommentSection = document.getElementById("comment-section-sidebar");
                        if (sidebarCommentSection) {
                            sidebarCommentSection.innerHTML = compactHTML ||
                                '<div class="text-center p-3" style="color: #6c757d; background-color: #f8f9fa; border-radius: 8px; font-size: 0.9rem;">No comments yet.</div>';
                        }

                        // Load full comments for mobile view
                        let mobileHTML = renderComments(comments);
                        const mobileCommentSection = document.getElementById("comment-section-mobile");
                        if (mobileCommentSection) {
                            mobileCommentSection.innerHTML = mobileHTML ||
                                '<div class="text-center p-4" style="color: #6c757d; background-color: #f8f9fa; border-radius: 12px;">No comments yet. Be the first to comment!</div>';
                        }
                    })
                    .catch(error => console.error("Error loading comments:", error));
            }

            function renderCompactComments(comments, isReply = false) {
                if (!Array.isArray(comments) || comments.length === 0) return "";

                let html = `<div class="${isReply ? 'nested-comments-compact' : ''}">`;
                comments.forEach(comment => {
                    html += `
                <div class="comment-item-compact mb-3 ${isReply ? '' : ''}" 
                     style="${isReply ? '' : ''}">
                    <div class="d-flex align-items-center mb-1">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; margin-right: 8px;">
                            <span style="font-size: 0.8rem; color: #6c757d;">${comment.name.charAt(0)}</span>
                        </div>
                        <div>
                            <p class="mb-0" style="font-weight: 600; color: #333; font-size: 0.85rem;">${comment.name}</p>
                            <p class="mb-0" style="font-size: 0.75rem; color: #6c757d;">${timeAgo(comment.created_at)}</p>
                        </div>
                    </div>
                    <div class="mb-2" style="padding-left: 36px; font-size: 0.85rem; color: #444;">
                        ${comment.comment.length > 80 ? comment.comment.substring(0, 80) + '...' : comment.comment}
                    </div>
                    <div style="padding-left: 36px;" class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-sm btn-outline-primary reply-btn" 
                            style="border-radius: 6px; padding: 2px 8px; font-size: 0.75rem;"
                            onclick="replyTo(${comment.id})">Reply</button>
                            
                        ${comment.replies && comment.replies.length ? 
                            `<span style="font-size: 0.75rem; color: #6c757d;">
                                                                                                                ${comment.replies.length} ${comment.replies.length === 1 ? 'reply' : 'replies'}
                                                                                                            </span>` : ''}
                    </div>
                    <hr style="margin: 0.75rem 0; opacity: 0.1;">
                    ${comment.replies && comment.replies.length && isReply === false ? renderCompactComments(comment.replies.slice(0, 1), true) : ""}
                </div>`;
                });
                html += `</div>`;
                return html;
            }

            function renderComments(comments, isReply = false) {
                if (!Array.isArray(comments) || comments.length === 0) return "";

                let html = `<div class="${isReply ? 'nested-comments' : ''}">`;
                comments.forEach(comment => {
                    html += `
                <div class="comment-item mb-4 ${isReply ? '' : 'card shadow-sm border-0'}" 
                     style="${isReply ? '' : 'border-radius: 12px; overflow: hidden;'}">
                    <div class="${isReply ? 'py-3' : 'card-body'}" style="${isReply ? '' : 'padding: 1.5rem;'}">
                        <div class="d-flex align-items-center mb-2">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                <span style="font-size: 1rem; color: #6c757d;">${comment.name.charAt(0)}</span>
                            </div>
                            <div>
                                <p class="mb-0" style="font-weight: 600; color: #333; font-size: 1rem;">${comment.name}</p>
                                <p class="mb-0" style="font-size: 0.85rem; color: #6c757d;">${timeAgo(comment.created_at)}</p>
                            </div>
                        </div>
                        <div class="mb-3" style="padding-left: 52px; font-size: 1rem; color: #444;">
                            ${comment.comment}
                        </div>
                        <div style="padding-left: 52px;">
                            <button class="btn btn-sm btn-outline-primary reply-btn" 
                                style="border-radius: 8px; padding: 4px 12px; font-size: 0.85rem;"
                                onclick="replyTo(${comment.id})">Reply</button>
                        </div>
                        <div id="replies-${comment.id}" class="mt-3">
                            ${comment.replies && comment.replies.length ? renderComments(comment.replies, true) : ""}
                        </div>
                    </div>
                </div>`;
                });
                html += `</div>`;
                return html;
            }

            function timeAgo(time) {
                let date = new Date(time);
                let seconds = Math.floor((new Date() - date) / 1000);
                let interval = Math.floor(seconds / 60);
                if (interval < 1) return "Just now";
                if (interval < 60) return interval + " mins ago";
                interval = Math.floor(interval / 60);
                if (interval < 24) return interval + " hours ago";
                return date.toLocaleDateString();
            }

            function replyTo(commentId) {
                document.getElementById("parent_id").value = commentId;
                document.querySelector("[name='comment']").focus();

                // Make sure comment form is visible
                document.getElementById("comment-form-container").classList.remove("d-lg-none");

                // Scroll to comment form
                document.querySelector("#comment-form").scrollIntoView({
                    behavior: 'smooth'
                });
            }

            function submitComment() {
                let form = document.getElementById("comment-form");
                let formData = new FormData(form);
                let submitText = document.getElementById("submit-text");
                let loading = document.getElementById("loading");

                submitText.classList.add("d-none");
                loading.classList.remove("d-none");

                fetch("{{ route('comments.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector("input[name='_token']").value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Comment submitted:", data);

                        form.reset();
                        document.getElementById("parent_id").value = "";

                        // Reload comments to ensure replies are properly displayed
                        setTimeout(loadComments, 500);
                    })
                    .catch(error => console.error("Error submitting comment:", error))
                    .finally(() => {
                        submitText.classList.remove("d-none");
                        loading.classList.add("d-none");
                    });
            }
        </script>

        <style>
            .nested-comments {
                margin-left: 52px;
                border-left: 3px solid #e9ecef;
                padding-left: 20px;
            }

            .nested-comments-compact {
                margin-left: 28px;
                border-left: 2px solid #e9ecef;
                padding-left: 12px;
            }

            .hover-effect:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
            }

            .hover-effect:hover img {
                transform: scale(1.05);
            }

            .hover-effect-subtle:hover {
                transform: translateY(-3px);
            }

            /* Scrollbar styling for compact comments */
            .compact-comments::-webkit-scrollbar {
                width: 6px;
            }

            .compact-comments::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .compact-comments::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 10px;
            }

            .compact-comments::-webkit-scrollbar-thumb:hover {
                background: #888;
            }

            /* Responsive adjustments */
            @media (max-width: 991.98px) {
                .sticky-top {
                    position: relative;
                    top: 0 !important;
                    margin-top: 2rem;
                }
            }

            @media (max-width: 767.98px) {
                .nested-comments {
                    margin-left: 25px;
                    padding-left: 15px;
                }

                .card-img-wrapper {
                    height: 200px;
                }
            }

            /* Social sharing styles */
            .social-sharing {
                border-top: 1px solid #eee;
                padding-top: 1rem;
            }

            .share-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 8px 12px;
                border-radius: 8px;
                background-color: #f8f9fa;
                transition: all 0.2s ease;
                border: none;
                cursor: pointer;
                text-decoration: none;
            }

            .share-btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Platform-specific styles */
            .facebook-btn {
                background-color: #f0f2f8;
            }

            .facebook-btn:hover {
                background-color: #e6eaf5;
            }

            .twitter-btn {
                background-color: #eef8ff;
            }

            .twitter-btn:hover {
                background-color: #e0f1ff;
            }

            .linkedin-btn {
                background-color: #e8f4f9;
            }

            .linkedin-btn:hover {
                background-color: #d8ecf5;
            }

            .instagram-btn {
                background-color: #fef1f7;
            }

            .instagram-btn:hover {
                background-color: #fde8f2;
            }

            .link-btn {
                background-color: #e9f7ef;
                display: flex;
                align-items: center;
            }

            .link-btn:hover {
                background-color: #d5f2e3;
            }

            .copy-success-message {
                animation: fadeInOut 2s ease;
            }

            @keyframes fadeInOut {
                0% {
                    opacity: 0;
                }

                20% {
                    opacity: 1;
                }

                80% {
                    opacity: 1;
                }

                100% {
                    opacity: 0;
                }
            }

            /* Responsive adjustments */
            @media (max-width: 575.98px) {
                .social-sharing .d-flex {
                    flex-wrap: wrap;
                }

                .share-btn {
                    margin-bottom: 0.5rem;
                }
            }
        </style>

        <script>
            function copyArticleLink() {
                // Get the current URL
                const url = window.location.href;

                // Create a temporary input element
                const tempInput = document.createElement('input');
                tempInput.value = url;
                document.body.appendChild(tempInput);

                // Select and copy the URL
                tempInput.select();
                document.execCommand('copy');

                // Remove the temporary element
                document.body.removeChild(tempInput);

                // Show success message
                const successMsg = document.getElementById('copy-success');
                successMsg.style.display = 'inline';

                // Hide success message after 2 seconds
                setTimeout(() => {
                    successMsg.style.display = 'none';
                }, 2000);
            }
        </script>
    </section>






    <!-- End CTA -->

    <!-- Start Footer -->
    @include('footer')
    <!-- End Footer -->
    @include('whatsapp')
    <span class="cs_scrollup">
        <i class="flaticon-top"></i>
    </span>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/plugins/jquery-3.7.0.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/plugins/SplitText.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/plugins/ScrollToPlugin.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/plugins/ScrollTrigger.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/plugins/gsap.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>

</body>


</html>
