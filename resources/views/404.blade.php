<!DOCTYPE html>
<html class="no-js" lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Essential Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <title>Page Not Found | Motor Speed Courier Kenya</title>
    <meta name="description"
        content="Sorry, the page you're looking for cannot be found. Explore our logistics services across Kenya or return to our homepage for shipping and delivery solutions.">
    <meta name="keywords"
        content="404, page not found, motor speed courier kenya, logistics services, delivery solutions">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Page Not Found | Motor Speed Courier Kenya">
    <meta property="og:description"
        content="Sorry, this page isn't available. Visit our homepage to explore our nationwide delivery services across Kenya.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://motorspeedcourier.com/404">
    <meta property="og:site_name" content="Motor Speed Courier">

    <!-- Additional SEO Tags -->
    <meta name="robots" content="noindex, follow">
    <meta name="author" content="Motor Speed Courier">

    <!-- Favicon -->
    <link rel="icon" href="assets/img/favicon.svg">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Start Preloader -->
    <!-- <div id="logi-preloader">
    <div id="cs-logi-preloader" class="cs-logi-preloader">
      <div class="reveal-img-wrap">
        <div class="preloader-img-inner">
          <img src="assets/img/logi-preloader-logo.png" alt="LogiHub">
        </div>
      </div>
     </div>
  </div> -->
    <!-- End Preloader -->

    <!-- Start Header Section -->
    @include('header')

    <div class="cs-height-150"></div>
    <div class="cs-section-height"></div>
    <!-- Section to Section Gap -->
    <!-- Section to Section Gap -->

    <!-- Error Content -->
    <section>
        <div class="error-content-wrap">
            <div class="container-fluid">
                <div class="row cs_center">
                    <div class="col-lg-7">
                        <div class="error-content-wrap-in">
                            <h1 class="cs-404 anim_div_ShowRightSide" data-src="assets/img/404-text-img.png">404</h1>
                            <h4>Oops! Page Not Found</h4>
                            <p>
                                We’re sorry, but the page you requested couldn’t be found. It
                                might have been moved, deleted, or perhaps the URL was
                                mistyped. But don’t worry, we’re here to get you back on
                                track.
                            </p>

                            <div class="timer-container">
                                <div class="countdown-circle">
                                    <span id="countdown">10</span>
                                </div>
                                <p>You will be redirected in <span id="countdown-text">10</span> seconds.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="cs-error-page-img reveal-img-wrap vertical">
                            <div class="reveal-img-inner">
                                <img src="assets/img/error-side-image.jpg" alt="LogiHub" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Countdown timer
        let countdownElement = document.getElementById("countdown");
        let countdownTextElement = document.getElementById("countdown-text");
        let countdownValue = 10;

        const countdownInterval = setInterval(() => {
            countdownValue--;
            countdownElement.innerText = countdownValue;
            countdownTextElement.innerText = countdownValue;

            // When the countdown reaches 0, redirect to home
            if (countdownValue === 0) {
                clearInterval(countdownInterval);
                window.location.href = "/"; // Redirect to home
            }
        }, 1000); // 1000ms = 1 second
    </script>

    <style>
        .timer-container {
            text-align: center;
            margin-top: 20px;
        }

        .countdown-circle {
            display: inline-block;
            width: 100px;
            height: 100px;
            background-color: #00bcd4;
            border-radius: 50%;
            color: white;
            font-size: 36px;
            font-weight: bold;
            line-height: 100px;
            text-align: center;
            animation: pulse 1s infinite;
        }

        .countdown-circle span {
            display: block;
        }

        #countdown-text {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-top: 10px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

    <!-- Error Content -->

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
