<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "mydb");

$json = json_decode(file_get_contents('php://input'), true);

$lat = $json['lat'];
$lng = $json['lng'];
$username= $json['username'];
$age= $json['age'];
$gender= $json['gender'];


$conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql="SELECT id, username, email, ( 6371 * acos ( cos ( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin ( radians($lat) ) * sin( radians( lat ) ) ) ) < radius AS result FROM circle WHERE  NOW() BETWEEN startDateTime AND endDateTime AND age >='$age' AND gender='$gender' Having result=1";

$result = $conn->query($sql);
$count = 0;
$arrayofData=array();

if ($result->num_rows > 0) {
    //output data of each row
  while ($row = $result->fetch_assoc()) {
    echo "id:".$row['id']." ";
     array_push($arrayofData, $row);
     ++$count;
  }       
echo " occurence ".$count.' ';

foreach ($arrayofData as $key => $value) {
  //query to update status to inside in the tractusers table
  $query="INSERT INTO trackusers (id, creator, latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['username']}', ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['id']}, 'INSIDE', NOW() )";
  $result=$conn->query($query);
  if (!$result) {
     echo "Could not successfully run query ($result) from DB: " . mysqli_error($conn);
     exit;
      }

   //save tracked user's data into activegeo table
  $query2="INSERT INTO activegeofence (id, creator, latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['username']}', ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['id']}, 'INSIDE', NOW()) ON DUPLICATE KEY UPDATE dateTime=NOW()";
  $result2=$conn->query($query2);
  if (!$result2) {
     echo "Could not successfully run query ($result2) from DB: " . mysqli_error($conn);
     exit;
      }

$mail = new PHPMailer(); 
try {
    //Server settings
    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mbbarry91@gmail.com';                 // SMTP username
    $mail->Password = 'bienvenumb1';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('suport@plot.com', 'Plot');
    $mail->addAddress("{$value['email']}", 'Barry');     // Add a recipient
    // $mail->addAddress('mbbarry91@gmail.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //date
    $datetime=date('D, d M Y H:i:s');
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'User just entered your geofence';
    $mail->Body    = "<H1>Bellow are the details</H1><br>". 
                     "Geofence Name: {$value['username']}"."<br>".              
                     "User Entered: $username"."<br>". 
                     "Time: $datetime <br>";
    $mail->AltBody ='This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

 unset($arrayofData);
}
      

} else {
  //check the users inside the active goefen 
  $query="SELECT * FROM activegeofence where id='$username'";
  $resultquery= $conn->query($query);
  $arrayofgeofences = array();
  if($resultquery->num_rows > 0){
    while ($row= $resultquery->fetch_assoc()) {
      array_push($arrayofgeofences, $row);
      //print_r($row);
    }
  //update status exit  
  foreach ($arrayofgeofences as $key=> $value) {
    $trackquery2="INSERT INTO trackusers (id, creator, latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['creator']}', ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['geofence_id']}, 'EXIT', NOW())";
       $trackresult2 = $conn->query($trackquery2);
       if (!$trackresult2) {
           echo "Could not successfully run query ($trackresult2) from DB: " . mysqli_error($conn);
          exit;
             }
     
          unset($arrayofgeofences);
  }

 //delete row in the table
//$trackquery2="DELETE FROM activegeofence WHERE EXISTS( SELECT * FROM trackusers Where activegeofence.id = trackusers.id)";
  $trackquery2="DELETE FROM activegeofence WHERE id='$username'";
     $trackresult2 = $conn->query($trackquery2);
     unset($arrayofgeofences);
     if (!$trackresult2) {
         echo "Could not successfully run query ($trackresult2) from DB: " . mysqli_error($conn);
        exit;
           }

  
} else{
  //update status to no geofence
  $trackquery2="INSERT INTO trackusers (id, latLng, status, dateTime) VALUES ('$username', ST_GEOMFROMTEXT('POINT($lat $lng)'), 'NO GEOFENCE', NOW())";
       $trackresult2 = $conn->query($trackquery2);
       if (!$trackresult2) {
           echo "Could not successfully run query ($trackresult2) from DB: " . mysqli_error($conn);
          exit;
             }
}

 echo "not found!";
}

$conn->close();


?>

