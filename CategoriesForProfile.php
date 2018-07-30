<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

$conn = new mysqli(servername, dbusername, dbpassword, dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query="SELECT * FROM categories";
$result = $conn->query($query);
$data=array();
if($result) {
	while($row= $result->fetch_assoc()){
		 array_push($data, $row);
	}
	echo json_encode($data);
} else {
	$error="No data";
	echo json_encode($error);
}
$conn->close();// Closing Connection
?>