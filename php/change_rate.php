<?php
$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zone_name'], $_POST['date'], $_POST['change_rate'])) {
    $zone_name_change = $_POST['zone_name'];
    $date = $_POST['date'];
    $newRate = $_POST['change_rate'];

    $sql = "UPDATE rate SET rate = '$newRate' WHERE zone = '$zone_name_change' AND date = '$date'";

    if (mysqli_query($conn, $sql)) {
        echo "Rate updated successfully!";
    } else {
        echo "Error updating the rate: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
<head><link rel="stylesheet" href="./style/style.css"></head>
<br>
<button onclick="location.href='admin_view_zones.php'">Back to Admin</button>