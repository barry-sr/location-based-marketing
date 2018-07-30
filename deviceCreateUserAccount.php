<?php

define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

$json = json_decode(file_get_contents('php://input'), true);

$username = $json['username'];
$password = $json['password'];

// Establishing Connection with Server by passing server_name, user_id and password as a parameter

$conn = new mysqli(servername, dbusername, dbpassword, dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn, $password);
// SQL query to fetch information of registerd users and finds user match.
// $query ="select username from signup where password='$password' AND username='$username'";
$query="select username, gender, (YEAR(CURDATE())-YEAR(bdate)) AS age from users where password='$password' AND username='$username'";
$result = $conn->query($query);

if($result->num_rows == 1) {

$row= $result->fetch_assoc();	
echo json_encode($row); 

} else {
	$error="Username or Password is invalid";
echo json_encode($error);
}
$conn->close();// Closing Connection

exit();

?>
