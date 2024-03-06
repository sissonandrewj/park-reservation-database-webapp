<!DOCTYPE html>
<html>

<head><link rel="stylesheet" href="./style/style.css"></head>
<body>
<br>
<form action="show_available_spots.php" method="post">
    <label for="reservation_date">Select Reservation Date:</label>
    <input type="date" id="reservation_date" name="reservation_date" required>
    <br><br>
    <input type="submit" value="Make Reservation">
</form>
<br>
<button onclick="location.href='index.php'">Back to Home</button>
</body>
</html>