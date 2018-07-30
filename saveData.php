<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$data =$_POST['data'];
	$points =  implode(",",$data);
	$lastpoints = $data[0];
	//echo $points;
	print_r($points);
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO polygon (id, points) VALUES (null, PolygonFromText('POLYGON(($points, $lastpoints))'))"; 

if ($conn->query($sql) === TRUE) {
    echo "data saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
exit();

}


?>