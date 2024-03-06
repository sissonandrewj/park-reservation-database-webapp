<?php
if (!isset($_POST["zone"]) || !isset($_POST["date"]) || !isset($_POST["rate"])) {
    exit();
}
$zone = $_POST["zone"];
$date = date("Y-m-d", strtotime($_POST["date"]));
$rate = $_POST["rate"];

echo "<form action='process_reservation.php' method='post' id='details'>
    <label for='fname'>First Name:</label>
    <input type='text' id='fname' name='fname' required>
    <br><br>
    <label for='lname'>Last Name:</label>
    <input type='text' id='lname' name='lname' required>
    <br><br>
    <label for='phone_number'>Phone Number:</label>
    <input type='text' id='phone_number' name='phone_number' required>
    <br><br>
    <label for='hour'>Hours:</label>
    <input type='number' id='hour' name='hour' min='1' max='24' required>
    <br><br>
    <input type='hidden' name='rate' value='{$rate}'>
    <input type='hidden' name='zone' value='{$zone}'>
    <input type='hidden' name='date' value='{$date}'>
    <button type='submit' name='process_reservation'>Submit</button>";
?>
<head><link rel="stylesheet" href="./style/style.css"></head>