<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Quote Request - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #333333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            background: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .content p {
            margin: 10px 0;
            font-size: 14px;
            color: #555555;
        }

        .content strong {
            color: #333333;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            color: #777777;
            font-size: 0.8em;
            margin-top: 20px;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>✨ Thank You for Your Quote Request</h2>
        </div>

        <div class="content">
            <p>Dear {{ $quote->full_name }},</p>
            <p>We have received your request for <strong>"{{ $quote->services }}"</strong>. Our team will get back to
                you soon.</p>
            <p>Best Regards,<br>{{ config('app.name') }}</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}</p>
            <p>We appreciate your interest in our services.</p>
        </div>
    </div>
</body>

</html>
