<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ $appName }}</title>
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
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: var(--blur-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-2xl);
            overflow: hidden;
            position: relative;
        }

        .email-container::before {
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

        .header {
            text-align: center;
            padding: 32px 32px 24px;
            position: relative;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: var(--blur-lg);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .logo-container {
            margin-bottom: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            height: 48px;
            width: auto;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));
        }

        .header h1 {
            font-size: 28px;
            font-weight: 800;
            color: var(--neutral-900);
            margin: 0;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, var(--neutral-900), var(--neutral-700));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .content {
            padding: 32px;
            position: relative;
        }

        .welcome-text {
            margin-bottom: 24px;
            font-size: 16px;
            line-height: 1.6;
            color: var(--neutral-700);
            font-weight: 400;
            letter-spacing: -0.01em;
        }

        .welcome-text p {
            margin-bottom: 16px;
        }

        .user-info {
            background: rgba(var(--blue-500), 0.05);
            border: 1px solid rgba(var(--blue-500), 0.1);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin: 24px 0;
            position: relative;
        }

        .user-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
            border-radius: var(--radius-sm);
        }

        .user-info h4 {
            font-size: 16px;
            font-weight: 700;
            color: var(--blue-600);
            margin-bottom: 16px;
            letter-spacing: -0.01em;
        }

        .user-info p {
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--neutral-700);
            font-weight: 500;
        }

        .user-info strong {
            color: var(--neutral-900);
            font-weight: 600;
        }

        .credentials-box {
            background: rgba(var(--neutral-100), 0.8);
            backdrop-filter: var(--blur-sm);
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin: 24px 0;
            position: relative;
        }

        .credentials-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: var(--radius-sm);
        }

        .credentials-box h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--neutral-900);
            margin-bottom: 16px;
            letter-spacing: -0.01em;
        }

        .credential-item {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-md);
            padding: 16px;
            margin: 12px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-xs);
        }

        .credential-label {
            font-weight: 600;
            color: var(--neutral-700);
            font-size: 14px;
            letter-spacing: -0.01em;
        }

        .credential-value {
            font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', Consolas, 'Courier New', monospace;
            color: var(--neutral-900);
            font-size: 14px;
            font-weight: 500;
            background: rgba(var(--neutral-100), 0.8);
            padding: 4px 8px;
            border-radius: var(--radius-sm);
        }

        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 16px;
            letter-spacing: -0.01em;
            box-shadow: 0 4px 16px rgba(var(--primary-rgb), 0.3);
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(var(--primary-rgb), 0.4);
        }

        .button-container {
            text-align: center;
            margin: 32px 0;
        }

        .important-note {
            background: rgba(255, 243, 205, 0.8);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin: 24px 0;
            position: relative;
        }

        .important-note::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            border-radius: var(--radius-sm);
        }

        .important-note strong {
            color: #856404;
            font-weight: 700;
        }

        .important-note p {
            margin: 0;
            font-size: 14px;
            color: #856404;
            font-weight: 500;
        }

        .feature-list {
            background: rgba(var(--green-50), 0.8);
            border: 1px solid rgba(var(--green-500), 0.1);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin: 24px 0;
            position: relative;
        }

        .feature-list::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, var(--green-500), #16a34a);
            border-radius: var(--radius-sm);
        }

        .feature-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            padding: 8px 0;
            font-size: 14px;
            color: var(--neutral-700);
            font-weight: 500;
            position: relative;
            padding-left: 24px;
        }

        .feature-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--green-500);
            font-weight: 700;
            font-size: 16px;
        }

        .footer {
            margin-top: 32px;
            padding: 24px 32px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: var(--blur-lg);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--neutral-600);
            font-size: 14px;
            line-height: 1.5;
        }

        .footer p {
            margin-bottom: 12px;
        }

        .footer small {
            font-size: 12px;
            color: var(--neutral-500);
            line-height: 1.4;
        }

        .api-badge {
            background: linear-gradient(135deg, var(--green-500), #16a34a);
            color: white;
            padding: 4px 12px;
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: -0.01em;
            display: inline-block;
            margin-left: 8px;
        }

        /* Mobile responsiveness */
        @media (max-width: 640px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 24px 20px 20px;
            }

            .content {
                padding: 24px 20px;
            }

            .footer {
                padding: 20px;
            }

            .credential-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .credential-value {
                align-self: stretch;
                text-align: center;
            }

            .login-button {
                padding: 14px 28px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('assets/img/logo_black_text.png') }}" alt="{{ config('app.name') }}" class="logo">
            </div>
            <h1>Welcome to {{ $appName }}!</h1>
        </div>

        <div class="content">
            <div class="welcome-text">
                <p>Dear {{ $user->name }},</p>
                <p>Welcome to {{ $appName }}! An administrator has created an account for you. We're excited to
                    have you on board!</p>
            </div>

            <div class="user-info">
                <h4>Your Account Details:</h4>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Company:</strong> {{ $user->company_name }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                @if ($user->api_authorized)
                    <p><strong>API Access:</strong> <span class="api-badge">Authorized</span></p>
                @endif
            </div>

            <div class="credentials-box">
                <h3>Your Login Credentials</h3>
                <div class="credential-item">
                    <span class="credential-label">Email:</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Temporary Password:</span>
                    <span class="credential-value">{{ $temporaryPassword }}</span>
                </div>
            </div>

            <div class="important-note">
                <p><strong>Important:</strong> This is a temporary password. For security reasons, you will be required
                    to change your password upon your first login.</p>
            </div>

            <div class="button-container">
                <a href="{{ $loginUrl }}" class="login-button">Login to Your Account</a>
            </div>

            <div class="welcome-text">
                <p>Once you log in, you'll be able to:</p>
            </div>

            <div class="feature-list">
                <ul>
                    <li>Access your dashboard</li>
                    <li>Update your profile information</li>
                    <li>Change your password</li>
                    @if ($user->api_authorized)
                        <li>Access API documentation and manage your API keys</li>
                    @endif
                </ul>
            </div>

            <div class="welcome-text">
                <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
            </div>
        </div>

        <div class="footer">
            <p>Best regards,<br>
                The {{ $appName }} Team</p>

            <p><small>This email was sent because an administrator created an account for you. If you believe this was
                    sent in error, please contact us immediately.</small></p>
        </div>
    </div>
</body>

</html>
