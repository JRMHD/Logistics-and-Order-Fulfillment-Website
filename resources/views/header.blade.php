<header class="cs_site_header cs-header-with-bg cs_style1 cs_sticky_header">
    <!-- Header Topbar Start -->
    <div class="cs_logi_topbar">
        <div class="container-fluid">
            <div class="cs-topbar-container">
                <div class="cs-topbar-left">
                    <span class="cs-small-text cs-color-black">Reliable Logistics Solutions Across Kenya | Same-Day &
                        Next-Day Delivery Available</span>
                </div>
                <div class="cs-logi-topbar-right">
                    <div class="cs-topbar-social">
                        <ul>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>M</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>O</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>T</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>O</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>R</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>S</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>P</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>E</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>E</span></a>
                            </li>
                            <li>
                                <a href="#" class="cs-text_b_line"><span>D</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Topbar -->

    <!-- Start Main Header Area -->
    <div class="cs_main_header">
        <div class="container-fluid">
            <div class="cs_main_header_in">
                <!-- Start Main Header Left Area -->
                <div class="cs_main_header_left">
                    <div class="cs-logi-header-logo">
                        <a class="cs_site_branding" href="/">
                            <img src="assets/img/logo_black_text.png" alt="Logo" />
                        </a>
                    </div>
                </div>
                <!-- End Main Header Left Area -->

                <!-- Start Main Header Middle Area -->
                <div class="cs-logi-header-middle">
                    <div class="cs_nav cs_medium" style="font-size: 15px; padding: 15px 0;">
                        <ul class="cs_nav_list" style="margin: 0; padding: 0;">
                            <li style="margin: 0 15px; padding: 10px 0;">
                                <a href="{{ url('/') }}" class="cs-text_b_line"
                                    style="font-size: 15px;"><span>Home</span></a>
                            </li>
                            <li style="margin: 0 15px; padding: 10px 0;">
                                <a href="{{ url('/about') }}" class="cs-text_b_line"
                                    style="font-size: 15px;"><span>About Us</span></a>
                            </li>
                            <li class="cs_nav_dropdown" style="margin: 0 15px; padding: 10px 0;">
                                <a href="#" class="cs-text_b_line dropdown-toggle" onclick="toggleDropdown(event)"
                                    style="font-size: 15px;">
                                    <span>Services</span>
                                    <svg class="dropdown-arrow" width="12" height="8" viewBox="0 0 10 6"
                                        fill="currentColor" style="margin-left: 5px;">
                                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </a>
                                <ul class="cs_dropdown_menu" style="padding: 10px 0; min-width: 200px;">
                                    <li style="padding: 8px 15px;">
                                        <a href="{{ url('/courieranddelivery') }}"
                                            style="font-size: 15px;"><span>Courier & Delivery Services</span></a>
                                    </li>
                                    <li style="padding: 8px 15px;">
                                        <a href="{{ url('/ecommercepackaging') }}"
                                            style="font-size: 15px;"><span>E-commerce Packaging</span></a>
                                    </li>
                                    <li style="padding: 8px 15px;">
                                        <a href="{{ url('/warehousing') }}" style="font-size: 15px;"><span>Warehousing &
                                                Storage solutions</span></a>
                                    </li>
                                    <li style="padding: 8px 15px;">
                                        <a href="{{ url('/medicalcourier') }}" style="font-size: 15px;"><span>Medical
                                                Courier</span></a>
                                    </li>
                                    <li style="padding: 8px 15px;">
                                        <a href="{{ url('/bulklogistics') }}" style="font-size: 15px;"><span>Bulk &
                                                Corporate Logistics</span></a>
                                    </li>
                                    <li style="padding: 8px 15px;">
                                        <a href="{{ url('/reverselogistics') }}" style="font-size: 15px;"><span>Reverse
                                                Logistics</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li style="margin: 0 15px; padding: 10px 0;">
                                <a href="{{ url('/order-tracking') }}" class="cs-text_b_line"
                                    style="font-size: 15px;"><span>Shipment Tracking</span></a>
                            </li>
                            <li style="margin: 0 15px; padding: 10px 0;">
                                <a href="{{ url('/pricing') }}" class="cs-text_b_line"
                                    style="font-size: 15px;"><span>Pricing</span></a>
                            </li>
                            <li style="margin: 0 15px; padding: 10px 0;">
                                <a href="{{ url('/contact') }}" class="cs-text_b_line"
                                    style="font-size: 15px;"><span>Contact</span></a>
                            </li>
                            <li style="margin: 0 15px; padding: 10px 0;">
                                <a href="{{ url('/faq') }}" class="cs-text_b_line"
                                    style="font-size: 15px;"><span>FAQ</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <style>
                    /* Add these styles if not already present */
                    .cs_nav_dropdown {
                        position: relative;
                    }

                    .cs_dropdown_menu {
                        display: none;
                        position: absolute;
                        top: 100%;
                        left: 0;
                        min-width: 200px;
                        background-color: #fff;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                        z-index: 1000;
                        padding: 8px 0;
                    }

                    .cs_nav_dropdown.active .cs_dropdown_menu,
                    .cs_nav_dropdown:hover .cs_dropdown_menu {
                        display: block;
                    }

                    .cs_dropdown_menu li {
                        padding: 0;
                    }

                    .cs_dropdown_menu li a {
                        padding: 8px 15px;
                        display: block;
                        white-space: nowrap;
                        color: inherit;
                        text-decoration: none;
                    }

                    .cs_dropdown_menu li a:hover {
                        background-color: #f5f5f5;
                    }

                    .dropdown-arrow {
                        margin-left: 4px;
                        transition: transform 0.2s;
                    }

                    .cs_nav_dropdown.active .dropdown-arrow {
                        transform: rotate(180deg);
                    }
                </style>

                <script>
                    function toggleDropdown(event) {
                        event.preventDefault();

                        // Close all other dropdowns
                        const allDropdowns = document.querySelectorAll('.cs_nav_dropdown');
                        allDropdowns.forEach(dropdown => {
                            if (dropdown !== event.currentTarget.parentElement) {
                                dropdown.classList.remove('active');
                            }
                        });

                        // Toggle current dropdown
                        const dropdown = event.currentTarget.parentElement;
                        dropdown.classList.toggle('active');

                        // Close dropdown when clicking outside
                        const closeDropdown = (e) => {
                            if (!dropdown.contains(e.target)) {
                                dropdown.classList.remove('active');
                                document.removeEventListener('click', closeDropdown);
                            }
                        };

                        if (dropdown.classList.contains('active')) {
                            // Wait for next tick to add click listener to prevent immediate closure
                            setTimeout(() => {
                                document.addEventListener('click', closeDropdown);
                            }, 0);
                        }
                    }

                    // Close dropdown when screen width changes (e.g., orientation change)
                    window.addEventListener('resize', () => {
                        const dropdowns = document.querySelectorAll('.cs_nav_dropdown');
                        dropdowns.forEach(dropdown => dropdown.classList.remove('active'));
                    });
                </script>
                <!-- End Main Header Middle Area -->

                <!-- Start Main Header Right Area -->
                <div class="cs_main_header_right">
                    <div class="cs-header-additional-item">
                        <a href="{{ url('/Quoterequest') }}"><span class="cs_accent_color">+</span> Request a Free
                            Quote</a>
                    </div>
                    <div class="cs_toolbox">
                        <span class="cs_icon_btn">
                            <span class="cs_icon_btn_in">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </span>
                    </div>
                </div>
                <!-- End Main Header Right Area -->
            </div>
        </div>
    </div>
    <!-- End Main Header Area -->

    <!-- Header Email Phone -->
    <div class="cs-header-emai-phone">
        <div class="cs-topbar-email">
            <div class="cs-email">
                <a href="#">info@motorspeedcourier.com</a>
            </div>
        </div>
        <a href="#" class="cs-header-phone">
            <div class="cs-header-phone-content">
                <div class="cs-header-phone-in">
                    <div class="cs-header-phone-icon">
                        <i class="flaticon-viber"></i>
                    </div>
                    <div class="cs-header-phone-number">
                        <span>Make a Call</span>
                        <div>
                            <h6 class="cs-text-style-h6 cs-text_b_line">
                                +254 711 222666
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Header Email Phone -->
</header>
<!-- End Header Section -->

<!-- Start Sidebar -->
<div class="cs_side_header">
    <button class="cs_close"></button>
    <div class="cs_side_header_overlay"></div>
    <div class="cs_side_header_in">
        <div class="cs-sidebar-about-brand">
            <a class="cs_site_branding" href="/">
                <img src="assets/img/logo_black_text.png" alt="Logo" />
            </a>
            <p>We handle every step of the order fulfillment process, ensuring your products reach customers on time and
                in perfect condition.
            </p>
        </div>


        <div class="cs-sidebar-middle-area">
            <p>Reliable Logistics Solutions Across Kenya | Same-Day & Next-Day Delivery Available</p>
            <div class="cs-sidebar-emai-phone">
                <a href="#" class="cs-text-style-h6">+254 798 984929</a>
                <a href="#" class="cs-text-style-h6">info@motorspeedcourier.com</a>
            </div>

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
                        <a href="https://twitter.com/motorspeedcargo" target="_blank" rel="noopener noreferrer"
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
<!-- End Sidebar -->
