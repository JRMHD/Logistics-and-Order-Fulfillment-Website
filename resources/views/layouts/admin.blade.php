<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="/assets/img/favicon log.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/qjdgdss7zdjs5zce0uo4jwbz307a78l0lmmi15r1yyur61so/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'link lists image table code help wordcount',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image | removeformat',
            height: 400
        });
    </script>

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

        .sidebar-header h1 {
            font-size: 22px;
            font-weight: 800;
            color: var(--neutral-900);
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
    </style>
</head>

<body>
    <!-- Mobile overlay -->
    <div class="mobile-overlay" id="mobile-overlay"></div>

    <!-- Ultra-Modern Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/img/logo_black_text.png') }}" alt="Logo">
            </a>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-2.025" />
                </svg>
                User Management
            </a>

            <a href="{{ URL('/admin/trucking') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 18.75a1.5 1.5 0 01-3 0V8.25a1.5 1.5 0 013 0v10.5zM12 18.75a1.5 1.5 0 01-3 0V8.25a1.5 1.5 0 013 0v10.5zM15.75 18.75a1.5 1.5 0 01-3 0V8.25a1.5 1.5 0 013 0v10.5z" />
                </svg>
                Trucking
            </a>

            <a href="{{ route('admin.blogs.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                Blogs
            </a>

            <a href="{{ route('admin.blogs.create') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create Blog
            </a>

            <a href="{{ route('admin.comments.index') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                </svg>
                Comments
            </a>

            <a href="{{ URL('/admin/subscribers') }}" class="nav-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Subscribers
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
                    <p>{{ auth()->user()->email }}</p>
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
            <h1 class="page-title">Dashboard</h1>
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
                    <p>{{ auth()->user()->email }}</p>
                </div>
                <svg class="chevron-icon" width="18" height="18" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <div class="dropdown" id="user-dropdown">
                <div class="dropdown-header">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p>{{ auth()->user()->email }}</p>
                </div>


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
                    (currentPath.includes('/admin/') && href.includes(currentPath.split('/admin/')[1]))) {
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
