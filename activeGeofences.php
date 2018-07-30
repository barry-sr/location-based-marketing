<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST['username'])) {
		echo "Session error";
	}
	else
		{
		
		$username=$_POST['username'];

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn = new mysqli(servername, dbusername, dbpassword, dbname);
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		// SQL query to fetch information of registerd users and finds user match.
		$query ="SELECT lat, lng, radius FROM circle WHERE username='$username' AND  NOW() BETWEEN startDateTime AND endDateTime AND status='Active'";
		$result = $conn->query($query);
		$conn->close();// Closing Connection
		

		if($result->num_rows > 0) {
				//start xml file, create parent node
		$dom= new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);

		header("Content-type: text/xml");
			//Iterate through the rows, adding XML nodes for each
			while ($row = $result->fetch_assoc()) {
			  $node = $dom->createElement("marker");
			  $newnode = $parnode->appendChild($node);
			  $newnode->setAttribute("lat", $row['lat']);
			  $newnode->setAttribute("lng", $row['lng']);
			  $newnode->setAttribute("radius", $row['radius']); 
								
			}
		echo $dom->saveXML();

		} else {
			echo "No data";
		}
		
	 }
exit();
}
?>