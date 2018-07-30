<?php

define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$data =$_POST['data'];
	$username=$data[0];
	$title=$data[1];
	$description=$data[2];
	$startDateTime= $data[3];
	$endDateTime=$data[4];
	$email=$data[5];
	$gender=$data[6];
	$ageFrom=$data[7];
	$ageTo=$data[8];
	$lat=$data[9];
	$lng=$data[10];
	$radiusInKm=$data[11];
	$categories=$data[12];

$conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO circle (id, username, title, description, startDateTime, endDateTime, email, gender, ageFrom, ageTo, lat, lng, radius, category) 
VALUES (null, '$username', '$title', '$description', '$startDateTime', '$endDateTime', '$email', '$gender', '$ageFrom', '$ageTo', '$lat', '$lng', '$radiusInKm', '$categories')"; 

if ($conn->query($sql) === TRUE) {
    echo "data saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
exit();

}


?>



