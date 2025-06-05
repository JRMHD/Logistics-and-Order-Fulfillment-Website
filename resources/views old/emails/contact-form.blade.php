<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Transmission - {{ config('app.name') }}</title>
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

        .contact-block {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #5d3fd3;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .message-section {
            background: rgba(109, 63, 211, 0.2);
            border-left: 4px solid #7367f0;
            padding: 15px;
            border-radius: 8px;
        }

        .footer {
            text-align: center;
            color: #a0a0ff;
            font-size: 0.8em;
            margin-top: 20px;
        }

        .eth-icon::before {
            content: "Ξ";
            margin-right: 8px;
            color: #7367f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>🌐 Hello {{ config('app.name') }} Team,</h2>
        </div>

        <p class="eth-icon">You have received a new contact form submission from your website.</p>

        <div class="contact-block">
            <p><strong>Sender Identity:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
            <p><strong>Sugject:</strong> {{ $contact->subject }}</p>
        </div>

        <div class="message-section">
            <strong>Transmitted Message:</strong>
            <p>{{ $contact->message }}</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }} | Cryptographically Secured Communication</p>
            <p>This transmission is an automated protocol. Do not reply directly.</p>
        </div>
    </div>
</body>

</html>
