<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Confirmation - {{ config('app.name') }}</title>
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

        .delivery-details {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #5d3fd3;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .success-message {
            background: rgba(39, 174, 96, 0.2);
            border-left: 4px solid #27ae60;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            color: #a0a0ff;
            font-size: 0.8em;
            margin-top: 20px;
            border-top: 1px solid rgba(115, 103, 240, 0.3);
            padding-top: 20px;
        }

        .delivered-icon::before {
            content: "✅";
            margin-right: 8px;
        }

        .status-badge {
            display: inline-block;
            background: linear-gradient(90deg, #27ae60, #2ecc71);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>✅ Hello {{ $trucking->name }},</h2>
        </div>

        <div class="success-message">
            <p class="delivered-icon">Your trucking order has been successfully delivered!</p>
        </div>

        <div class="delivery-details">
            <p><strong>Tracking Number:</strong> {{ $trucking->tracking_number }}</p>
            <p><strong>From Location:</strong> {{ $trucking->from_location }}</p>
            <p><strong>To Location:</strong> {{ $trucking->to_location }}</p>
            <p><strong>Final Status:</strong> <span class="status-badge">Delivered</span></p>
        </div>

        <p>Thank you for choosing our logistics service! We hope to serve you again soon.</p>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }} | Secure Logistics Partner</p>
            <p>This is an automated message. Please do not reply directly.</p>
        </div>
    </div>
</body>

</html>
