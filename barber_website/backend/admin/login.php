<?php

session_start();

require_once "../config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin["password"])) {

            $_SESSION["admin"] = $admin["username"];

            header("Location: dashboard.php");
            exit;

        } else {

            $error = "Incorrect password.";

        }

    } else {

        $error = "Username not found.";

    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Blade & Style</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b0b0b;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .login-box {
            background: #111;
            border: 1px solid #2b2b2b;
            border-radius: 12px;
            padding: 40px 35px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            font-size: 28px;
            letter-spacing: 2px;
            color: white;
        }

        .logo span {
            color: #c9a227;
        }

        .logo p {
            color: #aaa;
            font-size: 14px;
            margin-top: 8px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-title h2 {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .login-title p {
            color: #999;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #ddd;
        }

        .form-group input {
            width: 100%;
            padding: 14px;
            background: #1b1b1b;
            border: 1px solid #333;
            border-radius: 6px;
            color: white;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #c9a227;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            background: #c9a227;
            color: #111;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-button:hover {
            background: #e0bb42;
        }

        .error {
            background: #3a1515;
            color: #ff8c8c;
            border: 1px solid #6b2525;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
        }

        .back-home {
            text-align: center;
            margin-top: 25px;
        }

        .back-home a {
            color: #c9a227;
            text-decoration: none;
            font-size: 14px;
        }

        .back-home a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 12px;
        }

        @media (max-width: 500px) {

            .login-box {
                padding: 30px 25px;
            }

            .logo h1 {
                font-size: 24px;
            }

        }

    </style>

</head>

<body>

    <div class="login-container">

        <div class="login-box">

            <div class="logo">

                <h1>
                    BLADE <span>&</span> STYLE
                </h1>

                <p>Professional Barber Shop</p>

            </div>

            <div class="login-title">

                <h2>Admin Login</h2>

                <p>Sign in to manage your bookings</p>

            </div>

            <?php if ($error != ""): ?>

                <div class="error">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>

            <form method="POST">

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter admin username"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>

                <button type="submit" class="login-button">
                    Login to Dashboard
                </button>

            </form>

            <div class="back-home">

                <a href="../../index.html">
                    ← Back to Website
                </a>

            </div>

        </div>

        <div class="footer">

            © 2026 Blade & Style. All rights reserved.

        </div>

    </div>

</body>

</html>