<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");


function validateUser($username){
	$conn = new mysqli(servername, dbusername, dbpassword, dbname);
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql="SELECT * FROM signup WHERE username='$username'";
		$result=$conn->query($sql);
		if($result->num_rows > 0){
			return true;
		}
		else {
			return false;
		}
	$conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty($_POST['username']) || empty($_POST['password'])){
		echo "Username or Password is invalid";
	}
	else{
		$username =$_POST['username'];
	    $email=$_POST['email'];
	    $password = $_POST['password'];
	    $bdate= $_POST['bdate'];
	    $gender= $_POST['gender'];

   		if(validateUser("$username")){
   			echo "Username exists!";
	   		}
	   		else {
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
				    $username = mysqli_real_escape_string($conn,$username);
				    $email = mysqli_real_escape_string($conn,$email);
				    $password = mysqli_real_escape_string($conn,$password);
				    $hashed_password= password_hash($password, PASSWORD_DEFAULT);
				    $bdate = mysqli_real_escape_string($conn,$bdate);
				    $gender = mysqli_real_escape_string($conn,$gender);

					$sql = "INSERT INTO signup (id, username, email, password, b_date, gender) VALUES (null, '$username', '$email', '$hashed_password', '$bdate', '$gender')"; 

					if ($conn->query($sql) === TRUE) {
					    echo "User created!";
					    //header("Location: ../User-panel/login.html"); // Redirecting To login Page
					} else {
					    echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
			}
    }
}
    

?>