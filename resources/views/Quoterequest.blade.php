<!DOCTYPE html>
<html class="no-js" lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Essential Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <title>Get Shipping Quote | Motor Speed Courier Kenya - Instant Delivery Rates</title>
    <meta name="description"
        content="Get instant delivery quotes for shipping across Kenya's 47 counties. Fast, reliable rate calculator for businesses, e-commerce, and individual shipping needs.">
    <meta name="keywords"
        content="shipping quote kenya, delivery rates, courier pricing, logistics quote, shipping calculator kenya, motor speed courier rates, delivery cost calculator, business shipping rates">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Get Instant Shipping Quotes | Motor Speed Courier Kenya">
    <meta property="og:description"
        content="Calculate your delivery costs instantly. Transparent pricing for shipping across Kenya, perfect for businesses and individual needs.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://motorspeedcourier.com/quote-request">
    <meta property="og:site_name" content="Motor Speed Courier">

    <!-- Additional SEO Tags -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="Motor Speed Courier">
    <link rel="canonical" href="http://motorspeedcourier.com/quote-request">

   <!-- Favicon -->
    <link rel="icon" href="/assets/img/favicon log.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
                                        <!-- Success/Error Messages -->
                                        <div id="responseMessage"></div>

                                        <form id="quoteForm">
                                            @csrf

                                            <!-- Full Name -->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="full_name"
                                                    id="full_name" placeholder="Full Name" required>
                                                <div class="text-danger error-full_name"></div>
                                            </div>

                                            <!-- Phone -->
                                            <div class="mb-3">
                                                <input type="tel" class="form-control" name="phone" id="phone"
                                                    placeholder="phone number" required>
                                                <div class="text-danger error-phone"></div>
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-3">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email Address" required>
                                                <div class="text-danger error-email"></div>
                                            </div>

                                            <!-- Services Dropdown -->
                                            <div class="mb-3">
                                                <select class="form-control text-dark bg-light" name="services"
                                                    id="services" required>
                                                    <option value="" disabled selected>Select a Service</option>
                                                    <option value="courier_and_delivery">Courier and Delivery Services
                                                    </option>
                                                    <option value="ecommerce_packaging">E-commerce Packaging</option>
                                                    <option value="warehousing_storage">Warehousing & Storage</option>
                                                    <option value="medical_courier">Medical Courier</option>
                                                    <option value="bulk_corporate_logistics">Bulk & Corporate Logistics
                                                    </option>
                                                    <option value="reverse_logistics">Reverse Logistics</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <div class="text-danger error-services"></div>
                                            </div>

                                            <!-- Additional Message (Optional) -->
                                            <div class="mb-3">
                                                <textarea class="form-control" name="message" id="message" rows="4"
                                                    placeholder="Additional Message (Optional)"></textarea>
                                                <div class="text-danger error-message"></div>
                                            </div>

                                            <!-- Submit Button with Loading Spinner -->
                                            <button type="submit" id="submitButton"
                                                class="cs-primary-btn white-primary-btn bg-danger text-white border border-danger">
                                                <span id="submitText">Submit</span>
                                                <span id="loadingSpinner"
                                                    class="spinner-border spinner-border-sm text-white d-none"></span>
                                            </button>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- jQuery for AJAX -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#quoteForm').submit(function(event) {
                                    event.preventDefault(); // Prevent page refresh

                                    // Show loading spinner
                                    $('#submitText').addClass('d-none');
                                    $('#loadingSpinner').removeClass('d-none');
                                    $('#submitButton').prop('disabled', true);

                                    $.ajax({
                                        url: "{{ route('quote.request') }}",
                                        method: "POST",
                                        data: $(this).serialize(),
                                        success: function(response) {
                                            if (response.success) {
                                                $('#quoteForm')[0].reset();
                                                $('#responseMessage').html('<div class="alert alert-success">' +
                                                    response.message + '</div>');
                                            }
                                            $('#submitText').removeClass('d-none');
                                            $('#loadingSpinner').addClass('d-none');
                                            $('#submitButton').prop('disabled', false);
                                        },
                                        error: function(xhr) {
                                            let errors = xhr.responseJSON.errors;
                                            $('.text-danger').html('');
                                            $.each(errors, function(key, value) {
                                                $('.error-' + key).html(value[0]);
                                            });
                                            $('#submitText').removeClass('d-none');
                                            $('#loadingSpinner').addClass('d-none');
                                            $('#submitButton').prop('disabled', false);
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                    <div class="cs-height-50"></div>
                </div>
            </div>
    </section>


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
