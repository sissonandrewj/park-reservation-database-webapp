
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
        form label {
            margin-right: 10px;
        }

        form input {
            margin-right: 10px;
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

        #zonename {
            font-size: 30px;
            font-weight: bold;
        }

        #instructions {
         font-style: italic;   
         margin-top: 20px;
         font-size: 14px;
         color: lightgrey;
        }
    </style>
</head>

<body>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zone_name'])) {

    $zone_name = $_POST['zone_name'];
    $date = 0;

    if (isset($_POST['date_one']) && $_POST['date_two'] === "") {
        $date_one = $_POST['date_one'];
        $date_two = $_POST['date_two'];
        $sql = "SELECT r.zone, r.date, r.rate, COUNT(res.confirmation_no) as reservation_count 
                FROM rate r
                LEFT JOIN reservation res ON r.zone = res.zone AND r.date = res.date
                WHERE r.zone = '$zone_name' AND r.date = '$date_one'
                GROUP BY r.zone, r.date, r.rate";
    }elseif (isset($_POST['date_one']) && isset($_POST['date_two']) ){
        $date_one = $_POST['date_one'];
        $date_two = $_POST['date_two'];
        $sql = "SELECT r.zone, r.date, r.rate, COUNT(res.confirmation_no) as reservation_count 
                FROM rate r
                LEFT JOIN reservation res ON r.zone = res.zone AND r.date = res.date
                WHERE r.zone = '$zone_name' AND r.date BETWEEN '$date_one' AND '$date_two'
                GROUP BY r.zone, r.date, r.rate"; 
     } else {
            $sql = "SELECT r.zone, r.date, r.rate, COUNT(res.confirmation_no) as reservation_count 
                    FROM rate r
                    LEFT JOIN reservation res ON r.zone = res.zone AND r.date = res.date
                    WHERE r.zone = '$zone_name'
                    GROUP BY r.zone, r.date, r.rate";
        }

    echo "<div id='zonename'> Zone Name: " . $zone_name . "</div><br><br>" . 
    
   "<form action='view_rates_reservations.php' method='post'>
        <label for='reservation_date'>View by Date: </label>
        <input type='hidden' name='zone_name' value='$zone_name'> 
        <input type='date' id='date' name='date_one' required>
        <input type='date' id='date' name='date_two'>
        <br><br>
        <input type='submit' value='View Date'>
    </form>
    <div id='instructions'> Select one date OR a date range </div>
    
    <br>";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<table>
                    <tr>
                        <th>Zone Name</th>
                        <th>Date</th>
                        <th>Rate</th>
                        <th>Reservations</th>
                    </tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                        <td>{$row['zone']}</td>
                        <td>{$row['date']}</td>
                        <td><form action='change_rate.php' method='post'>
                            <input value='{$row['rate']}' name='change_rate' class='form-input' required>
                            <input type='hidden' name='zone_name' value='{$row['zone']}'>
                            <input type='hidden' name='date' value='{$row['date']}'>
                            <input type='submit' value='Change Rate' class='form-submit'>
                            </form>
                        </td>   
                        <td>{$row['reservation_count']}</td>

                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);

} else {
    echo "Invalid Form!";
}
?>
<br>
<button onclick="location.href='admin_view_zones.php'">Back to Admin</button>
</body>

</html>