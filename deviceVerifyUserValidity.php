<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");



$json = json_decode(file_get_contents('php://input'), true);

if(empty($json)){
		$response = "No data";
	    echo json_encode($response) ;
}
	else {
		$username =$json['username'];
	
        $conn = new mysqli(servername, dbusername, dbpassword, dbname);
        if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		$sql="SELECT username FROM users WHERE username='$username'";
		$result=$conn->query($sql);
		if($result->num_rows == 1){
			$response = "Username exists";
			echo json_encode($response) ;
		} else {
			$response = "valid username";
			echo json_encode($response) ;
		} 
		$conn->close();
}		
		
?>
    

