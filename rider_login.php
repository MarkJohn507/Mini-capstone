<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Login</title>
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
        button:hover {
            opacity: 0.8;
        }

        .login_button:hover {
            background-color: blue;
        }
        p {
            color: black;
            margin-top: 15px;
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
            <h2> Rider Login</h2>
            <p id="rider_login_notification"></p>
            <form action="rider_check_accounts.php" method="post">
                <input type="text" name="username" required placeholder="Username">
                <input type="password" name="password" required placeholder="Password">
                <br><button class="login_button" name="rider_login" type="submit">Login</button>
            </form>

            <div class="divider">OR</div>

            
            <p></b>Apply now!<br><a href="rider_application.php">Click for more info</a></p>
        </div>
    </div>
    
    <?php if(isset($_GET['Invalid_password'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("rider_login_notification").style.color = "red";
            document.getElementById("rider_login_notification").innerHTML = "Wrong password, please try again!";
        });
    </script>
<?php elseif(isset($_GET['Username_not_found'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("rider_login_notification").style.color = "red";
            document.getElementById("rider_login_notification").innerHTML = "Username not found!";
        });
    </script>
<?php endif; ?>
</body>
</html>