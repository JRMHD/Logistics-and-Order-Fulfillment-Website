<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/assets/img/favicon log.png">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Alpine.js for interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Trix Editor Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800;900&display=swap');

        :root {
            --primary: #EC1F27;
            --primary-rgb: 236, 31, 39;
            --primary-light: #ff3d47;
            --primary-dark: #c91e27;
            --accent: #6366f1;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;

            --neutral-0: #ffffff;
            --neutral-50: #fafafa;
            --neutral-100: #f4f4f5;
            --neutral-200: #e4e4e7;
            --neutral-300: #d4d4d8;
            --neutral-400: #a1a1aa;
            --neutral-500: #71717a;
            --neutral-600: #52525b;
            --neutral-700: #3f3f46;
            --neutral-800: #27272a;
            --neutral-900: #18181b;

            --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

            --blur-sm: blur(4px);
            --blur-md: blur(8px);
            --blur-lg: blur(16px);
            --blur-xl: blur(24px);

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
            --radius-full: 9999px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Sora', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--neutral-0);
            color: var(--neutral-800);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
        }

        /* Ultra-Modern Glassmorphism Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: var(--blur-lg);
            border-right: 1px solid rgba(var(--primary-rgb), 0.08);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            box-shadow: var(--shadow-xl);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg,
                    rgba(var(--primary-rgb), 0.02) 0%,
                    rgba(var(--primary-rgb), 0.005) 50%,
                    rgba(0, 0, 0, 0.01) 100%);
            pointer-events: none;
        }

        .sidebar-header {
            padding: 32px 28px 24px;
            border-bottom: 1px solid rgba(var(--primary-rgb), 0.08);
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
        }

        .sidebar-header img {
            height: 36px;
            width: auto;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.1));
        }

        .company-logo {
            max-height: 36px;
            max-width: 120px;
            object-fit: contain;
        }

        /* Futuristic Navigation */
        .nav-menu {
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            border-radius: var(--radius-lg);
            color: var(--neutral-600);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
            overflow: hidden;
            letter-spacing: -0.01em;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(var(--primary-rgb), 0.1),
                    rgba(var(--primary-rgb), 0.05));
            opacity: 0;
            transition: all 0.3s ease;
            border-radius: var(--radius-lg);
        }

        .nav-item:hover::before {
            opacity: 1;
        }

        .nav-item:hover {
            color: var(--primary);
            transform: translateX(4px) scale(1.02);
            box-shadow: var(--shadow-md);
        }

        .nav-item.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 8px 32px rgba(var(--primary-rgb), 0.4);
            transform: translateX(2px);
        }

        .nav-item.active::before {
            display: none;
        }

        .nav-item.active:hover {
            transform: translateX(2px) scale(1.02);
            box-shadow: 0 12px 40px rgba(var(--primary-rgb), 0.5);
        }

        .nav-item svg {
            width: 22px;
            height: 22px;
            stroke-width: 2;
            transition: all 0.3s ease;
        }

        /* Floating User Section */
        .user-section {
            position: absolute;
            bottom: 24px;
            left: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: var(--blur-md);
            border: 1px solid rgba(var(--primary-rgb), 0.1);
            border-radius: var(--radius-xl);
            padding: 20px;
            box-shadow: var(--shadow-lg);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-radius: var(--radius-lg);
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(var(--primary-rgb), 0.08);
            margin-bottom: 16px;
            backdrop-filter: var(--blur-sm);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-full);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius-full);
        }

        .user-avatar::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: var(--radius-full);
            z-index: -1;
            opacity: 0.3;
            filter: blur(4px);
        }

        .user-details h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--neutral-900);
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .user-details p {
            font-size: 13px;
            color: var(--neutral-500);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 14px 20px;
            background: rgba(239, 68, 68, 0.05);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: var(--radius-md);
            color: var(--danger);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: -0.01em;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Ultra-Modern Top Navigation */
        .top-nav {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 80px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: var(--blur-xl);
            border-bottom: 1px solid rgba(var(--primary-rgb), 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            z-index: 999;
            box-shadow: var(--shadow-sm);
        }

        .top-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                    rgba(var(--primary-rgb), 0.01) 0%,
                    rgba(255, 255, 255, 0.05) 50%,
                    rgba(var(--primary-rgb), 0.01) 100%);
            pointer-events: none;
        }

        .page-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--neutral-900);
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, var(--neutral-900), var(--neutral-700));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Futuristic User Menu */
        .top-user-menu {
            position: relative;
        }

        .top-user-btn {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(var(--primary-rgb), 0.12);
            border-radius: var(--radius-full);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            backdrop-filter: var(--blur-md);
            box-shadow: var(--shadow-sm);
        }

        .top-user-btn:hover {
            background: rgba(255, 255, 255, 1);
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
            border-color: rgba(var(--primary-rgb), 0.2);
        }

        .top-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .top-user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--radius-full);
        }

        .top-user-avatar::after {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: var(--radius-full);
            z-index: -1;
            opacity: 0.2;
            filter: blur(2px);
        }

        .top-user-info h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--neutral-900);
            margin-bottom: 2px;
            letter-spacing: -0.01em;
        }

        .top-user-info p {
            font-size: 13px;
            color: var(--neutral-500);
            font-weight: 500;
        }

        .chevron-icon {
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .top-user-menu.open .chevron-icon {
            transform: rotate(180deg);
        }

        /* Ultra-Modern Dropdown */
        .dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: var(--blur-xl);
            border: 1px solid rgba(var(--primary-rgb), 0.1);
            border-radius: var(--radius-xl);
            padding: 12px;
            box-shadow: var(--shadow-2xl);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-12px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            z-index: 9999;
        }

        .dropdown.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 24px;
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(var(--primary-rgb), 0.1);
            border-bottom: none;
            border-right: none;
            transform: rotate(45deg);
            backdrop-filter: var(--blur-xl);
        }

        .dropdown-header {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(var(--primary-rgb), 0.08);
            margin-bottom: 8px;
        }

        .dropdown-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--neutral-900);
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .dropdown-header p {
            font-size: 13px;
            color: var(--neutral-500);
            font-weight: 500;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            border-radius: var(--radius-lg);
            color: var(--neutral-600);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            letter-spacing: -0.01em;
            position: relative;
            overflow: hidden;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(var(--primary-rgb), 0.05),
                    rgba(var(--primary-rgb), 0.02));
            opacity: 0;
            transition: all 0.3s ease;
            border-radius: var(--radius-lg);
        }

        .dropdown-item:hover::before {
            opacity: 1;
        }

        .dropdown-item:hover {
            color: var(--primary);
            transform: translateX(4px);
        }

        .dropdown-item.danger:hover {
            color: var(--danger);
        }

        .dropdown-item.danger:hover::before {
            background: linear-gradient(135deg,
                    rgba(239, 68, 68, 0.05),
                    rgba(239, 68, 68, 0.02));
        }

        .dropdown-item svg {
            width: 20px;
            height: 20px;
            stroke-width: 2;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding-top: 80px;
            min-height: 100vh;
            background: linear-gradient(135deg,
                    var(--neutral-0) 0%,
                    var(--neutral-50) 50%,
                    var(--neutral-0) 100%);
        }

        .content-wrapper {
            padding: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: var(--shadow-2xl);
            }

            .top-nav {
                left: 0;
                padding: 0 20px;
                height: 72px;
            }

            .main-content {
                margin-left: 0;
                padding-top: 72px;
            }

            .content-wrapper {
                padding: 24px 20px;
            }

            .page-title {
                font-size: 22px;
            }

            .top-user-info {
                display: none;
            }

            .dropdown {
                width: 260px;
            }
        }

        .mobile-menu-btn {
            display: none;
            padding: 12px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(var(--primary-rgb), 0.12);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            backdrop-filter: var(--blur-md);
        }

        .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: var(--blur-md);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .mobile-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        /* Smooth micro-animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-item {
            animation: fadeInUp 0.5s ease forwards;
        }

        .nav-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .nav-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .nav-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .nav-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .nav-item:nth-child(5) {
            animation-delay: 0.5s;
        }

        .nav-item:nth-child(6) {
            animation-delay: 0.6s;
        }

        .nav-item:nth-child(7) {
            animation-delay: 0.7s;
        }

        .nav-item:nth-child(8) {
            animation-delay: 0.8s;
        }
    </style>
</head>

<body>
    <!-- Mobile overlay -->
    <div class="mobile-overlay" id="mobile-overlay"></div>

    <!-- Ultra-Modern Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/logo_black_text.png') }}" alt="Logo">
            </a>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <a href="/profile" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profile Settings
            </a>

            <a href="#" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                My Orders
            </a>

            <a href="#" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                Favorites
            </a>

            <a href="#" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-5 5v-5zM9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Documents
            </a>

            <a href="#" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Billing
            </a>

            <a href="#" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Support
            </a>

            <a href="#" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
            </a>
        </nav>

        <div class="user-section">
            <div class="user-info">
                <div class="top-user-avatar">
                    @if (auth()->user()->company_logo && file_exists(storage_path('app/public/' . auth()->user()->company_logo)))
                        <img src="{{ asset('storage/' . auth()->user()->company_logo) }}" alt="Company Logo">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="user-details">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p title="{{ auth()->user()->email }}">
                        {{ strlen(auth()->user()->email) > 20 ? substr(auth()->user()->email, 0, 20) . '...' : auth()->user()->email }}
                    </p>
                </div>
            </div>
            <button class="logout-btn"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Sign Out
            </button>
        </div>
    </aside>

    <!-- Ultra-Modern Top Navigation -->
    <nav class="top-nav">
        <div style="display: flex; align-items: center; gap: 20px;">
            <button class="mobile-menu-btn" id="mobile-menu-btn">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="page-title">
                @isset($header)
                    {{ $header }}
                @else
                    Dashboard
                @endisset
            </h1>
        </div>

        <div class="top-user-menu" id="user-menu">
            <div class="top-user-btn" id="user-menu-btn">
                <div class="top-user-avatar">
                    @if (auth()->user()->company_logo && file_exists(storage_path('app/public/' . auth()->user()->company_logo)))
                        <img src="{{ asset('storage/' . auth()->user()->company_logo) }}" alt="Company Logo">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="top-user-info">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p title="{{ auth()->user()->email }}">
                        {{ strlen(auth()->user()->email) > 25 ? substr(auth()->user()->email, 0, 25) . '...' : auth()->user()->email }}
                    </p>
                </div>
                <svg class="chevron-icon" width="18" height="18" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <div class="dropdown" id="user-dropdown">
                <div class="dropdown-header">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p title="{{ auth()->user()->email }}">
                        {{ strlen(auth()->user()->email) > 25 ? substr(auth()->user()->email, 0, 25) . '...' : auth()->user()->email }}
                    </p>
                </div>

                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile Settings
                </a>

                <a href="#" class="dropdown-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    My Orders
                </a>

                <a href="#" class="dropdown-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Favorites
                </a>

                <a href="#" class="dropdown-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </a>

                <a href="#" class="dropdown-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Help & Support
                </a>

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item danger">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Sign Out
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Ultra-modern dropdown functionality
        const userMenu = document.getElementById('user-menu');
        const userMenuBtn = document.getElementById('user-menu-btn');
        const userDropdown = document.getElementById('user-dropdown');

        // Toggle dropdown
        userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = userMenu.classList.contains('open');

            if (isOpen) {
                closeDropdown();
            } else {
                openDropdown();
            }
        });

        function openDropdown() {
            userMenu.classList.add('open');
            userDropdown.classList.add('open');
        }

        function closeDropdown() {
            userMenu.classList.remove('open');
            userDropdown.classList.remove('open');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenu.contains(e.target)) {
                closeDropdown();
            }
        });

        // Close dropdown on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDropdown();
            }
        });

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        mobileMenuBtn.addEventListener('click', function() {
            const isOpen = sidebar.classList.contains('open');

            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        function openMobileMenu() {
            sidebar.classList.add('open');
            mobileOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            sidebar.classList.remove('open');
            mobileOverlay.classList.remove('open');
            document.body.style.overflow = '';
        }

        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu when clicking nav items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    closeMobileMenu();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeMobileMenu();
                closeDropdown();
            }
        });

        // Update active nav item based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.nav-item');

            navItems.forEach(item => {
                item.classList.remove('active');
                const href = item.getAttribute('href');

                if (href === currentPath ||
                    (currentPath.includes('/dashboard') && href.includes('/dashboard')) ||
                    (currentPath.includes('/profile') && href.includes('/profile'))) {
                    item.classList.add('active');
                }
            });
        });

        // Smooth page transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading states and micro-interactions
            const navItems = document.querySelectorAll('.nav-item');

            navItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    item.style.transition = 'all 0.5s cubic-bezier(0.25, 1, 0.5, 1)';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Enhanced hover effects
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px) scale(1.02)';
            });

            item.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'translateX(0) scale(1)';
                } else {
                    this.style.transform = 'translateX(2px) scale(1)';
                }
            });
        });
    </script>
</body>

</html>
