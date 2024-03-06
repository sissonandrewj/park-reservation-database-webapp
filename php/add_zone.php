<?php
$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zone_name'], $_POST['spots'])) {

    $zone_name_change = $_POST['zone_name'];
    $newSpots = (int)$_POST['spots'];

    $sql = "INSERT INTO zone (name, max_designated_spots) values ('$zone_name_change', '$newSpots')";

    if (mysqli_query($conn, $sql)) {
        echo "Zone created successfully!";
    } else {
        echo "Error updating spots: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
<head><link rel="stylesheet" href="./style/style.css"></head>
<h1>Create a new zone:</h1>
<br>
    <form action='add_zone.php' method='post'>
        <label>Zone Name: </label>
        <input name='zone_name'>
        <label>Designated Spots: </label>
        <input name='spots'>
        <input type='submit' value='Add Zone' class='form-submit'>
    </form>
              
    <br>
<button onclick="location.href='admin_view_zones.php'">Back to Admin</button>

             