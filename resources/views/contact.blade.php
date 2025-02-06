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
                                        Nairobi,Kenya
                                    </p>
                                    <div class="cs-logi-emai-phone">
                                        <a href="#" class="cs-text-style-h6">+254 798 984929</a>
                                        <a href="#" class="cs-text-style-h6">nyamsawa@gmail.com</a>
                                    </div>
                                </div>
                                <div class="cs-border-v-line"></div>
                                <div class="cs-logi-cor-office cs-default-office">
                                    <div class="cs-footer-widget-title">
                                        <h6>East Africa</h6>
                                    </div>
                                    <p class="cs-max-width-200 cs-color-body">
                                        Nairobi,Kenya
                                    </p>

                                    <div class="cs-logi-emai-phone">
                                        <a href="#" class="cs-text-style-h6">+254 706 459198</a>
                                        <a href="#" class="cs-text-style-h6">nyamsawa@gmail.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="cs-contact-page-form-wrap">
                            <div class="cs-form-cp-in">
                                <form>
                                    <!-- Name -->
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Your Name" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="example@domain.com"
                                            required>
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-3">
                                        <input type="tel" class="form-control" id="phone"
                                            placeholder="+1-416-8241228" required>
                                    </div>

                                    <!-- Subject -->
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject"
                                            required>
                                    </div>

                                    <!-- Message -->
                                    <div class="mb-3">
                                        <textarea class="form-control" id="message" rows="4" placeholder="Your Message" required></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="cs-primary-btn">Submit<i
                                            class="flaticon-right-arrow"></i></button>
                                </form>
                            </div>

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
