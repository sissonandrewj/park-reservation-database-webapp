<?php
if (isset($_GET['phone_number']) || isset($_GET['confirmation_number'])) {
    $conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['phone_number'])) {
        $phone_no = $_GET['phone_number'];

        $sql = "select * from Customer where phone_no = '$phone_no'";
        if (mysqli_query($conn, $sql)->num_rows == 0) {
            echo "No user with phone number $phone_no found.";
            exit();
        }

        $sql = "select concat(u.fname, ' ', u.lname) as name, r.phone_no, r.zone, r.date, r.fee, 
        r.confirmation_no, if(r.is_cancelled = 1, 'Cancelled', '') as status
        from reservation as r join customer as u on r.phone_no = u.phone_no
        where r.phone_no = '$phone_no' order by r.date asc";
    } else {
        $confirmation_no = $_GET['confirmation_number'];

        $sql = "select * from Reservation where confirmation_no = '$confirmation_no'";
        if (mysqli_query($conn, $sql)->num_rows == 0) {
            echo "No reservation with confirmation number $confirmation_no found.";
            exit();
        }

        $sql = "select concat(u.fname, ' ', u.lname) as name, r.phone_no, r.zone, r.date, r.fee, 
        r.confirmation_no, if(r.is_cancelled = 1, 'Cancelled', '') as status
        from reservation as r join customer as u on r.phone_no = u.phone_no
        where r.confirmation_no = '$confirmation_no' order by r.date asc";
    }

    $result = mysqli_query($conn, $sql);
    if ($result) {
        date_default_timezone_set("America/New_York");
        $current_date = strtotime(date('Y-m-d'));
        $three_days_in_seconds = 3 * 24 * 60 * 60;
        echo "<table>
            <tr>
                <th>Confirmation#</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Zone</th>
                <th>Date</th>
                <th>Fee</th>
                <th>Status</th>
            </tr>";
        while ($row = mysqli_fetch_array($result)) {
            $reservation_date = strtotime($row['date']);
            echo "<tr>
                <td>{$row['confirmation_no']}</td>
                <td>{$row['name']}</td>
                <td>{$row['phone_no']}</td>
                <td>{$row['zone']}</td>
                <td>{$row['date']}</td>
                <td>{$row['fee']}</td>
                <td>";
            if ($row['status'] == 'Cancelled') {
                echo 'Cancelled';
            } else if ($reservation_date - $current_date >= $three_days_in_seconds) {
                echo "<form action='cancel_reservation.php' method='post'>
                <input type='hidden' name='confirmation_no' value='{$row['confirmation_no']}'>
                <button type='submit' name='cancel_reservation'>Cancel</button>
              </form>";
            } else if ($reservation_date < $current_date) {
                echo 'Completed';
            } else {
                echo 'Active';
            }
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Error querying: " . mysqli_error($conn);
    }
    echo "<br><button onclick='location.href=\"view_reservation.php\"'>Back</button>";

    mysqli_close($conn);
}
?>
