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

//details of all geofence
$query="SELECT id, creator, type, geofence_id, dateTime FROM trackusers WHERE creator='$username' AND status ='INSIDE'";

$result= $conn->query($query);
$arrayofData=array();

if ($result->num_rows > 0) {
    //output data of each row
  while ($row = $result->fetch_assoc()) {
     array_push($arrayofData, $row);
  }
    echo json_encode($arrayofData);
} else{
  echo json_encode($arrayofData);
}

$conn->close();
}

}
?>