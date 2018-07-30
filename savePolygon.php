<?php

define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$polygonInfo = $_POST['data']['polygonInfo'];
    $username=$polygonInfo[0];
	$title=$polygonInfo[1];
	$description=$polygonInfo[2];
	$startDateTime= $polygonInfo[3];
	$endDateTime=$polygonInfo[4];
	$email=$polygonInfo[5];
	$gender=$polygonInfo[6];
	$ageFrom=$polygonInfo[7];
	$ageTo=$polygonInfo[8];
	$categories=$polygonInfo[9];
	$points = $_POST['data']['polygonData'];
	$newPoints = implode(",",$points);
	$lastpoints = $points[0];


$conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO polygon (id, username, title, description, startDateTime, endDateTime, email, gender, ageFrom, ageTo, points, category) VALUES (null, '$username', '$title', '$description', '$startDateTime', '$endDateTime', '$email', '$gender', '$ageFrom', '$ageTo', PolygonFromText('POLYGON(($newPoints, $lastpoints))'), '$categories')"; 

if ($conn->query($sql) === TRUE) {
    echo "data saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
exit();

 }


?>