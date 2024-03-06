<?php
$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zone_name'], $_POST)) {

    $zone_to_remove = $_POST['zone_name'];
    $reservation_count = $_POST['reservation_count'];

    if ($reservation_count == 0) {
        $sql = "DELETE FROM zone WHERE name='$zone_to_remove'";
        if ($conn->query($sql) === TRUE) {
            echo "Zone removed successfully!";
        } else {
            echo "Error removing the zone: " . $conn->error;
        }
     } else {
        echo "Cannot remove this zone because there is a reservation!";
     }
}

mysqli_close($conn);

?>
<head><link rel="stylesheet" href="./style/style.css"></head>
<button onclick="location.href='admin_view_zones.php'">Back to Admin</button>

             