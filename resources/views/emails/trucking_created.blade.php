<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trucking Order Confirmation - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Space Grotesk', 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: #e0e0ff;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: rgba(48, 43, 99, 0.6);
            border: 2px solid #7367f0;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .header {
            background: linear-gradient(90deg, #7367f0, #9d74ff);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 20px;
        }

        .order-details {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #5d3fd3;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .tracking-section {
            background: rgba(109, 63, 211, 0.2);
            border-left: 4px solid #7367f0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            background: linear-gradient(90deg, #7367f0, #9d74ff);
            text-decoration: none;
            border-radius: 8px;
            transition: transform 0.2s;
            text-align: center;
            margin: 15px 0;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(115, 103, 240, 0.4);
        }

        .footer {
            text-align: center;
            color: #a0a0ff;
            font-size: 0.8em;
            margin-top: 20px;
            border-top: 1px solid rgba(115, 103, 240, 0.3);
            padding-top: 20px;
        }

        .truck-icon::before {
            content: "🚛";
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>🚛 Hello {{ $name }},</h2>
        </div>

        <p class="truck-icon">Your trucking order has been successfully created.</p>

        <div class="order-details">
            <p><strong>Tracking Number:</strong> {{ $tracking_number }}</p>
            <p><strong>From Location:</strong> {{ $from_location }}</p>
            <p><strong>To Location:</strong> {{ $to_location }}</p>
            <p><strong>Current Status:</strong> {{ $status }}</p>
        </div>

        <div class="tracking-section">
            <p>You can track your order anytime using your tracking number.</p>
            <a href="{{ url('/order-tracking') }}" class="button">
                Track Your Order
            </a>
        </div>

        <p>Thank you for choosing our logistics service!</p>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }} | Secure Logistics Partner</p>
            <p>This is an automated message. Please do not reply directly.</p>
        </div>
    </div>
</body>

</html>
