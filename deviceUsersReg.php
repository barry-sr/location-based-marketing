<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");


$json = json_decode(file_get_contents('php://input'), true);

	if(empty($json)){
		$response = "No data";
		echo json_encode($response);
	}
	else {

		$username =$json['username'];
	    $password = $json['password'];
	    $email=$json['emailAddress'];
	    $gender= $json['gender'];
	    $bdate= $json['dateOfBirth'];
	    $categories=$json['categories'];

	    $conn = new mysqli(servername, dbusername, dbpassword, dbname);
        if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		//To protect MySQL injection for Security purpose
	    $username= stripslashes($username);
	    $email= stripslashes($email);
	    $password= stripslashes($password);
	    $bdate= stripslashes($bdate);
	    $gender= stripslashes($gender);
	    $categories= stripcslashes($categories);
	    $username = mysqli_real_escape_string($conn,$username);
	    $email = mysqli_real_escape_string($conn,$email);
	    $password = mysqli_real_escape_string($conn,$password);
	    $hashed_password= password_hash($password, PASSWORD_DEFAULT);
	    $bdate = mysqli_real_escape_string($conn,$bdate);
	    $vlid_bdate= date('Y-m-d', strtotime($bdate));
	    $gender = mysqli_real_escape_string($conn,$gender);
	    $categories= mysqli_real_escape_string($conn, $categories);

	    $sql = "INSERT INTO users (id, username, password, email, gender, bdate, category) VALUES (null, '$username','$hashed_password', '$email', '$gender', '$vlid_bdate', '$categories')";

		if ($conn->query($sql) === TRUE) {
			$response = "User created!";
		    echo json_encode($response);
		} else {
		    echo json_encode($conn->error);
		}
		$conn->close();




}
		
?>
    

