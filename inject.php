<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

$conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query="INSERT INTO `categories`(`id`, `category`) VALUES (null,'FOOD')";
$result= $conn->query($query);

if($result){
  echo "inserted successfully";
}else {
  echo "Error inserting record: " . $conn->error;
}
$conn->close();

?>
