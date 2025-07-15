<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Register</title>
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
            --green-500: #22c55e;

            --violet-50: #f5f3ff;
            --violet-500: #8b5cf6;

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
            padding: 10px;
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

        .main-container {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .image-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .image-container {
            width: 100%;
            max-width: 500px;
            height: 600px;
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-2xl);
            position: relative;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: var(--blur-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-2xl);
            padding: 0;
            box-shadow: var(--shadow-2xl);
            overflow: hidden;
            position: relative;
        }

        .auth-card::before {
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

        .auth-header {
            padding: 24px 32px 16px;
            text-align: center;
            position: relative;
        }

        .logo-container {
            margin-bottom: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-container img {
            height: 40px;
            width: auto;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .auth-header h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--neutral-900);
            margin-bottom: 6px;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, var(--neutral-900), var(--neutral-700));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-header p {
            font-size: 14px;
            color: var(--neutral-500);
            font-weight: 500;
            letter-spacing: -0.01em;
        }

        .auth-form {
            padding: 16px 32px 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--neutral-700);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--neutral-200);
            border-radius: var(--radius-md);
            font-size: 14px;
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
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
            background: rgba(255, 255, 255, 1);
            transform: translateY(-1px);
        }

        .form-input:hover {
            border-color: var(--neutral-300);
            background: rgba(255, 255, 255, 0.9);
        }

        .error-message {
            margin-top: 4px;
            font-size: 11px;
            color: var(--primary);
            font-weight: 500;
        }

        .phone-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .country-code {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            font-weight: 500;
            color: var(--neutral-600);
            pointer-events: none;
            z-index: 10;
        }

        .phone-input {
            padding-left: 55px;
        }

        .file-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px dashed var(--neutral-200);
            border-radius: var(--radius-md);
            font-size: 12px;
            font-weight: 500;
            color: var(--neutral-500);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: var(--blur-sm);
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .file-input-label:hover {
            border-color: var(--neutral-300);
            background: rgba(255, 255, 255, 0.9);
        }

        .file-input:focus+.file-input-label {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .file-selected {
            border-color: var(--primary);
            border-style: solid;
            color: var(--primary);
        }

        .submit-button {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: var(--radius-md);
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            letter-spacing: -0.01em;
            box-shadow: 0 4px 16px rgba(var(--primary-rgb), 0.3);
            position: relative;
            overflow: hidden;
            margin-top: 8px;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-button:hover::before {
            left: 100%;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(var(--primary-rgb), 0.4);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .login-section {
            text-align: center;
            margin-top: 20px;
            padding: 16px 32px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: var(--blur-lg);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0 0 var(--radius-2xl) var(--radius-2xl);
            box-shadow: var(--shadow-lg);
        }

        .login-text {
            font-size: 13px;
            color: var(--neutral-600);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .login-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s ease;
            position: relative;
        }

        .login-link:hover {
            color: var(--primary-dark);
        }

        .login-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .login-link:hover::after {
            width: 100%;
        }

        /* Mobile responsiveness */
        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 1fr;
                gap: 20px;
                max-width: 500px;
                padding: 10px;
            }

            .image-section {
                order: -1;
            }

            .image-container {
                height: 300px;
                max-width: 400px;
            }

            .auth-header {
                padding: 20px 24px 12px;
            }

            .auth-form {
                padding: 12px 24px 20px;
            }

            .login-section {
                padding: 12px 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 8px;
            }

            .main-container {
                gap: 16px;
            }

            .image-container {
                height: 250px;
            }

            .auth-header {
                padding: 16px 20px 10px;
            }

            .auth-form {
                padding: 10px 20px 16px;
            }

            .login-section {
                padding: 12px 20px;
            }

            .country-code {
                left: 10px;
            }

            .phone-input {
                padding-left: 50px;
            }
        }

        /* Loading state */
        .submit-button.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .submit-button.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 18px;
            height: 18px;
            margin: -9px 0 0 -9px;
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

        /* Smooth animations */
        .auth-card {
            animation: fadeInUp 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .image-container {
            animation: fadeInLeft 0.6s cubic-bezier(0.25, 1, 0.5, 1);
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

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Image Section -->
        <div class="image-section">
            <div class="image-container">
                <img src="{{ asset('assets/img/shipingwoman.jpg') }}" alt="Shipping Woman">
            </div>
        </div>

        <!-- Form Section -->
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="logo-container">
                        <img src="{{ asset('assets/img/logo_black_text.png') }}" alt="{{ config('app.name', 'Logo') }}">
                    </div>
                    <h1>Create Your Account</h1>
                    <p>Join us by filling out the form below</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="auth-form" enctype="multipart/form-data">
                    @csrf

                    <!-- Name and Email Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                autofocus autocomplete="name" placeholder="Enter your full name"
                                class="form-input @error('name') border-red-300 @enderror" />
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autocomplete="username" placeholder="Enter your email"
                                class="form-input @error('email') border-red-300 @enderror" />
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone and Company Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <div class="phone-input-container">
                                <span class="country-code">+254</span>
                                <input id="phone_number" type="tel" name="phone_number"
                                    value="{{ old('phone_number') }}" required autocomplete="tel"
                                    placeholder="700123456"
                                    class="form-input phone-input @error('phone_number') border-red-300 @enderror" />
                            </div>
                            @error('phone_number')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input id="company_name" type="text" name="company_name"
                                value="{{ old('company_name') }}" required autocomplete="organization"
                                placeholder="Enter company name"
                                class="form-input @error('company_name') border-red-300 @enderror" />
                            @error('company_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Company Logo -->
                    <div class="form-group">
                        <label for="company_logo" class="form-label">Company Logo (Optional)</label>
                        <div class="file-input-container">
                            <input id="company_logo" type="file" name="company_logo" accept="image/*"
                                class="file-input @error('company_logo') border-red-300 @enderror" />
                            <label for="company_logo" class="file-input-label" id="file-label">
                                Choose logo (PNG, JPG, GIF - Max 2MB)
                            </label>
                        </div>
                        @error('company_logo')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                placeholder="Choose password"
                                class="form-input @error('password') border-red-300 @enderror" />
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                autocomplete="new-password" placeholder="Confirm password" class="form-input" />
                            @error('password_confirmation')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-button" id="register-btn">
                        Create Account
                    </button>
                </form>
            </div>

            <!-- Login Link -->
            <div class="login-section">
                <p class="login-text">
                    Already have an account?
                    <a href="{{ route('login') }}" class="login-link">Sign in here</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.auth-form');
            const registerBtn = document.getElementById('register-btn');
            const inputs = document.querySelectorAll('.form-input');
            const fileInput = document.getElementById('company_logo');
            const fileLabel = document.getElementById('file-label');

            // Add loading state on form submit
            form.addEventListener('submit', function() {
                registerBtn.classList.add('loading');
                registerBtn.textContent = '';
            });

            // Enhanced input animations
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });

                // Auto-fill detection
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
            });

            // File input handling
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    fileLabel.textContent = file.name;
                    fileLabel.classList.add('file-selected');
                } else {
                    fileLabel.textContent = 'Choose logo (PNG, JPG, GIF - Max 2MB)';
                    fileLabel.classList.remove('file-selected');
                }
            });

            // Keyboard navigation enhancement
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && document.activeElement.type !== 'submit') {
                    const currentIndex = Array.from(inputs).indexOf(document.activeElement);
                    const nextInput = inputs[currentIndex + 1];

                    if (nextInput) {
                        nextInput.focus();
                    } else {
                        registerBtn.focus();
                    }
                }
            });
        });
    </script>
</body>

</html>
