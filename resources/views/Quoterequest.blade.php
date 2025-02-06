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
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <!-- Start Header Section -->
    @include('header')


    <div class="cs-section-height"></div> <!-- Section to Section Gap -->

    <!-- Start Quote & Process -->
    <section class="cs-wrap-q-p">
        <div class="cs-height-65"></div>
        <div class="cs-section-height-half"></div>
        <div class="cs-quote-process-wrap">
            <div class="container-fluid">
                <div class="cs-content-wrap-quote-process img-scroll-parallax img-scroll-object-zoom"
                    data-src="assets/img/process-quote-img.jpg">
                    <div class="cs-height-65"></div>
                    <div class="row">
                        <div class="col-xl-7 quote-flex-reverse">
                            <div class="cs-left-text-container">
                                <div class="cs-stroke-text stroke-text">
                                    <h2 class="cs-text-style-h1 logi-splite cs-w-800">{{ config('app.name') }}</h2>
                                </div>
                                <h2 class="quote-title-text">Specialized Services</h2>
                            </div>

                        </div>
                        <div class="col-xl-5">
                            <div class="cs-quote-form-container">
                                <div class="quote-form-content-in">
                                    <div class="cs-quote-title">
                                        <h4>Request For a Free Quote</h4>
                                    </div>
                                    <div class="cs-quote-form">
                                        <form>
                                            <!-- Full Name -->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="full-name"
                                                    placeholder="Full Name" required>
                                            </div>

                                            <!-- Phone -->
                                            <div class="mb-3">
                                                <input type="tel" class="form-control" id="phone"
                                                    placeholder="+1-416-8241228" required>
                                            </div>

                                            <!-- Pickup Location -->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="pickup-location"
                                                    placeholder="Pickup Location (City, Country)" required>
                                            </div>

                                            <!-- Delivery Location -->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="delivery-location"
                                                    placeholder="Delivery Location (City, Country)" required>
                                            </div>

                                            <!-- Type of Goods -->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="type-of-goods"
                                                    placeholder="Type of Goods" required>
                                            </div>

                                            <!-- Date -->
                                            <div class="mb-3">
                                                <input type="date" class="form-control" id="date" required>
                                            </div>

                                            <!-- Weight and Dimensions -->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="weight-dimensions"
                                                    placeholder="Weight and Dimensions (kg, cm)" required>
                                            </div>

                                            <!-- Additional Message (Optional) -->
                                            <div class="mb-3">
                                                <textarea class="form-control" id="message" rows="4" placeholder="Additional Message (Optional)"></textarea>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit" class="cs-primary-btn white-primary-btn">Submit<i
                                                    class="flaticon-right-arrow"></i></button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-height-50"></div>
                </div>
            </div>
    </section>


    <!-- Start Footer -->
    @include('footer')
    <!-- End Footer -->

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
