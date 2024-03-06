<?php
if (isset($_POST['reservation_date'])) {
    $date = $_POST['reservation_date'];
    $tomorrow = date('Y-m-d', strtotime('+1 day'));
    if ($date < $tomorrow) {
        echo 'Reservation date must be at least 1 day in advance.';
        exit();
    }

    $conn = mysqli_connect('localhost', 'root', 'mysql', 'PARKING');
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $date = $_POST['reservation_date'];

    echo "<form action='show_available_spots.php' method='POST'>
        <label for='venue'>Select A Venue And Check Distance:</label>
        <input type='text' id='venue' name='venue'>
        <input type='hidden' name='reservation_date' value='{$date}'>
        <button type='submit' name='submit'>Check</button>
        </form>";

    if (isset($_POST['venue'])) {
        $venue = $_POST['venue'];
        
        $sql = "with Spots_taken(zone, count) as 
            (select zone, count(*) from reservation where date = '$date' and is_cancelled = 0 group by zone)
        select Z.name, R.rate, Z.max_designated_spots - ifnull(count, 0) as available_spots, D.miles
        from Zone as Z inner join Rate as R on Z.name = R.zone and R.date = '$date' inner join Distance as D on Z.name = D.zone
        left join Spots_taken as S on Z.name = S.zone
        where Z.max_designated_spots - ifnull(count, 0) > 0 and D.venue = '$venue' order by D.miles";

        $result = mysqli_query($conn, $sql);
        if ($result && $result->num_rows > 0) {
            echo "<table>
            <tr>
                <th>Zone</th>
                <th>Available Spots</th>
                <th>Rates</th>
                <th>Distance(miles)</th>
                <th>Make Reservation</th>
            </tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['available_spots']}</td>
                <td>{$row['rate']}</td>
                <td>{$row['miles']}</td>
                <td><form action='enter_reservation_details.php' method='post'>
                <input type='hidden' name='zone' value='{$row['name']}'>
                <input type='hidden' name='rate' value='{$row['rate']}'>
                <input type='hidden' name='date' value='{$date}'>
                <button type='submit' name='enter_reservation_details'>Choose</button>
                </form></td>
            </tr>";
            }
            echo '</table>';
        } else {
            echo 'No available spots for this date!';
        }
    } else {
        $sql = "with Spots_taken(zone, count) as 
            (select zone, count(*) from reservation where date = '$date' and is_cancelled = 0 group by zone)
        select Z.name, R.rate, Z.max_designated_spots - ifnull(count, 0) as available_spots
        from Zone as Z inner join Rate as R on Z.name = R.zone and R.date = '$date' left join Spots_taken as S on Z.name = S.zone
        where Z.max_designated_spots - ifnull(count, 0) > 0";

        $result = mysqli_query($conn, $sql);
        if ($result && $result->num_rows > 0) {
            echo "<table>
            <tr>
                <th>Zone</th>
                <th>Available Spots</th>
                <th>Rates</th>
                <th>Make Reservation</th>
            </tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['available_spots']}</td>
                <td>{$row['rate']}</td>
                <td><form action='enter_reservation_details.php' method='post'>
                <input type='hidden' name='zone' value='{$row['name']}'>
                <input type='hidden' name='rate' value='{$row['rate']}'>
                <input type='hidden' name='date' value='{$date}'>
                <button type='submit' name='enter_reservation_details'>Choose</button>
                </form></td>
            </tr>";
            }
            echo '</table>';
        } else {
            echo 'No available spots for this date!';
        }
    }
    echo "<br><button onclick='location.href=\"make_reservation.php\"'>Back</button>";

    mysqli_close($conn);
}
?>

<head><link rel="stylesheet" href="./style/style.css"></head>
