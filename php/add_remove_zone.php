<?php
$conn = mysqli_connect("localhost", "root", "mysql", "PARKING");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zone Information</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #282c34;
            color: #61dafb;
        }

        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
        }

        th, td {
            border: 1px solid #61dafb;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #61dafb;
            color: #282c34;
        }

        tr {
            border-bottom: 1px solid #61dafb;
        }

        form {
            display: flex;
            justify-content: space-between;

        }
        form label {
            margin-right: 10px;
        }

        form input {
            margin-right: 10px;
        }

        .form-input{
            margin-right: -50px;
        }

        .form-submit{
            border: none;
            padding: 10px;
            margin-bottom: 5px;
            cursor: pointer;
            background-color: #61dafb;
            color: #282c34;
            font-size: 14px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        button {
            border: none;
            padding: 10px;
            margin-bottom: 5px;
            cursor: pointer;
            background-color: #61dafb;
            color: #282c34;
            font-size: 14px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        button:hover {
            background-color: #282c34;
            color: #61dafb;
        }

        #zonename {
            font-size: 30px;
            font-weight: bold;
        }

        #instructions {
         font-style: italic;   
         margin-top: 20px;
         font-size: 14px;
         color: lightgrey;
        }
    </style>
</head>

<body>
    
<?php

    $sql = "SELECT z.name, COUNT(*) as reservation_count 
                FROM zone z
                LEFT JOIN reservation res ON z.name= res.zone 
                WHERE res.is_cancelled = 0 AND res.date >= CURDATE()
                GROUP BY z.name";
    
    echo "<div id='zonename'>Manage Zones</div><br><br>";
    
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<table>
                    <tr>
                        <th>Zone Name</th>
                        <th>Reservations</th>
                    </tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                        <td><form action='remove_zone.php' method='post'>
                            {$row['name']}
                            <input type='hidden' value='{$row['name']}' name='zone_name'>
                            <input type='hidden' value='{$row['reservation_count']}' name='reservation_count'>
                            <input type='submit' value='Remove Zone' class='form-submit'>
                            </form>
                        </td>   
                        <td>{$row['reservation_count']}</td>
                    </tr>";
            }
            echo "</table>
            <br>
            <a href='add_zone.php'>
                <button style='background:green; color: white;'>Add Zone</button>
                </a>
                ";
     
           
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);


?>
<br>
<button onclick="location.href='admin_view_zones.php'">Back to Admin</button>
</body>

</html>
