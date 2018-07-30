<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
if(empty($_POST['username'])){
  echo "Session error";
}
else{
  $username=$_POST['username'];

  $conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//number of active goefences
$query="SELECT (SELECT COUNT(id) FROM circle WHERE username= '$username' AND NOW() BETWEEN startDateTime AND endDateTime AND status='Active')as t_circle, (SELECT count(id) FROM polygon WHERE username= '$username' AND NOW() BETWEEN startDateTime AND endDateTime AND status='Active') as t_polygon";

$result= $conn->query($query);

if($result){
 $result = mysqli_fetch_array($result);
 //here you can echo the result of query
 echo $result['t_polygon']+$result['t_circle'];
} else{
   echo "Could not successfully run the query";
     exit;
}

$conn->close();
}

}
?>