<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Quote Request - {{ config('app.name') }}</title>
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

        .quote-details {
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
            <h2>✨ New Quote Request</h2>
        </div>

        <div class="quote-details">
            <p><strong>Name:</strong> {{ $quote->full_name }}</p>
            <p><strong>Phone:</strong> {{ $quote->phone }}</p>
            <p><strong>Pickup:</strong> {{ $quote->pickup_location }}</p>
            <p><strong>Delivery:</strong> {{ $quote->delivery_location }}</p>
            <p><strong>Goods:</strong> {{ $quote->type_of_goods }}</p>
            <p><strong>Date:</strong> {{ $quote->date }}</p>
            <p><strong>Size & Weight:</strong> {{ $quote->weight_dimensions }}</p>
            <p><strong>Additional Notes:</strong> {{ $quote->message }}</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}</p>
            <p>Quote request received and processing initiated.</p>
        </div>
    </div>
</body>

</html>
