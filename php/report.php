<?php
$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


echo "<h1 id='zonename'> Report </h1><br><br>" . 
    
"<form action='report.php' method='post'>
     <label for='reservation_date'>Select a Date to continue: </label>
     <input type='date' id='date' name='date_one' required>
     <br><br>
     <input type='submit' value='Submit'>
 </form> 
 <br>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date_one'])) {

    $selectedDate = $_POST['date_one'];


    $sql = "SELECT 
    z.name AS zone_name,
    z.max_designated_spots,
    COUNT(r.confirmation_no) AS reservation_count,
    SUM(r.fee) AS total_revenue
    FROM 
        Zone z
    LEFT JOIN 
        Reservation r ON z.name = r.zone AND r.date = '$selectedDate'
    LEFT JOIN
        Rate rate ON z.name = rate.zone AND r.date = rate.date
    GROUP BY 
        z.name";



    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "
        <h3>Showing data for: " . $selectedDate . "</h3>
        <br>
        <h4> Total Revenue by Zone: </h4>
        <table>
                <tr>
                    <th>Zone Name</th>
                    <th>Max Designated Spots</th>
                    <th>Reservation Count</th>
                    <th>Total Revenue</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['zone_name']}</td>
                    <td>{$row['max_designated_spots']}</td>
                    <td>{$row['reservation_count']}</td>
                    <td>{$row['total_revenue']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }


    $sql = "SELECT 
    z.name AS zone_name,
    r.confirmation_no as reservation,
    r.fee AS total_fee
    FROM 
        Zone z
    LEFT JOIN 
        Reservation r ON z.name = r.zone AND r.date = '$selectedDate'
    LEFT JOIN
        Rate rate ON z.name = rate.zone AND r.date = rate.date";
    



    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "
        <br>
        <h4>All Reservations: </h4>
        <table>
                <tr>
                    <th>Zone Name</th>
                    <th>Reservation Number</th>
                    <th>Reservation Fee</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['zone_name']}</td>
                    <td>{$row['reservation']}</td>
                    <td>{$row['total_fee']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }




    mysqli_close($conn);
}
?>

<head><link rel="stylesheet" href="./style/style.css"></head>
<br>
<button onclick="location.href='admin_view_zones.php'">Back to Admin</button>