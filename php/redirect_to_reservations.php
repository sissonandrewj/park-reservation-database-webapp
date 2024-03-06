<?php
if(isset($_GET['submit'])) {
    if(isset($_GET['phone_number'])) {
        $phone_number = $_GET['phone_number'];
        header("Location: reservations.php?phone_number=" . urlencode($phone_number));
        exit();
    }else if(isset($_GET["confirmation_number"])) {
        $confirmation_number = $_GET["confirmation_number"];
        header("Location: reservations.php?confirmation_number=" . urlencode($confirmation_number));
        exit();
    }
}
?>
