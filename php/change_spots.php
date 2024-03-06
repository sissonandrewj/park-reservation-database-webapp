<?php
$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zone_name'], $_POST['change_spots'])) {
    $zone_name_change = $_POST['zone_name'];
    $newSpots = $_POST['change_spots'];

    $sql = "UPDATE zone SET max_designated_spots = '$newSpots' WHERE name = '$zone_name_change'";

    if (mysqli_query($conn, $sql)) {
        echo "Spots updated successfully!";
    } else {
        echo "Error updating the spots: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
<head><link rel="stylesheet" href="./style/style.css"></head>
<br>
<button onclick="location.href='admin_view_zones.php'">Back to Admin</button>