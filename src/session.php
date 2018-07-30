<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$conn = new mysqli(servername, dbusername, dbpassword, dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['username'];
// SQL Query To Fetch Complete Information Of User
$ses_sql ="select * from signup where username='$user_check'";
$res=$conn->query($ses_sql);
$row = $res->fetch_assoc();
$login_session =$row['username'];
if(!isset($login_session)){
$conn->close(); // Closing Connection
header('Location: User-panel/login.html'); // Redirecting To Home Page
   }

?>