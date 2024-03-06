<?php
$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zone Information</title>
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

        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
        }

        th, td {
            border: 1px solid #61dafb;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #61dafb;
            color: #282c34;
        }

        tr {
            border-bottom: 1px solid #61dafb;
        }

        form {
            display: flex;
            justify-content: space-between;
        }

        .form-input{
            margin-right: -50px;
        }

        .form-submit{
            border: none;
            padding: 10px;
            margin-bottom: 5px;
            cursor: pointer;
            background-color: #61dafb;
            color: #282c34;
            font-size: 14px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        button {
            border: none;
            padding: 10px;
            margin-bottom: 5px;
            cursor: pointer;
            background-color: #61dafb;
            color: #282c34;
            font-size: 14px;
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
    <?php
    $sql = "SELECT name, max_designated_spots FROM zone";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<table>
                <tr>
                    <th>Zone Name</th>
                    <th>Max Designated Spots</th>
                    <th>Actions</th>
                </tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td><form action='change_spots.php' method='post'>
                            <input value='{$row['max_designated_spots']}' name='change_spots' class='form-input' required>
                            <input type='hidden' name='zone_name' value='{$row['name']}'>
                            <input type='submit' value='Change Spot Count' class='form-submit'>
                            </form>
                        </td>
                    <td>
                        <form method='post' action='view_rates_reservations.php'>
                            <input type='hidden' name='zone_name' value='{$row['name']}'>
                            <button type='submit'>Manage Rates & View Reservations</button>
                        </form>
                    </td>
                </tr>";
        }
        echo "</table> 
        <br><br>
        <form method='post' action='add_remove_zone.php'>
                            <input type='hidden' name='zone_name'>
                            <button type='submit' style='background:green; color: white;'>Add/Remove Zone</button>
                        </form>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>


</body>
<button style="background: grey; color:white" onclick="location.href='report.php'">View Report</button>
<br>
<button onclick="location.href='index.php'">Back to Home</button>

</html>
