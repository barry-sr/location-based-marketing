<?php

define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

$json = json_decode(file_get_contents('php://input'), true);

if(empty($json)){
		$response = "No data";
		echo json_encode($response);
} else {

	// Define $username and $password
	$username=$json['username'];
	$password=$json['password'];
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$conn = new mysqli(servername, dbusername, dbpassword, dbname);
	if (!$conn) {
	   die("Connection failed: " . mysqli_connect_error());
	}

	//To protect MySQL injection for Security purpose
    $username= stripslashes($username);
    $password= stripslashes($password);
    $username = mysqli_real_escape_string($conn,$username);
    $password = mysqli_real_escape_string($conn, $password);

    // SQL query to fetch information of registerd users and finds user match.

	$query="select username, password, gender, (YEAR(CURDATE())-YEAR(bdate)) AS age, category  from users where username='$username'";
	$result = $conn->query($query);
	if($result->num_rows ==1){
		$row= $result->fetch_assoc();
		$hashed_password = $row["password"];
		// echo json_encode($row);
		// echo json_encode($hashed_password);
		if(password_verify($password, $hashed_password)){
			$myobj->username= $row["username"];
			$myobj->gender= $row["gender"];
			$myobj->age = $row["age"];
			$myobj->category = $row["category"];
			echo json_encode($myobj);
		} else {
			$error="Username or Password is invalid";
			echo json_encode($error);
		}
	} else {
		$error="Username or Password is invalid";
		echo json_encode($error);
	}
$conn->close();// Closing Connection
}

?>