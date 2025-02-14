<!DOCTYPE html>
<html class="no-js" lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Essential Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <title>Contact Motor Speed Courier | Logistics Support in Kenya</title>
    <meta name="description"
        content="Get in touch with Motor Speed Courier for reliable logistics solutions across Kenya. Customer support available for e-commerce, retail & business delivery services.">
    <meta name="keywords"
        content="contact motor speed courier, logistics support kenya, courier contact details, delivery service contact, logistics customer service, kenya courier support, business logistics help">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Contact Us | Motor Speed Courier Kenya">
    <meta property="og:description"
        content="Reach out to Motor Speed Courier for all your logistics needs across Kenya's 47 counties. Professional support for businesses and individuals.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://motorspeedcourier.com/contact">
    <meta property="og:site_name" content="Motor Speed Courier">

    <!-- Additional SEO Tags -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="Motor Speed Courier">
    <link rel="canonical" href="http://motorspeedcourier.com/contact">

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
                                <h2>Contact</h2>
                            </div>
                            <div class="breadcrumb">
                                <ul class="cs_mp0">
                                    <li>
                                        <a href="/" class="cs-text_b_line"><span>Home</span></a>
                                    </li>
                                    <li>.</li>
                                    <li>Contact</li>
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


    <!-- Start Contact Page Content -->
    <section>
        <div class="cs-contact-page-content">
            <div class="container-fluid">
                <div class="row cs_center">
                    <div class="col-xl-5">
                        <div class="cs-contact-in">
                            <h2>Get In Touch</h2>
                            <p class="cs-contact-text">We handle every step of the order fulfillment process, ensuring
                                your products reach customers on time and in perfect condition.</p>
                            <div class="cs-logi-office-wrap">
                                <div class="cs-logi-cor-office cs-default-office">
                                    <div class="cs-footer-widget-title">
                                        <h6>Corporate Office</h6>
                                    </div>
                                    <p class="cs-max-width-200 cs-color-body">
                                        Sikedi House, Old Mobasa Road, Nairobi
                                    </p>
                                    <div class="cs-logi-emai-phone">
                                        <a href="#" class="cs-text-style-h6">+254 798 984929</a>
                                        <a href="#" class="cs-text-style-h6">info@motorspeedcourier.com</a>
                                    </div>
                                </div>
                                <div class="cs-border-v-line"></div>
                                <div class="cs-logi-cor-office cs-default-office">
                                    <div class="cs-footer-widget-title">
                                        <h6>East Africa</h6>
                                    </div>
                                    <p class="cs-max-width-200 cs-color-body">
                                         Sikedi House, Old Mobasa Road, Nairobi
                                    </p>

                                    <div class="cs-logi-emai-phone">
                                        <a href="#" class="cs-text-style-h6">+254 706 459198</a>
                                        <a href="#" class="cs-text-style-h6">info@motorspeedcourier.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="cs-contact-page-form-wrap">
                            <div class="cs-form-cp-in">
                                <form id="contactForm">
                                    @csrf

                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Your Name" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="example@domain.com" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="tel" class="form-control" name="phone"
                                            placeholder="eg .0706378245" required>
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Subject" required>
                                    </div>

                                    <div class="mb-3">
                                        <textarea class="form-control" name="message" rows="4" placeholder="Your Message" required></textarea>
                                    </div>

                                    <button type="submit" class="cs-primary-btn" id="submitBtn">
                                        Submit <i class="flaticon-right-arrow"></i>
                                    </button>

                                    <!-- Modern Loading Spinner -->
                                    <div id="loading" class="spinner" style="display: none;"></div>

                                    <div id="responseMessage" class="mt-2"></div>
                                </form>
                            </div>

                            <style>
                                /* Modern CSS Loader */
                                .spinner {
                                    margin: 10px auto;
                                    width: 40px;
                                    height: 40px;
                                    border: 4px solid rgba(0, 0, 0, 0.1);
                                    border-left-color: #3498db;
                                    /* Loader color */
                                    border-radius: 50%;
                                    animation: spin 1s linear infinite;
                                }

                                @keyframes spin {
                                    0% {
                                        transform: rotate(0deg);
                                    }

                                    100% {
                                        transform: rotate(360deg);
                                    }
                                }
                            </style>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $("#contactForm").on("submit", function(e) {
                                        e.preventDefault();

                                        $("#submitBtn").prop("disabled", true); // Disable button
                                        $("#loading").show(); // Show spinner
                                        $("#responseMessage").html('');

                                        $.ajax({
                                            url: "{{ route('contact.store') }}",
                                            method: "POST",
                                            data: $(this).serialize(),
                                            success: function(response) {
                                                $("#loading").hide();
                                                $("#submitBtn").prop("disabled", false);
                                                $("#responseMessage").html('<div class="text-success">' + response
                                                    .message + '</div>');
                                                $("#contactForm")[0].reset();
                                            },
                                            error: function(xhr) {
                                                $("#loading").hide();
                                                $("#submitBtn").prop("disabled", false);
                                                let errors = xhr.responseJSON.errors;
                                                let errorMessage = '<div class="text-danger">';
                                                $.each(errors, function(key, value) {
                                                    errorMessage += value[0] + '<br>';
                                                });
                                                errorMessage += '</div>';
                                                $("#responseMessage").html(errorMessage);
                                            }
                                        });
                                    });
                                });
                            </script>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Page Content -->

    <div class="cs-section-height"></div>
    <!-- Section to Section Gap -->



    <!-- Start Map -->
    <div class="cs-logi-map-wrap">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510564.65107988653!2d36.5177334104462!3d-1.3031873859975642!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1172d84d49a7%3A0xf7cf0254b297924c!2sNairobi!5e0!3m2!1sen!2ske!4v1738876221663!5m2!1sen!2ske"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- End Map -->

    <!-- Start Footer -->
    @include('footer')
    <!-- End Footer -->
    @include('whatsapp')
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
