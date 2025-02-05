<!DOCTYPE html>
<html class="no-js" lang="en">



<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Thememarch" />

    <!-- Favicon Icon -->
    <link rel="icon" href="assets/img/favicon.svg" />

    <!-- Site Title -->
    <title>LogiHub - Logistic & Transportation</title>
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>

    <!-- Start Preloader -->
    <div id="logi-preloader">
        <div id="cs-logi-preloader" class="cs-logi-preloader">
            <div class="reveal-img-wrap">
                <div class="preloader-img-inner">
                    <img src="assets/img/logi-preloader-logo.png" alt="LogiHub">
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Start Header Section -->
    @include('header')

    <!-- Start Common BreadCrumb -->
    <section>
        <div class="cs-braidcrumb-wrap cs-bread-style-2">
            <div class="container">
                <div class="row cs_center">
                    <div class="cs-bread-page-title-area">
                        <div class="cs-page-title-in">
                            <div class="cs-page-title">
                                <h2>Order Track</h2>
                            </div>
                            <div class="breadcrumb">
                                <ul class="cs_mp0">
                                    <li>
                                        <a href="index.html" class="cs-text_b_line"><span>Home</span></a>
                                    </li>
                                    <li>.</li>
                                    <li>Tracking</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Common BreadCrumb -->

    <div class="cs-section-height"></div>
    <!-- Section to Section Gap -->

    <!-- Search -->
    <section class="cs-order-track-search">
        <div class="container">
            <div class="row cs_center">
                <div class="col-lg-12">
                    <div class="cs-search-widget">
                        <div class="cs-search-content">
                            <input type="text" placeholder="Enter your ID...">
                        </div>
                        <a href="contact.html" class="cs-primary-btn">
                            <span>Track Order</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search -->

    <div class="cs-section-height"></div>
    <!-- Section to Section Gap -->

    <!-- Start order Tracking Content -->
    <section>
        <div class="cs-order-track-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <figure>
                            <img src="assets/img/product-image.png" alt="LogiHub" />
                            <figcaption>
                                <h6>Office Instrument</h6>
                                <span>Land Transport</span>
                                <h4>$ 27,570</h4>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-lg-8">
                        <div class="cs-logi-order-trackign-content">

                            <div class="cs-logi-order-track">
                                <div class="cs-logi-order-track-step">
                                    <div class="cs-logi-order-track-status">
                                        <span class="cs-logi-order-track-status-dot"></span>
                                        <span class="cs-logi-order-track-status-line"></span>
                                    </div>
                                    <div class="cs-logi-order-track-text">
                                        <p class="cs-logi-order-track-text-stat">Order Confirmed</p>
                                        <span class="cs-logi-order-track-text-sub">01 Oct 2024</span>
                                    </div>
                                </div>
                                <div class="cs-logi-order-track-step">
                                    <div class="cs-logi-order-track-status">
                                        <span class="cs-logi-order-track-status-dot"></span>
                                        <span class="cs-logi-order-track-status-line"></span>
                                    </div>
                                    <div class="cs-logi-order-track-text">
                                        <p class="cs-logi-order-track-text-stat">Shipment Prepared</p>
                                        <span class="cs-logi-order-track-text-sub">01 Oct 2024</span>
                                    </div>
                                </div>
                                <div class="cs-logi-order-track-step">
                                    <div class="cs-logi-order-track-status">
                                        <span class="cs-logi-order-track-status-dot"></span>
                                        <span class="cs-logi-order-track-status-line"></span>
                                    </div>
                                    <div class="cs-logi-order-track-text">
                                        <p class="cs-logi-order-track-text-stat">Delivery In Progress</p>
                                        <span class="cs-logi-order-track-text-sub">01 Oct 2024</span>
                                    </div>
                                </div>
                                <div class="cs-logi-order-track-step">
                                    <div class="cs-logi-order-track-status">
                                        <span class="cs-logi-order-track-status-dot"></span>
                                    </div>
                                    <div class="cs-logi-order-track-text">
                                        <p class="cs-logi-order-track-text-stat">Order Deliverd</p>
                                        <span class="cs-logi-order-track-text-sub">01 Oct 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End order Tracking Content -->

    <div class="cs-section-height"></div>
    <!-- Section to Section Gap -->

    <!-- Start Footer -->
    @include('footer')
    <!-- End Footer -->

    <!-- Start Scrollup -->
    <span class="cs_scrollup">
        <i class="flaticon-top"></i>
    </span>
    <!-- End Scrollup -->

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
