<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <style>
        body {
            background-color: orange;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login_container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .container {
            background-color: white;
            width: 70%;
            min-height: 50vh;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: darkblue;
            margin-bottom: 20px;
        }

        input {
            margin-bottom: 15px;
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input::placeholder{
            color: #ccc;
        }
        .login_button {
            width: 200px;
            height: 40px;
            background-color: darkblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .admin_button {
            width: 200px;
            height: 40px;
            background-color: transparent;
            color: darkblue;
            border: 2px solid darkblue;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            font-weight: bold;
        }

        button:hover {
            opacity: 0.8;
        }

        .login_button:hover {
            background-color: blue;
        }

        .admin_button:hover {
            background-color: rgba(0, 0, 139, 0.1);
        }

        p {
            color: white;
            margin-top: 15px;
        }

        a {
            color: darkblue;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #666;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ccc;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="login_container">
        <div class="container">
            <h2>Welcome</h2>
            <button class="login_button" onclick="window.location.href='customer_login.php'">Use as a customer</button>
            <button class="login_button" onclick="window.location.href='rider_login.php'">Use as a delivery driver</button>
            

            <div class="divider">OR</div>

            <button class="admin_button" onclick="window.location.href='admin_login.php'">ADMINISTRATOR</button>
        </div>
    </div>
</body>
</html>