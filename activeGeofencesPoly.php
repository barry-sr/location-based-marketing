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
		
function sql_to_coordinates($blob)
    {
        $blob = str_replace("))", "", str_replace("POLYGON((", "", $blob));
        $coords = explode(",", $blob);
        $coordinates = array();
        foreach($coords as $coord)
        {
            $coord_split = explode(" ", $coord);
            $coordinates[]=array("lat"=>$coord_split[0], "lng"=>$coord_split[1]);
        }
        return $coordinates;
    }


		$username=$_POST['username'];

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn = new mysqli(servername, dbusername, dbpassword, dbname);
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		// SQL query to fetch information of registerd users and finds user match.
		$query ="SELECT ST_AsText(ST_GeomFromWKB(ST_AsWKB(points))) as points FROM polygon WHERE username='$username' AND  NOW() BETWEEN startDateTime AND endDateTime AND status='Active'";
		$result = $conn->query($query);
		$conn->close();// Closing Connection
		$json=array();
		if($result->num_rows > 0) {
				//start xml file, create parent node
		// $dom= new DOMDocument("1.0");
		// $node = $dom->createElement("markers");
		// $parnode = $dom->appendChild($node);

		// header("Content-type: text/xml");
			//Iterate through the rows, adding XML nodes for each
			while ($row = $result->fetch_assoc()) {
			  // $node = $dom->createElement("marker");
			  // $newnode = $parnode->appendChild($node);
			  // $newnode->setAttribute("coords", sql_to_coordinates($row['points'])); 	
			  // $var = sql_to_coordinates($row['points']);	
			  // print_r($var);			

				 $json[]= $row['points'];
			}
			echo json_encode($json);
		} else {
			echo "No data";
		}
		
	 }
exit();
}
?>




<!-- SELECT ST_AsText(ST_GeomFromWKB(ST_AsWKB(points))) as points FROM polygon WHERE username='$username' AND  NOW() BETWEEN startDateTime AND endDateTime AND status='Active' -->