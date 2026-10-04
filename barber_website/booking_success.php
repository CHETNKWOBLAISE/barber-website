<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Booking Successful | Blade & Style</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #111;
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .success-box {
            width: 100%;
            max-width: 550px;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 45px 30px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        }

        .check {
            width: 70px;
            height: 70px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: #163a24;
            color: #5fd88a;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 38px;
            font-weight: bold;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 15px;
        }

        h1 span {
            color: #d4a017;
        }

        .message {
            color: #aaa;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .status {
            display: inline-block;
            background: #3a3215;
            color: #d4a017;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .home-button {
            display: inline-block;
            padding: 13px 25px;
            background: #d4a017;
            color: #111;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .home-button:hover {
            background: white;
        }

        .footer {
            margin-top: 30px;
            color: #666;
            font-size: 13px;
        }

    </style>

</head>

<body>

    <div class="success-box">

        <div class="check">
            ✓
        </div>

        <h1>
            Booking <span>Submitted!</span>
        </h1>

        <p class="message">
            Thank you for choosing Blade & Style.
            Your appointment request has been received successfully.
            Our team will review your booking and confirm it shortly.
        </p>

        <div class="status">
            Status: Pending
        </div>

        <br>

        <a href="index.html" class="home-button">
            Back to Home
        </a>

        <div class="footer">
            © 2026 Blade & Style. All rights reserved.
        </div>

    </div>

</body>

</html>