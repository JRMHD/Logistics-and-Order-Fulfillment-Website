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
                                        <a href="/" class="cs-text_b_line"><span>Home</span></a>
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




    <!-- Start order Tracking Content -->
    <section class="tracking-section"
        style="
    padding: 3rem 1rem;
    background: linear-gradient(135deg, #f6f9fc 0%, #ffffff 100%);
    min-height: 100vh;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
">
        <div
            style="
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
    ">
            <h2
                style="
            font-size: 2rem;
            color: #1a1f36;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 600;
        ">
                Track Your Shipment</h2>

            <form id="trackingForm" method="GET" action="{{ route('order.tracking') }}"
                style="
            margin-bottom: 2rem;
        ">
                <div
                    style="
                display: flex;
                gap: 0.5rem;
                margin-bottom: 1.5rem;
            ">
                    <input type="text" name="tracking_number" id="trackingNumber"
                        style="
                    flex: 1;
                    padding: 1rem 1.25rem;
                    border: 2px solid #e5e9f2;
                    border-radius: 12px;
                    font-size: 1rem;
                    transition: all 0.2s;
                    outline: none;
                "
                        placeholder="Enter Tracking Number" required>

                    <button type="submit"
                        style="
                    padding: 1rem 2rem;
                    background: #5469d4;
                    color: white;
                    border: none;
                    border-radius: 12px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.2s;
                    white-space: nowrap;
                ">Track
                        Order</button>
                </div>
            </form>

            <!-- Loader -->
            <div id="loader"
                style="
            display: none;
            text-align: center;
            padding: 2rem;
        ">
                <div
                    style="
                border: 3px solid #f3f3f3;
                border-top: 3px solid #5469d4;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 1s linear infinite;
                margin: 0 auto 1rem;
            ">
                </div>
                <p style="color: #6b7280;">Fetching order details...</p>
            </div>

            <!-- Order Details -->
            <div id="orderDetails"
                style="
            display: none;
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
        ">
                <h3
                    style="
                font-size: 1.5rem;
                color: #1a1f36;
                margin-bottom: 1.5rem;
                font-weight: 600;
            ">
                    Order Details</h3>

                <div
                    style="
                display: grid;
                gap: 1rem;
                margin-bottom: 2rem;
            ">
                    <p style="display: flex; gap: 0.5rem; margin: 0;">
                        <strong style="color: #6b7280; min-width: 140px;">Name:</strong>
                        <span id="orderName" style="color: #1a1f36;"></span>
                    </p>
                    <p style="display: flex; gap: 0.5rem; margin: 0;">
                        <strong style="color: #6b7280; min-width: 140px;">Tracking Number:</strong>
                        <span id="orderTrackingNumber" style="color: #1a1f36;"></span>
                    </p>
                    <p style="display: flex; gap: 0.5rem; margin: 0;">
                        <strong style="color: #6b7280; min-width: 140px;">From:</strong>
                        <span id="orderFrom" style="color: #1a1f36;"></span>
                    </p>
                    <p style="display: flex; gap: 0.5rem; margin: 0;">
                        <strong style="color: #6b7280; min-width: 140px;">To:</strong>
                        <span id="orderTo" style="color: #1a1f36;"></span>
                    </p>
                    <p style="display: flex; gap: 0.5rem; margin: 0;">
                        <strong style="color: #ffffff; min-width: 140px;">Status:</strong>
                        <span id="orderStatus"
                            style="
        padding: 0.25rem 0.75rem;
        background: #ecfdf5;
        color: #ffffff;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    "></span>
                    </p>
                </div>

                <!-- Tracking Steps -->
                <div class="tracking-steps"
                    style="
                display: flex;
                justify-content: space-between;
                position: relative;
                padding-top: 1.5rem;
            ">
                    <div
                        style="
                    position: absolute;
                    top: 2.5rem;
                    left: 2rem;
                    right: 2rem;
                    height: 2px;
                    background: #e5e9f2;
                    z-index: 1;
                ">
                    </div>

                    <div class="step pending"
                        style="
                    text-align: center;
                    z-index: 2;
                    flex: 1;
                ">
                        <span class="step-icon"
                            style="
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 40px;
                        height: 40px;
                        background: #e5e9f2;
                        color: #6b7280;
                        border-radius: 50%;
                        font-weight: 600;
                        transition: all 0.3s;
                    ">1</span>
                        <span class="step-text"
                            style="
                        display: block;
                        margin-top: 0.75rem;
                        color: #6b7280;
                        font-size: 0.875rem;
                        font-weight: 500;
                    ">Pending</span>
                    </div>

                    <div class="step in-transit"
                        style="
                    text-align: center;
                    z-index: 2;
                    flex: 1;
                ">
                        <span class="step-icon"
                            style="
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 40px;
                        height: 40px;
                        background: #e5e9f2;
                        color: #6b7280;
                        border-radius: 50%;
                        font-weight: 600;
                        transition: all 0.3s;
                    ">2</span>
                        <span class="step-text"
                            style="
                        display: block;
                        margin-top: 0.75rem;
                        color: #6b7280;
                        font-size: 0.875rem;
                        font-weight: 500;
                    ">In
                            Transit</span>
                    </div>

                    <div class="step delivered"
                        style="
                    text-align: center;
                    z-index: 2;
                    flex: 1;
                ">
                        <span class="step-icon"
                            style="
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 40px;
                        height: 40px;
                        background: #e5e9f2;
                        color: #6b7280;
                        border-radius: 50%;
                        font-weight: 600;
                        transition: all 0.3s;
                    ">3</span>
                        <span class="step-text"
                            style="
                        display: block;
                        margin-top: 0.75rem;
                        color: #6b7280;
                        font-size: 0.875rem;
                        font-weight: 500;
                    ">Delivered</span>
                    </div>

                    <div class="step cancelled"
                        style="
                    text-align: center;
                    z-index: 2;
                    flex: 1;
                ">
                        <span class="step-icon"
                            style="
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 40px;
                        height: 40px;
                        background: #e5e9f2;
                        color: #6b7280;
                        border-radius: 50%;
                        font-weight: 600;
                        transition: all 0.3s;
                    ">4</span>
                        <span class="step-text"
                            style="
                        display: block;
                        margin-top: 0.75rem;
                        color: #6b7280;
                        font-size: 0.875rem;
                        font-weight: 500;
                    ">Cancelled</span>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <p id="errorMessage"
                style="
            display: none;
            color: #dc2626;
            text-align: center;
            padding: 1rem;
            background: #fef2f2;
            border-radius: 8px;
            margin-top: 1rem;
        ">
                Invalid Tracking Number. Please try again.</p>
        </div>
    </section>

    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Active and Completed States for Steps */
        .step.active .step-icon {
            background: #5469d4 !important;
            color: white !important;
        }

        .step.active .step-text {
            color: #5469d4 !important;
        }

        .step.completed .step-icon {
            background: #10b981 !important;
            color: white !important;
        }

        .step.completed .step-text {
            color: #10b981 !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .tracking-section>div {
                padding: 1.5rem;
            }

            .tracking-steps {
                flex-direction: column;
                gap: 1.5rem;
            }

            .tracking-steps::before {
                display: none;
            }

            .step {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .step-text {
                margin-top: 0 !important;
            }
        }

        @media (max-width: 480px) {
            form>div {
                flex-direction: column;
            }

            button[type="submit"] {
                width: 100%;
            }
        }
    </style>
    <!-- Add JavaScript for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#trackingForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                const trackingNumber = $('#trackingNumber').val();

                // Show loader
                $('#loader').show();
                $('#orderDetails').hide();
                $('#errorMessage').hide();

                // AJAX request
                $.ajax({
                    url: "{{ route('order.tracking') }}",
                    type: "GET",
                    data: {
                        tracking_number: trackingNumber
                    },
                    success: function(response) {
                        $('#loader').hide();

                        if (response.trucking) {
                            // Update order details
                            $('#orderName').text(response.trucking.name);
                            $('#orderTrackingNumber').text(response.trucking.tracking_number);
                            $('#orderFrom').text(response.trucking.from_location);
                            $('#orderTo').text(response.trucking.to_location);
                            $('#orderStatus').text(response.trucking.status).removeClass()
                                .addClass('badge bg-success');

                            // Update tracking steps
                            updateTrackingSteps(response.trucking.status);

                            // Show order details
                            $('#orderDetails').show();
                        } else {
                            // Show error message
                            $('#errorMessage').show();
                        }
                    },
                    error: function() {
                        $('#loader').hide();
                        $('#errorMessage').show();
                    }
                });
            });

            function updateTrackingSteps(status) {
                // Reset all steps
                $('.step').removeClass('active completed');

                // Mark steps based on status
                if (status === 'Pending') {
                    $('.step.pending').addClass('active');
                } else if (status === 'In Transit') {
                    $('.step.pending').addClass('completed');
                    $('.step.in-transit').addClass('active');
                } else if (status === 'Delivered') {
                    $('.step.pending, .step.in-transit').addClass('completed');
                    $('.step.delivered').addClass('active');
                } else if (status === 'Cancelled') {
                    $('.step.cancelled').addClass('active');
                }
            }
        });
    </script>

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
