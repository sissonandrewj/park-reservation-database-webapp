<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #282c34;
            color: #61dafb;
        }

        h2 {
            color: #61dafb;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            margin-bottom: 10px;
            color: #61dafb;
        }

        input {
            width: 200px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #61dafb;
            border-radius: 5px;
            background-color: #282c34;
            color: #61dafb;
        }

        input[type="submit"] {
            cursor: pointer;
            background-color: #61dafb;
            color: #282c34;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            border: none;
            border-radius: 5px;
            padding: 15px 32px;
        }

        input[type="submit"]:hover {
            background-color: #282c34;
            color: #61dafb;
        }

        p {
            color: red;
        }
    </style>
</head>

<body>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = "admin";
        $password = "admin123";

        $input_username = $_POST["username"];
        $input_password = $_POST["password"];

        if ($input_username === $username && $input_password === $password) {

            header("Location: admin_view_zones.php");
            exit();
        } else {
            echo "<p>Invalid Username and Password Combination. Try Again!</p>";
        }
    }
    ?>

    <h2>Admin Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>

</body>

</html>
