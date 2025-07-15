<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Reset Password') }} - Reset Password</title>
    <link rel="icon" href="/assets/img/favicon log.png">
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        :root {
            --primary: #EC1F27;
            --primary-rgb: 236, 31, 39;
            --primary-light: #ff4d56;
            --primary-dark: #c91e27;

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

            --blue-50: #eff6ff;
            --blue-100: #dbeafe;
            --blue-500: #3b82f6;
            --blue-600: #2563eb;

            --green-50: #f0fdf4;
            --green-100: #dcfce7;
            --green-500: #22c55e;

            --violet-50: #f5f3ff;
            --violet-500: #8b5cf6;

            --amber-50: #fffbeb;
            --amber-100: #fef3c7;
            --amber-500: #f59e0b;

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
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg,
                    var(--neutral-50) 0%,
                    var(--neutral-100) 25%,
                    var(--blue-50) 50%,
                    var(--violet-50) 75%,
                    var(--neutral-50) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(var(--primary-rgb), 0.05) 0%, transparent 50%);
            pointer-events: none;
            animation: backgroundFloat 20s ease-in-out infinite;
        }

        @keyframes backgroundFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-10px) rotate(1deg);
            }

            66% {
                transform: translateY(5px) rotate(-1deg);
            }
        }

        .forgot-container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
        }

        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: var(--blur-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-2xl);
            padding: 0;
            box-shadow: var(--shadow-2xl);
            overflow: hidden;
            position: relative;
        }

        .forgot-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.1) 0%,
                    rgba(255, 255, 255, 0.05) 100%);
            pointer-events: none;
        }

        .forgot-header {
            padding: 40px 40px 24px;
            text-align: center;
            position: relative;
        }

        .logo-container {
            margin-bottom: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-container img {
            height: 48px;
            width: auto;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .logo-container img:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 6px 16px rgba(0, 0, 0, 0.15));
        }

        .forgot-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: var(--neutral-900);
            margin-bottom: 12px;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, var(--neutral-900), var(--neutral-700));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .forgot-description {
            font-size: 16px;
            color: var(--neutral-600);
            font-weight: 500;
            line-height: 1.6;
            letter-spacing: -0.01em;
            max-width: 360px;
            margin: 0 auto;
        }

        .forgot-form {
            padding: 24px 40px 40px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--neutral-700);
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .form-input {
            width: 100%;
            padding: 18px 20px;
            border: 1.5px solid var(--neutral-200);
            border-radius: var(--radius-lg);
            font-size: 16px;
            font-weight: 500;
            color: var(--neutral-900);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: var(--blur-sm);
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            outline: none;
            letter-spacing: -0.01em;
        }

        .form-input::placeholder {
            color: var(--neutral-400);
            font-weight: 400;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
            background: rgba(255, 255, 255, 1);
            transform: translateY(-1px);
        }

        .form-input:hover {
            border-color: var(--neutral-300);
            background: rgba(255, 255, 255, 0.9);
        }

        .error-message {
            margin-top: 8px;
            font-size: 13px;
            color: var(--primary);
            font-weight: 500;
        }

        .success-message {
            margin-bottom: 24px;
            padding: 16px 20px;
            background: rgba(34, 197, 94, 0.05);
            border: 1.5px solid rgba(34, 197, 94, 0.2);
            border-radius: var(--radius-lg);
            color: var(--green-500);
            font-size: 14px;
            font-weight: 600;
            backdrop-filter: var(--blur-sm);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .success-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .reset-button {
            width: 100%;
            padding: 18px 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: var(--radius-lg);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            letter-spacing: -0.01em;
            box-shadow: 0 4px 16px rgba(var(--primary-rgb), 0.3);
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .reset-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .reset-button:hover::before {
            left: 100%;
        }

        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(var(--primary-rgb), 0.4);
        }

        .reset-button:active {
            transform: translateY(0);
        }

        .back-link {
            display: block;
            text-align: center;
            font-size: 15px;
            color: var(--neutral-600);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
            padding: 12px 20px;
            border-radius: var(--radius-lg);
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: var(--blur-sm);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .back-link:hover {
            color: var(--primary);
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .back-link::before {
            content: '←';
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .back-link:hover::before {
            transform: translateX(-2px);
        }

        /* Mobile responsiveness */
        @media (max-width: 640px) {
            body {
                padding: 16px;
            }

            .forgot-header {
                padding: 32px 24px 20px;
            }

            .logo-container img {
                height: 40px;
            }

            .forgot-header h1 {
                font-size: 24px;
            }

            .forgot-description {
                font-size: 15px;
            }

            .forgot-form {
                padding: 20px 24px 32px;
            }

            .form-input {
                padding: 16px 18px;
            }

            .reset-button {
                padding: 16px 24px;
            }
        }

        /* Loading state */
        .reset-button.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .reset-button.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
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

        /* Focus visible for accessibility */
        .form-input:focus-visible,
        .reset-button:focus-visible,
        .back-link:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Smooth animations */
        .forgot-card {
            animation: fadeInUp 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Icon animations */
        .success-icon {
            animation: successPulse 2s ease-in-out infinite;
        }

        @keyframes successPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }
    </style>
</head>

<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
                <div class="logo-container">
                    <img src="{{ asset('assets/img/logo_black_text.png') }}" alt="{{ config('app.name', 'Logo') }}">
                </div>
                <h1>Reset Password</h1>
                <p class="forgot-description">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset link that will allow you to choose a new one.
                </p>
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="forgot-form">
                @csrf

                <!-- Session Status -->
                @if (session('status'))
                    <div class="success-message">
                        <svg class="success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email Input -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="Enter your email address"
                        class="form-input @error('email') border-red-300 @enderror" />
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="reset-button" id="reset-btn">
                    Send Reset Link
                </button>

                <!-- Back to Login Link -->
                <a href="{{ route('login') }}" class="back-link">
                    Back to Login
                </a>
            </form>
        </div>
    </div>

    <script>
        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.forgot-form');
            const resetBtn = document.getElementById('reset-btn');
            const emailInput = document.querySelector('#email');

            // Add loading state on form submit
            form.addEventListener('submit', function() {
                resetBtn.classList.add('loading');
                resetBtn.textContent = '';
            });

            // Enhanced input animations
            emailInput.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            emailInput.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });

            // Auto-fill detection
            if (emailInput.value) {
                emailInput.parentElement.classList.add('focused');
            }

            // Enter key handling
            emailInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    resetBtn.click();
                }
            });

            // Success message animation
            const successMessage = document.querySelector('.success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.animation = 'fadeInUp 0.5s ease forwards';
                }, 100);
            }
        });
    </script>
</body>

</html>
