<?php
if (isset($_POST['cancel_reservation'])) {
    $confirmation_no = $_POST['confirmation_no'];

    $conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE reservation SET is_cancelled = 1 WHERE confirmation_no = '$confirmation_no'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "<p style='color: red;'>Could not cancel reservation: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
?>
