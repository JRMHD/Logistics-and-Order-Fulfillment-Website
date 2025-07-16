<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Created - {{ $order->tracking_number }}</title>
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
            --green-600: #16a34a;

            --orange-50: #fff7ed;
            --orange-100: #ffedd5;
            --orange-500: #f97316;
            --orange-600: #ea580c;

            --purple-50: #faf5ff;
            --purple-100: #f3e8ff;
            --purple-500: #a855f7;
            --purple-600: #9333ea;

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
                    var(--green-50) 75%,
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
                radial-gradient(circle at 20% 80%, rgba(34, 197, 94, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(var(--primary-rgb), 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .email-container {
            max-width: 700px;
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
            padding: 30px 20px;
            background: white;
            border-bottom: 3px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .logo-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            font-weight: 800;
            margin: 15px 0;
            font-family: 'Inter', Arial, sans-serif;
            letter-spacing: -0.025em;
        }

        .tracking-number {
            background-color: #f8f9fa;
            color: #666;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            display: inline-block;
            border: 1px solid #e9ecef;
            margin-top: 10px;
        }

        .header-icon {
            margin-bottom: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            padding: 32px;
            position: relative;
        }

        .info-section {
            margin-bottom: 24px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: var(--blur-sm);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--radius-lg);
            padding: 24px;
            position: relative;
            box-shadow: var(--shadow-sm);
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            border-radius: var(--radius-sm);
        }

        .info-section.order-details::before {
            background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
        }

        .info-section.customer-info::before {
            background: linear-gradient(135deg, var(--green-500), var(--green-600));
        }

        .info-section.company-info::before {
            background: linear-gradient(135deg, var(--purple-500), var(--purple-600));
        }

        .info-section.items-info::before {
            background: linear-gradient(135deg, var(--orange-500), var(--orange-600));
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-icon {
            margin-right: 12px;
            padding: 8px;
            border-radius: var(--radius-md);
        }

        .order-details .section-icon {
            background: rgba(var(--blue-500), 0.1);
        }

        .customer-info .section-icon {
            background: rgba(var(--green-500), 0.1);
        }

        .company-info .section-icon {
            background: rgba(var(--purple-500), 0.1);
        }

        .items-info .section-icon {
            background: rgba(var(--orange-500), 0.1);
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--neutral-900);
            letter-spacing: -0.025em;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-md);
            padding: 16px;
            transition: all 0.2s ease;
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .info-label {
            font-weight: 600;
            color: var(--neutral-600);
            font-size: 13px;
            letter-spacing: 0.025em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-value {
            color: var(--neutral-900);
            font-size: 15px;
            font-weight: 500;
            line-height: 1.4;
        }

        .info-value.highlight {
            font-weight: 700;
            color: var(--primary);
        }

        .info-value.currency {
            font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Roboto Mono', Consolas, 'Courier New', monospace;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.025em;
            text-transform: uppercase;
        }

        .badge.success {
            background: var(--green-100);
            color: var(--green-600);
        }

        .badge.warning {
            background: var(--orange-100);
            color: var(--orange-600);
        }

        .badge.info {
            background: var(--blue-100);
            color: var(--blue-600);
        }

        .company-logo {
            max-width: 80px;
            height: auto;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .items-table th {
            background: var(--neutral-100);
            padding: 16px;
            text-align: left;
            font-weight: 700;
            font-size: 14px;
            color: var(--neutral-700);
            letter-spacing: 0.025em;
            text-transform: uppercase;
            border-bottom: 2px solid var(--neutral-200);
        }

        .items-table td {
            padding: 16px;
            border-bottom: 1px solid var(--neutral-200);
            font-size: 14px;
            color: var(--neutral-700);
        }

        .items-table tr:hover {
            background: rgba(var(--neutral-50), 0.8);
        }

        .item-name {
            font-weight: 600;
            color: var(--neutral-900);
            margin-bottom: 4px;
        }

        .item-description {
            font-size: 12px;
            color: var(--neutral-600);
            font-style: italic;
        }

        .quantity-badge {
            background: var(--blue-100);
            color: var(--blue-600);
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 12px;
        }

        .footer {
            margin-top: 24px;
            padding: 24px 32px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: var(--blur-lg);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
        }

        .footer-timestamp {
            color: var(--neutral-600);
            font-size: 14px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .footer-message {
            color: var(--neutral-700);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .footer-brand {
            font-weight: 800;
            color: var(--primary);
            font-size: 16px;
            letter-spacing: -0.025em;
        }

        .special-instructions {
            background: rgba(255, 243, 205, 0.8);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: var(--radius-md);
            padding: 12px;
            margin-top: 8px;
        }

        .special-instructions strong {
            color: #856404;
            font-weight: 600;
        }

        .special-instructions p {
            margin: 0;
            font-size: 13px;
            color: #856404;
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

            .info-grid {
                grid-template-columns: 1fr;
            }

            .items-table {
                font-size: 12px;
            }

            .items-table th,
            .items-table td {
                padding: 12px 8px;
            }

            .footer-timestamp {
                flex-direction: column;
                gap: 4px;
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
            <h1>New Order Alert!</h1>
            <div class="tracking-number">
                Tracking: {{ $order->tracking_number }}
            </div>
        </div>

        <div class="content">
            <div class="info-section order-details">
                <div class="section-header">
                    <div class="section-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2Z"
                                stroke="#3b82f6" stroke-width="2" fill="none" />
                            <path d="M14 2V8H20" stroke="#3b82f6" stroke-width="2" fill="none" />
                            <path d="M16 13H8" stroke="#3b82f6" stroke-width="2" fill="none" />
                            <path d="M16 17H8" stroke="#3b82f6" stroke-width="2" fill="none" />
                            <path d="M10 9H9H8" stroke="#3b82f6" stroke-width="2" fill="none" />
                        </svg>
                    </div>
                    <h3 class="section-title">Order Details</h3>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Tracking Number</div>
                        <div class="info-value highlight">{{ $order->tracking_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">External Order ID</div>
                        <div class="info-value">{{ $order->external_order_id ?? 'N/A' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Total Amount</div>
                        <div class="info-value currency">{{ $order->currency }}
                            {{ number_format($order->total_amount, 2) }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Delivery Type</div>
                        <div class="info-value">
                            <span class="badge info">{{ ucfirst($order->delivery_type) }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Cash on Delivery</div>
                        <div class="info-value">
                            <span class="badge {{ $order->cash_on_delivery ? 'success' : 'warning' }}">
                                {{ $order->cash_on_delivery ? 'Yes' : 'No' }}
                            </span>
                        </div>
                    </div>
                    @if ($order->cash_on_delivery && $order->cod_amount)
                        <div class="info-item">
                            <div class="info-label">COD Amount</div>
                            <div class="info-value currency">{{ $order->currency }}
                                {{ number_format($order->cod_amount, 2) }}</div>
                        </div>
                    @endif
                    <div class="info-item">
                        <div class="info-label">Estimated Delivery</div>
                        <div class="info-value">
                            {{ $order->estimated_delivery ? $order->estimated_delivery->format('M d, Y H:i') : 'Not specified' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-section customer-info">
                <div class="section-header">
                    <div class="section-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                stroke="#22c55e" stroke-width="2" fill="none" />
                            <circle cx="12" cy="7" r="4" stroke="#22c55e" stroke-width="2"
                                fill="none" />
                        </svg>
                    </div>
                    <h3 class="section-title">Customer Information</h3>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Name</div>
                        <div class="info-value">{{ $order->customer_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $order->customer_email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $order->customer_phone }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">City</div>
                        <div class="info-value">{{ $order->city }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Country</div>
                        <div class="info-value">{{ $order->country }}</div>
                    </div>
                    @if ($order->state)
                        <div class="info-item">
                            <div class="info-label">State</div>
                            <div class="info-value">{{ $order->state }}</div>
                        </div>
                    @endif
                    @if ($order->postal_code)
                        <div class="info-item">
                            <div class="info-label">Postal Code</div>
                            <div class="info-value">{{ $order->postal_code }}</div>
                        </div>
                    @endif
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <div class="info-label">Delivery Address</div>
                        <div class="info-value">{{ $order->delivery_address }}</div>
                    </div>
                </div>

                @if ($order->special_instructions)
                    <div class="special-instructions">
                        <strong>Special Instructions:</strong>
                        <p>{{ $order->special_instructions }}</p>
                    </div>
                @endif
            </div>

            <div class="info-section company-info">
                <div class="section-header">
                    <div class="section-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 21H21" stroke="#a855f7" stroke-width="2" fill="none" />
                            <path d="M5 21V7L13 2L21 7V21" stroke="#a855f7" stroke-width="2" fill="none" />
                            <path d="M9 9V13" stroke="#a855f7" stroke-width="2" fill="none" />
                            <path d="M9 17V21" stroke="#a855f7" stroke-width="2" fill="none" />
                            <path d="M15 9V13" stroke="#a855f7" stroke-width="2" fill="none" />
                            <path d="M15 17V21" stroke="#a855f7" stroke-width="2" fill="none" />
                        </svg>
                    </div>
                    <h3 class="section-title">Company Information</h3>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Company</div>
                        <div class="info-value">{{ $company->company_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Contact</div>
                        <div class="info-value">{{ $company->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $company->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $company->phone_number }}</div>
                    </div>
                    @if ($company->company_logo)
                        <div class="info-item">
                            <div class="info-label">Logo</div>
                            <div class="info-value">
                                <img src="{{ asset('storage/' . $company->company_logo) }}" alt="Company Logo"
                                    class="company-logo">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="info-section items-info">
                <div class="section-header">
                    <div class="section-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 8C21 8 20 7 18 7C16 7 15 8 15 8V16C15 16 16 15 18 15C20 15 21 16 21 16V8Z"
                                stroke="#f97316" stroke-width="2" fill="none" />
                            <path d="M3 8C3 8 4 7 6 7C8 7 9 8 9 8V16C9 16 8 15 6 15C4 15 3 16 3 16V8Z" stroke="#f97316"
                                stroke-width="2" fill="none" />
                            <path d="M9 8V16" stroke="#f97316" stroke-width="2" fill="none" />
                            <path d="M15 8V16" stroke="#f97316" stroke-width="2" fill="none" />
                        </svg>
                    </div>
                    <h3 class="section-title">Items Ordered</h3>
                </div>

                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>
                                    <div class="item-name">{{ $item['name'] }}</div>
                                    @if (isset($item['description']) && $item['description'])
                                        <div class="item-description">{{ $item['description'] }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="quantity-badge">{{ $item['quantity'] }}</span>
                                </td>
                                <td class="currency">{{ $order->currency }} {{ number_format($item['price'], 2) }}
                                </td>
                                <td class="currency">{{ $order->currency }}
                                    {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer">
            <div class="footer-timestamp">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                        fill="none" />
                    <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" fill="none" />
                </svg>
                Order created: {{ $order->created_at->format('M d, Y H:i:s') }}
            </div>
            <div class="footer-message">
                Please check the admin panel for more details and to process this order.
            </div>
            <div class="footer-brand">MOTORSPEED LOGISTICS</div>
        </div>
    </div>
</body>

</html>
