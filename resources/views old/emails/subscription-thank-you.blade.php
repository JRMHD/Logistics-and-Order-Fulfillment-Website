<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Newsletter - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
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

        .content {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #5d3fd3;
            border-radius: 10px;
            padding: 20px;
        }

        .footer {
            text-align: center;
            color: #a0a0ff;
            font-size: 0.8em;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>✨ Welcome to Our Newsletter!</h2>
        </div>

        <div class="content">
            <p>Hi there!</p>

            <p>Thanks for signing up for our newsletter. We're excited to share updates and news with you.</p>

            <p>Stay tuned for great content coming your way.</p>

            <p>Best regards,<br>{{ config('app.name') }} Team</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}</p>
            <p>You can unsubscribe anytime in your account settings.</p>
        </div>
    </div>
</body>

</html>
