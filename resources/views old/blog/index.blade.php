<!DOCTYPE html>
<html class="no-js" lang="en">



<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Essential Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <title>Latest Logistics & E-commerce Blogs | Supply Chain Insights & Courier Trends</title>
    <meta name="description"
        content="Explore the latest trends in logistics, supply chain management, e-commerce delivery, and last-mile solutions. Get expert insights on warehousing, freight, and technology in logistics.">
    <meta name="keywords"
        content="logistics blog, supply chain insights, e-commerce delivery tips, freight and shipping news, warehousing strategies, last-mile delivery trends, courier industry updates, technology in logistics, reverse logistics, order fulfillment solutions">

    <!-- Geo Location Tags -->
    <meta name="geo.region" content="KE">
    <meta name="geo.placename" content="Nairobi">
    <meta name="geo.position" content="-1.2921;36.8219">
    <meta name="ICBM" content="-1.2921, 36.8219">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Latest Logistics & E-commerce Blogs | Supply Chain Insights & Courier Trends">
    <meta property="og:description"
        content="Stay updated with the newest logistics, supply chain, and courier industry trends. Get expert insights on warehousing, shipping, and last-mile delivery.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://motorspeedcourier.com/blog">
    <meta property="og:site_name" content="Motor Speed Courier Blog">
    <meta property="og:image" content="https://motorspeedcourier.com/assets/img/blog-hero.jpg">
    <meta property="og:locale" content="en_KE">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon-log.png') }}" type="image/png">

    <!-- Additional SEO Tags -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large">
    <meta name="author" content="Motor Speed Courier Blog Team">
    <link rel="canonical" href="https://motorspeedcourier.com/blog">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">

    <!-- Schema.org Markup for Blog -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Blog",
      "name": "Motor Speed Courier Blog",
      "publisher": {
        "@type": "Organization",
        "name": "Motor Speed Courier",
        "url": "https://motorspeedcourier.com"
      },
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://motorspeedcourier.com/blog"
      },
      "blogPost": [
        {
          "@type": "BlogPosting",
          "headline": "The Future of Last-Mile Delivery in Kenya",
          "url": "https://motorspeedcourier.com/blog/last-mile-delivery-trends",
          "datePublished": "2024-03-24",
          "dateModified": "2024-03-24",
          "author": {
            "@type": "Person",
            "name": "John Doe"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Motor Speed Courier"
          },
          "description": "Explore how last-mile delivery is evolving in Kenya, with trends shaping e-commerce logistics.",
          "image": "https://motorspeedcourier.com/assets/img/last-mile-delivery.jpg"
        }
      ]
    }
    </script>

    <!-- Favicon -->
    <link rel="icon" href="/assets/img/favicon-blog.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>


