<!DOCTYPE html>
<html>

<head>
    <title>CityParking</title>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            margin-bottom: 10px;
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

        button {
            width: 200px;
            border: none;
            padding: 15px 32px;
            text-align: center;
            cursor: pointer;
            background-color: #61dafb;
            color: #282c34;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        button:hover {
            background-color: #282c34;
            color: #61dafb;
        }
    </style>
</head>

<body>
    <form action="redirect_to_reservations.php" method="GET">
        <label for="phone_number">Enter Your Phone Number (xxx-xxx-xxxx):</label>
        <input type="text" id="phone_number" name="phone_number" required>
        <button type="submit" name="submit">Submit</button>
        <p>(e.g. 123-456-7890)</p>
    </form>

    <p>Or</p>

    <form action="redirect_to_reservations.php" method="GET">
        <label for="confirmation_number">Enter Your Confirmation Number:</label>
        <input type="text" id="confirmation_number" name="confirmation_number" required>
        <button type="submit" name="submit">Submit</button>
    </form>

    <br><br>
    <button onclick="location.href='index.php'">Back to Home</button>
</body>

</html>
