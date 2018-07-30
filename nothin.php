<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

// if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
// if(empty($_POST['username'])){
//   echo "Session error";
// }
// else{
 // $username=$_POST['username'];


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



  $conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query ="SELECT ST_AsText(ST_GeomFromWKB(ST_AsWKB(points))) as points FROM polygon WHERE username='mb' AND  NOW() BETWEEN startDateTime AND endDateTime AND status='Active'";
		$result = $conn->query($query);
		$conn->close();// Closing Connection
		

		if($result->num_rows > 0) {
		// start xml file, create parent node
		// $dom= new DOMDocument("1.0");
		// $node = $dom->createElement("markers");
		// $parnode = $dom->appendChild($node);

		// header("Content-type: text/xml");
			// Iterate through the rows, adding XML nodes for each
			while ($row = $result->fetch_assoc()) { 
			   $var = sql_to_coordinates($row['points']);		
			}
			echo $var;
			// foreach ($var as $key => $value) {
			//   // $node = $dom->createElement("marker");
			//   // $newnode = $parnode->appendChild($node);
			//   // $newnode->setAttribute("lat",$value['lat']);
			//   // $newnode->setAttribute("lng",$value['lng']); 
			// }
		 // // echo $dom->saveXML();

}
?>

