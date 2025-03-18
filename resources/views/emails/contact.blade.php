<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #198754;
            color: white;
            text-align: center;
            padding: 20px 10px;
        }

        .email-header img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .email-header h1 {
            font-size: 22px;
            margin: 0;
        }

        .email-content {
            padding: 20px;
        }

        .email-content h2 {
            color: #198754;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .email-content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 15px 0;
        }

        .email-content p strong {
            color: #198754;
        }

        .email-footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #666;
        }

        .email-footer a {
            color: #198754;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <img src="{{ asset('assets/images/logo/Logo-Bonfakhrladin.png') }}" alt="Bonfakhrladin Logo">
            <h1>Contact Us Message</h1>
        </div>

        <!-- Content Section -->
        <div class="email-content">
            <h2>You have a new message!</h2>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Subject:</strong> {{ $subject }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $messageBody }}</p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p>&copy; 2024 Bonfakhrladin. All rights reserved.<br>
            </p>
        </div>
    </div>
</body>

</html>
