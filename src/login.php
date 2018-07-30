<?php

define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST['username']) || empty($_POST['password'])) {
echo "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
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
$query="select username, password, (YEAR(CURDATE())-YEAR(b_date)) AS age,  gender   from signup where username='$username'";
$result = $conn->query($query);
if($result->num_rows == 1) {
	$row= $result->fetch_assoc();
	$hashed_password= $row["password"];
	if(password_verify($password,$hashed_password)){
		$_SESSION["logged_in"]=true;
		$_SESSION["username"]=$username; // Initializing Session
		$_SESSION["age"]=$row["age"];
		$_SESSION["gender"]=$row["gender"];
		echo "you are logged in";
	} else {
        echo "Username or Password is invalid";
    }	
} else {
    echo "Username or Password is invalid";
}

$conn->close();// Closing Connection

}

}
?>