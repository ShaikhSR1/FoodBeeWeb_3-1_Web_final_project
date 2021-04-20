<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodbee";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
#echo "Connected successfully";
if (isset($_POST["query"])) {
    $varres = $_POST['query'];
    $output = "";
    $query = "SELECT * FROM `location` WHERE `location` LIKE '%$varres%'";
    $result = mysqli_query($conn, $query);
    $output = "<ul>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<li>" . $row["location"] . "</li>";
            echo $output;
        }
    } else {
        $output .= "<li>area not available</li>";
        echo $output;
    }
    $output .= '</ul>';
    
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">

    </style>
</head>

<body>

</body>

</html>l