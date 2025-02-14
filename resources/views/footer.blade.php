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
                                Sikedi House, Old Mobasa Road, Nairobi
                            </p>
                            <div class="cs-logi-emai-phone">
                                <a href="#" class="cs-text-style-h6"> +254 711 222666</a>
                                <a href="#" class="cs-text-style-h6">info@motorspeedcourier.com
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
                                Sikedi House, Old Mobasa Road, Nairobi
                            </p>
                            <div class="cs-logi-emai-phone">
                                <a href="#" class="cs-text-style-h6">+254 706 459198</a>
                                <a href="#" class="cs-text-style-h6">info@motorspeedcourier.com</a>
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
                                    <li> <a href="{{ url('/privacypolicy') }}" class="cs-text_b_line"><span>Privacy
                                                Policy</span></a>
                                    </li>
                                    <li><a href="{{ url('/termsandconditions') }}" class="cs-text_b_line"><span>Terms
                                                and Conditions</span></a></li>
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
                            <div id="responseMessage" class="mt-2" style="margin-top: 10px;"></div>
                            <form class="cs-logi-newsletter" id="subscribeForm"
                                style="max-width: 500px; padding: 20px;">
                                @csrf
                                <input class="cs-newsletter-email" type="email" name="email"
                                    placeholder="Enter Your Email Address" required
                                    style="width: 70%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; margin-right: 10px;" />

                                <button class="cs-newsletter-btn cs_center svg-left-to-right-animation-wrap"
                                    type="submit" id="subscribeBtn"
                                    style="width: 25%; padding: 12px; background: #000; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                    Subscribe
                                    <span class="svg-left-to-right-animation">
                                        <i class="flaticon-right-arrow"></i>
                                        <i class="flaticon-right-arrow"></i>
                                    </span>
                                </button>

                                <div id="loading" class="spinner" style="display: none; margin-top: 10px;"></div>


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

                            <div style="padding: 1.5rem; text-align: center;">
                                <ul
                                    style="list-style: none; padding: 0; margin: 0; display: flex; gap: 1.5rem; justify-content: center; align-items: center;">
                                    <!-- LinkedIn -->
                                    <li>
                                        <a href="https://www.linkedin.com/company/motorspeedcourier" target="_blank"
                                            rel="noopener noreferrer"
                                            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #f8fafc; border-radius: 50%; color: #0077b5; transition: all 0.3s ease;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                            </svg>
                                        </a>
                                    </li>

                                    <!-- X (Twitter) -->
                                    <li>
                                        <a href="https://twitter.com/motorspeedcargo" target="_blank"
                                            rel="noopener noreferrer"
                                            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #f8fafc; border-radius: 50%; color: #000000; transition: all 0.3s ease;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                            </svg>
                                        </a>
                                    </li>

                                    <!-- Instagram -->
                                    <li>
                                        <a href="https://www.instagram.com/motorspeed_courier" target="_blank"
                                            rel="noopener noreferrer"
                                            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #f8fafc; border-radius: 50%; color: #e4405f; transition: all 0.3s ease;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                            </svg>
                                        </a>
                                    </li>

                                    <!-- Facebook -->
                                    <li>
                                        <a href="https://www.facebook.com/profile.php?id=61573438790178" target="_blank"
                                            rel="noopener noreferrer"
                                            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #f8fafc; border-radius: 50%; color: #1877f2; transition: all 0.3s ease;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                            </svg>
                                        </a>
                                    </li>

                                    <!-- TikTok -->
                                    <li>
                                        <a href="https://www.tiktok.com/@motorspeed_logistics" target="_blank"
                                            rel="noopener noreferrer"
                                            style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #f8fafc; border-radius: 50%; color: #000000; transition: all 0.3s ease;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0011.14-4.02v-6.95a8.16 8.16 0 004.65 1.49v-3.93a4.84 4.84 0 01-1.2 0z" />
                                            </svg>
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
                            <img src="assets/img/logo_white_text.png" alt="LogiHub"
                                style="width: 250px; height: auto;" />
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
            <svg width="1920" height="186" viewBox="0 0 1920 186" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.2"
                    d="M1919.95 15.0784C1789.84 47.7321 1593.01 73.75 1313.98 21.8595C940.467 -47.6007 736.04 72.8343 688.434 185.993M0.135498 174.227C71.8468 137.994 149.172 106.307 231.119 82.6053C550.484 -9.76492 1181.35 52.3115 1168.87 185.973"
                    stroke="white" />
            </svg>
        </div>
    </div>
</footer>
