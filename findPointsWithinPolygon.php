<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['data']!=null){
		
$point=$_POST['data'];

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql="SELECT id, ST_CONTAINS(points, ST_GEOMFROMTEXT('POINT($point)')) AS result FROM polygon HAVING result =1";

$result = $conn->query($sql);
$count = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"];
        ++$count;
    }
} else {
    echo "not found!";
}
echo " occurence ". $count;
$conn->close();
}

?>

