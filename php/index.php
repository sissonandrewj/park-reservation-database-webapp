<!DOCTYPE html>
<html>

<head>
    <title>Parking Reservation System</title>
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

        h1 {
            color: #61dafb;
            text-align: center;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 80%;
            max-width: 800px;
            margin-top: 20px;
        }

        button {
            width: 100%;
            border: none;
            padding: 15px;
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

        table {
            margin-top: 20px;
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px solid #61dafb;
        }
    </style>
</head>

<body>
    <h1>Parking Reservation System</h1>
    <div class="dashboard">
        <button type="button" onclick="location.href='admin_login.php'">Login as admin</button>
        <button type="button" onclick="location.href='make_reservation.php'">Make a reservation</button>
        <button type="button" onclick="location.href='view_reservation.php'">Look up reservations</button>
    </div>
</body>

</html>
