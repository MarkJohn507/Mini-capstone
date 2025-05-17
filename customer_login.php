<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: orange;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login_container {
            background-color: orange;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .container {
            background-color: white;
            width: 50%;
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
            width: 100px;
            height: 40px;
            background-color: darkblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .guest_button {
            width: 150px;
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

        .guest_button:hover {
            background-color: rgba(0, 0, 139, 0.1);
        }

        p {
            color: black;
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
            <h2> Customer Login</h2>
            <p id="login_notification"></p>
            <form action="customer_check_accounts.php" method="post">
                <input type="text" name="customer_username" required placeholder="Username">
                <input type="password" name="customer_password" required placeholder="Password">
                <br><button class="login_button" name="customer_login" type="submit">Login</button>
            </form>
            <div class="divider">OR</div>

            <button class="guest_button" onclick="window.location.href='user_homepage.php'">continue as Guest</button>
            
            <p>Don't have an account? <a href="customer_register.php">Register here</a></p>
        </div>
    </div>

    <?php if(isset($_GET['Invalid_password'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("login_notification").style.color = "red";
            document.getElementById("login_notification").innerHTML = "Wrong password, please try again!";
        });
    </script>
<?php elseif(isset($_GET['Username_not_found'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("login_notification").style.color = "red";
            document.getElementById("login_notification").innerHTML = "Username not found!";
        });
    </script>
<?php endif; ?>
</body>
</html>