<body>

    {{-- <!-- Start Preloader -->
    <div id="logi-preloader">
        <div id="cs-logi-preloader" class="cs-logi-preloader">
            <div class="reveal-img-wrap">
                <div class="preloader-img-inner">
                    <img src="assets/img/logi-preloader-logo.png" alt="LogiHub">
                </div>
            </div>
        </div>
    </div> --}}
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

    <section class="container mt-5">
        <h2 class="text-center mb-5" style="font-weight: 700; font-size: 2.8rem; color: #333;">Our Blogs</h2>

        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('blog.index') }}" class="mb-5">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control form-control-lg shadow-sm"
                        placeholder="Search by title or content" value="{{ request('search') }}"
                        style="border-radius: 12px; border: 1px solid #e2e8f0; padding: 15px 24px; font-size: 1.1rem;">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-control form-control-lg shadow-sm"
                        style="border-radius: 12px; border: 1px solid #e2e8f0; padding: 15px 24px; height: auto; font-size: 1.1rem;">
                        <option value="">Filter by Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}"
                                {{ request('category') == $category ? 'selected' : '' }}>
                                {{ ucfirst($category) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 shadow"
                        style="border-radius: 12px; padding: 15px; font-weight: 600; font-size: 1.1rem; height: 100%;">
                        Apply
                    </button>
                </div>
            </div>
        </form>

        <!-- Blog Cards -->
        <div class="row g-5">
            @forelse ($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-5">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none">
                        <div class="card h-100 shadow hover-effect"
                            style="border-radius: 16px; border: none; transition: transform 0.3s, box-shadow 0.3s; overflow: hidden;">
                            <div class="card-img-wrapper" style="height: 300px; overflow: hidden;">
                                @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;"
                                        alt="{{ $blog->title }}">
                                @else
                                    <div
                                        style="width: 100%; height: 100%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center;">
                                        <span style="color: #adb5bd; font-size: 1.5rem;">No image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body" style="padding: 2rem;">
                                <span class="badge mb-3"
                                    style="background-color: #e9f7fe; color: #3498db; font-weight: 500; padding: 8px 16px; border-radius: 8px; font-size: 0.95rem;">
                                    {{ $blog->category }}
                                </span>
                                <h5 class="card-title"
                                    style="font-weight: 700; font-size: 1.6rem; margin-bottom: 1.2rem; color: #333; line-height: 1.3;">
                                    {{ $blog->title }}
                                </h5>
                                <div class="d-flex align-items-center mb-3">
                                    <div
                                        style="width: 50px; height: 50px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                        <span
                                            style="font-size: 1.2rem; color: #6c757d;">{{ substr($blog->author, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="mb-0" style="font-weight: 600; color: #333; font-size: 1.1rem;">
                                            {{ $blog->author }}</p>
                                        <p class="mb-0" style="font-size: 0.95rem; color: #6c757d;">
                                            {{ $blog->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5" style="background-color: #f8f9fa; border-radius: 16px;">
                        <p style="font-size: 1.4rem; color: #6c757d;">No blogs found.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div
            style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; margin: 2rem 0; display: flex; flex-direction: column; align-items: center;">
            <!-- Page status info -->
            <div style="margin-bottom: 0.75rem; font-size: 0.875rem; color: #64748b; text-align: center;">
                Showing page {{ $blogs->currentPage() }} of {{ $blogs->lastPage() }} ({{ $blogs->total() }} total
                items)
            </div>

            <!-- Pagination controls -->
            <div style="display: flex; align-items: center; gap: 0.25rem; flex-wrap: wrap; justify-content: center;">
                <!-- Previous page button -->
                @if ($blogs->onFirstPage())
                    <span
                        style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #f1f5f9; color: #94a3b8; cursor: not-allowed; font-size: 0.875rem; font-weight: 500;">
                        Previous
                    </span>
                @else
                    <a href="{{ $blogs->previousPageUrl() }}"
                        style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #f1f5f9; color: #334155; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s ease; border: 1px solid transparent; display: inline-flex; align-items: center;">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.25rem;"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Previous
                    </a>
                @endif

                <!-- Page numbers -->
                @php
                    $start = max($blogs->currentPage() - 2, 1);
                    $end = min($start + 4, $blogs->lastPage());
                    if ($end - $start < 4 && $start > 1) {
                        $start = max(1, $end - 4);
                    }
                @endphp

                @if ($start > 1)
                    <a href="{{ $blogs->url(1) }}"
                        style="padding: 0.5rem 0.75rem; min-width: 2rem; text-align: center; border-radius: 0.375rem; background-color: #f1f5f9; color: #334155; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s ease; border: 1px solid transparent;">
                        1
                    </a>
                    @if ($start > 2)
                        <span style="padding: 0.5rem 0.5rem; color: #64748b; font-size: 0.875rem;">...</span>
                    @endif
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $blogs->currentPage())
                        <span
                            style="padding: 0.5rem 0.75rem; min-width: 2rem; text-align: center; border-radius: 0.375rem; background-color: #3b82f6; color: white; font-size: 0.875rem; font-weight: 600; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $blogs->url($i) }}"
                            style="padding: 0.5rem 0.75rem; min-width: 2rem; text-align: center; border-radius: 0.375rem; background-color: #f1f5f9; color: #334155; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s ease; border: 1px solid transparent; hover: { background-color: #e2e8f0; }">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                @if ($end < $blogs->lastPage())
                    @if ($end < $blogs->lastPage() - 1)
                        <span style="padding: 0.5rem 0.5rem; color: #64748b; font-size: 0.875rem;">...</span>
                    @endif
                    <a href="{{ $blogs->url($blogs->lastPage()) }}"
                        style="padding: 0.5rem 0.75rem; min-width: 2rem; text-align: center; border-radius: 0.375rem; background-color: #f1f5f9; color: #334155; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s ease; border: 1px solid transparent;">
                        {{ $blogs->lastPage() }}
                    </a>
                @endif

                <!-- Next page button -->
                @if ($blogs->hasMorePages())
                    <a href="{{ $blogs->nextPageUrl() }}"
                        style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #f1f5f9; color: #334155; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s ease; border: 1px solid transparent; display: inline-flex; align-items: center;">
                        Next
                        <svg style="width: 1rem; height: 1rem; margin-left: 0.25rem;"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span
                        style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #f1f5f9; color: #94a3b8; cursor: not-allowed; font-size: 0.875rem; font-weight: 500;">
                        Next
                    </span>
                @endif
            </div>

            <!-- Jump to page form -->
            <div style="margin-top: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <form method="GET" style="display: flex; align-items: center; gap: 0.5rem;">
                    <span style="font-size: 0.875rem; color: #64748b;">Go to page:</span>
                    <input type="number" name="page" min="1" max="{{ $blogs->lastPage() }}"
                        value="{{ $blogs->currentPage() }}"
                        style="width: 3rem; padding: 0.375rem 0.5rem; border: 1px solid #cbd5e1; border-radius: 0.25rem; font-size: 0.875rem; outline: none; transition: border-color 0.15s; text-align: center;">
                    <button type="submit"
                        style="padding: 0.375rem 0.75rem; border-radius: 0.25rem; background-color: #3b82f6; color: white; font-size: 0.875rem; font-weight: 500; border: none; cursor: pointer; transition: background-color 0.2s ease;">Go</button>
                </form>
            </div>
        </div>
    </section>

    <style>
        .hover-effect:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .hover-effect:hover img {
            transform: scale(1.05);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .card-img-wrapper {
                height: 250px;
            }
        }

        @media (max-width: 767.98px) {
            .card-img-wrapper {
                height: 220px;
            }
        }

        /* Pagination styling */
        .pagination {
            gap: 8px;
        }

        .page-item .page-link {
            border-radius: 10px;
            padding: 12px 20px;
            color: #333;
            border: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            font-size: 1.05rem;
        }

        .page-item.active .page-link {
            background-color: #3498db;
            border-color: #3498db;
        }
    </style>



    <!-- End CTA -->

    <!-- Start Footer -->
    @include('footer')
    <!-- End Footer -->
    @include('whatsapp')
    <span class="cs_scrollup">
        <i class="flaticon-top"></i>
    </span>

    <!-- Script -->
    <script src="assets/js/plugins/jquery-3.7.0.min.js"></script>
    <script src="assets/js/plugins/swiper.min.js"></script>
    <script src="assets/js/plugins/SplitText.min.js"></script>
    <script src="assets/js/plugins/ScrollToPlugin.min.js"></script>
    <script src="assets/js/plugins/ScrollTrigger.min.js"></script>
    <script src="assets/js/plugins/gsap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>


</html>
