<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
if(empty($_POST['id'])){
  echo "Session error";
}
else{
  $id=$_POST['id'];

  $conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//details of all geofence
$query="SELECT id, datediff(endDateTime, startDateTime) as days, status FROM polygon WHERE id='$id' AND status='Active' Having days > 0";

$result= $conn->query($query);

if ($result->num_rows > 0) {
  $updatequery= "UPDATE polygon SET status='Paused' WHERE id='$id'";
      if ($conn->query($updatequery) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

} else{

      $updatequery2= "UPDATE polygon SET status='Active' WHERE id='$id'";
      if ($conn->query($updatequery2) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
     exit;
}

$conn->close();
}

}
?>
