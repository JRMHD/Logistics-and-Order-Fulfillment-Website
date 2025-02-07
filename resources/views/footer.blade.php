<footer>
    <div class="cs-logi-footer-container">
        <div class="cs-logi-footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="cs-logi-cor-office cs-footer-widget">
                            <div class="cs-footer-widget-title">
                                <h6>Corporate Office</h6>
                            </div>
                            <p class="cs-max-width-200">
                                Nairobi,Kenya
                            </p>
                            <div class="cs-logi-emai-phone">
                                <a href="#" class="cs-text-style-h6">+254 798 984929</a>
                                <a href="#" class="cs-text-style-h6">nyamsawa@gmail.com
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="cs-logi-cor-office cs-footer-widget">
                            <div class="cs-footer-widget-title">
                                <h6>East Africa</h6>
                            </div>
                            <p class="cs-max-width-200">
                                Nairobi,Kenya
                            </p>
                            <div class="cs-logi-emai-phone">
                                <a href="#" class="cs-text-style-h6">+254 706 459198</a>
                                <a href="#" class="cs-text-style-h6">nyamsawa@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-5">
                        <div class="cs-footer-widget">
                            <div class="cs-footer-widget-title">
                                <h6>Useful Link</h6>
                            </div>
                            <div class="cs-logi-footer-useful-link">
                                <ul>
                                    <li><a href="{{ url('/about') }}" class="cs-text_b_line"><span>About Us</span></a>
                                    </li>
                                    <li><a href="{{ url('/contact') }}" class="cs-text_b_line"><span>Contact
                                                Us</span></a></li>

                                    <li> <a href="{{ url('/faq') }}" class="cs-text_b_line"><span>Faq</span></a>
                                    </li>
                                    <li><a href="{{ url('/order-tracking') }}" class="cs-text_b_line"><span>Track
                                                Shipment</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7">
                        <div class="cs-footer-widget">
                            <div>
                                <div class="cs-footer-widget-title">
                                    <h6>Newsletter</h6>
                                </div>
                                <p>Delivering Excellence in Global Logistics.</p>
                            </div>
                            <form class="cs-logi-newsletter" id="subscribeForm">
                                @csrf
                                <input class="cs-newsletter-email" type="email" name="email"
                                    placeholder="Enter Your Email Address" required />

                                <button class="cs-newsletter-btn cs_center svg-left-to-right-animation-wrap"
                                    type="submit" id="subscribeBtn">
                                    Subscribe
                                    <span class="svg-left-to-right-animation">
                                        <i class="flaticon-right-arrow"></i>
                                        <i class="flaticon-right-arrow"></i>
                                    </span>
                                </button>

                                <!-- Modern Loading Spinner -->
                                <div id="loading" class="spinner" style="display: none;"></div>

                                <div id="responseMessage" class="mt-2"></div>
                            </form>

                            <style>
                                /* Modern CSS Loader */
                                .spinner {
                                    margin: 10px auto;
                                    width: 30px;
                                    height: 30px;
                                    border: 4px solid rgba(0, 0, 0, 0.1);
                                    border-left-color: #3498db;
                                    /* Loader color */
                                    border-radius: 50%;
                                    animation: spin 1s linear infinite;
                                    display: inline-block;
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
                                    $("#subscribeForm").on("submit", function(e) {
                                        e.preventDefault();

                                        $("#subscribeBtn").prop("disabled", true); // Disable button
                                        $("#loading").show(); // Show spinner
                                        $("#responseMessage").html('');

                                        $.ajax({
                                            url: "{{ route('subscribe') }}",
                                            method: "POST",
                                            data: $(this).serialize(),
                                            success: function(response) {
                                                $("#loading").hide();
                                                $("#subscribeBtn").prop("disabled", false);
                                                $("#responseMessage").html('<div class="text-success">' + response
                                                    .message + '</div>');
                                                $("#subscribeForm")[0].reset();
                                            },
                                            error: function(xhr) {
                                                $("#loading").hide();
                                                $("#subscribeBtn").prop("disabled", false);
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

                            <div class="cs-social-common">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-facebook-app-symbol"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-linkedin-big-logo"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cs-logi-copy-area">
                <div class="cs-footer-copy-branding">
                    <div class="cs-footer-copy-branding">
                        <a href="index.html">
                            <img src="assets/img/logo_white_text.png" alt="LogiHub" />
                        </a>
                        <span>Delivering Excellence in Global Logistics.</span>
                    </div>
                </div>
                <div class="cs-footer-copy-text">
                    <p>©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="/">{{ config('app.name') }}</a>. All Rights Reserved. |
                        Designed and Developed by
                        <a href="https://www.jrmhd.tech/" target="_blank" class="text-decoration-none">
                            Jrmhd Technologies
                        </a>
                    </p>
                </div>

            </div>
        </div>
        <div class="cs-logi-footer-border">
            <svg width="1920" height="186" viewBox="0 0 1920 186" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.2"
                    d="M1919.95 15.0784C1789.84 47.7321 1593.01 73.75 1313.98 21.8595C940.467 -47.6007 736.04 72.8343 688.434 185.993M0.135498 174.227C71.8468 137.994 149.172 106.307 231.119 82.6053C550.484 -9.76492 1181.35 52.3115 1168.87 185.973"
                    stroke="white" />
            </svg>
        </div>
    </div>
</footer>
