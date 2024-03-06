<?php
if(!isset($_POST["fname"]) || !isset($_POST["lname"]) || !isset($_POST["phone_number"]) || !isset($_POST["hour"]) || !isset($_POST["rate"]) || !isset($_POST["zone"]) || !isset($_POST["date"])) {
    exit();
}
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$phone_number = $_POST["phone_number"];
$hour = $_POST["hour"];
$rate = $_POST["rate"];
$zone = $_POST["zone"];
$date = date("Y-m-d", strtotime($_POST["date"]));

$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select * from Customer where phone_no = '$phone_number'";
if (mysqli_query($conn, $sql)->num_rows == 0) {
    $sql = "insert into Customer values ('$phone_number', '$fname', '$lname')";
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }
}

$sql = "select * from Reservation where phone_no = '$phone_number' and date = '$date'";
if (mysqli_query($conn, $sql)->num_rows > 0) {
    echo "You have already made a reservation for this date.";
    exit();
}

$fee = floatval($hour) * floatval($rate);
$confirmation_no = substr(md5(uniqid(rand(), true)), 0, 8);
$sql = "insert into Reservation (confirmation_no, phone_no, zone, date, fee) values ('$confirmation_no', '$phone_number', '$zone', '$date', '$fee')";
if (mysqli_query($conn, $sql)) {
    echo "Reservation made successfully.";
} else {
    echo "Failed to make reservation: " . mysqli_error($conn);
}
echo "<br><br>Confirmation Number: " . $confirmation_no;
echo "<br><button onclick='location.href=\"index.php\"'>Back to Home</button>";

mysqli_close($conn);
?>
<head><link rel="stylesheet" href="./style/style.css"></head>