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


//number of users in  active goefences
$query1="SELECT (SELECT COUNT(geofence_id) from trackusers JOIN circle ON (trackusers.geofence_id=circle.id) WHERE circle.username='$username' AND NOW() BETWEEN circle.startDateTime AND circle.endDateTime AND trackusers.status='INSIDE') as t_circle, (SELECT COUNT(geofence_id) from trackusers JOIN polygon ON (trackusers.geofence_id=polygon.id) WHERE polygon.username='$username' AND NOW() BETWEEN polygon.startDateTime AND polygon.endDateTime AND trackusers.status='INSIDE') as t_poly";
$result1= $conn->query($query1);

if($result1){
 $result1 = mysqli_fetch_array($result1);
 //here you can echo the result of query
 echo $result1['t_poly']+$result1['t_circle'];
} else{
   echo "Could not successfully run query";
     exit;
}


$conn->close();
}


}
?>