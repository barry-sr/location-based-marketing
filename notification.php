<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

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
$category= $json['category'];


$response=array();

function findPointsInsideCircle($lat, $lng, $username, $age, $gender, $category){


$conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
// $sql="SELECT id, username, email, type, ( 6371 * acos ( cos ( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin ( radians($lat) ) * sin( radians( lat ) ) ) ) < radius AS result FROM circle WHERE  NOW() BETWEEN startDateTime AND endDateTime AND status='Active' AND ageFrom <='$age' AND ageTo >='$age' AND gender='$gender' Having result=1";

       
$sql="SELECT id, username, email, type, ( 6371 * acos ( cos ( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin ( radians($lat) ) * sin( radians( lat ) ) ) ) < radius AS result FROM circle WHERE  NOW() BETWEEN startDateTime AND endDateTime AND status='Active' AND ageFrom <='$age' AND ageTo >='$age' AND gender='$gender' AND FIND_IN_SET($category, category) Having result=1";

$result = $conn->query($sql);
$count = 0;
$arrayofData=array();

if ($result->num_rows > 0) {
  //output data of each row
  while ($row = $result->fetch_assoc()) {
     array_push($arrayofData, $row);
  }       

foreach ($arrayofData as $key => $value) {
  //query to update status to inside in the tractusers table
  $query="INSERT INTO trackusers (id, creator, type, latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['username']}', '{$value['type']}',  ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['id']}, 'INSIDE', NOW() )";
  
  $result=$conn->query($query);

 if ($result) {
  //save tracked user's data into activegeo table
  $query2="INSERT INTO activegeofence (id, creator, type ,latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['username']}', '{$value['type']}' , ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['id']}, 'INSIDE', NOW()) ON DUPLICATE KEY UPDATE dateTime=NOW()";
  $result2=$conn->query($query2);
  if ($result2) {
      //echo "Could not successfully run query ($result2) from DB: " . mysqli_error($conn);
      return "Found Circle";
      }
}

// $mail = new PHPMailer(); 
// try {
//     //Server settings
//     // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail->isSMTP();                                      // Set mailer to use SMTP
//     $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
//     $mail->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail->Username = 'mbbarry91@gmail.com';                 // SMTP username
//     $mail->Password = 'bienvenumb1';                           // SMTP password
//     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//     $mail->Port = 587;                                    // TCP port to connect to

//     //Recipients
//     $mail->setFrom('suport@plot.com', 'Plot');
//     $mail->addAddress("{$value['email']}", 'Barry');     // Add a recipient
//     // $mail->addAddress('mbbarry91@gmail.com');               // Name is optional
//     // $mail->addReplyTo('info@example.com', 'Information');
//     // $mail->addCC('cc@example.com');
//     // $mail->addBCC('bcc@example.com');

//     //Attachments
//     // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

//     //date
//     $datetime=date('D, d M Y H:i:s');
//     //Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'User just entered your geofence';
//     $mail->Body    = "<H1>Bellow are the details</H1><br>". 
//                      "Geofence Name: {$value['username']}"."<br>".              
//                      "User Entered: $username"."<br>". 
//                      "Time: $datetime <br>";
//     $mail->AltBody ='This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     //echo 'Message has been sent';
// } catch (Exception $e) {
//     echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
// }

 unset($arrayofData);
}
      

} else {
  //check the users inside the active goefen 
  $query="SELECT * FROM activegeofence where id='$username' and type='Circle'";
  $resultquery= $conn->query($query);
  $arrayofgeofences = array();
  if($resultquery->num_rows > 0){
    while ($row= $resultquery->fetch_assoc()) {
      array_push($arrayofgeofences, $row);
    }
  //update status exit  
  foreach ($arrayofgeofences as $key=> $value) {
    $trackquery2="INSERT INTO trackusers (id, creator, type, latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['creator']}', '{$value['type']}', ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['geofence_id']}, 'EXIT', NOW())";
       $trackresult2 = $conn->query($trackquery2);
       if ($trackresult2) {
            //delete row in the table
            $trackquery2="DELETE FROM activegeofence WHERE id='$username' and geofence_id= {$value['geofence_id']}";
               $trackresult2 = $conn->query($trackquery2);
               if ($trackresult2) {
                   // echo "Could not successfully run query ($trackresult2) from DB: " . mysqli_error($conn);
                   return "Exit Circle";
                     }
                return $arrayofgeofences;
        }      
        unset($arrayofgeofences);
  }
  
} else{
  //update status to no geofence
  $trackquery2="INSERT INTO trackusers (id, latLng, status, dateTime) VALUES ('$username', ST_GEOMFROMTEXT('POINT($lat $lng)'), 'NO GEOFENCE', NOW())";
       $trackresult2 = $conn->query($trackquery2);
       if ($trackresult2) {
           // echo "Could not successfully run query ($trackresult2) from DB: " . mysqli_error($conn);
           return "No Geofence";
         } 
    }
  }
$conn->close();
}


//end of circle 

function findPointsInsidePolygon($lat, $lng, $username, $age, $gender, $category){

$conn = new mysqli(servername, dbusername, dbpassword, dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//start of polygon notification

// $sql="SELECT id, username, email, type, ST_CONTAINS(points, ST_GEOMFROMTEXT('POINT($lat $lng)')) as result FROM polygon WHERE  NOW() BETWEEN startDateTime AND endDateTime AND status='Active' AND ageFrom <='$age' AND ageTo >='$age' AND gender='$gender' Having result=1";

$sql="SELECT id, username, email, type, ST_CONTAINS(points, ST_GEOMFROMTEXT('POINT($lat $lng)')) as result FROM polygon WHERE  NOW() BETWEEN startDateTime AND endDateTime AND status='Active' AND ageFrom <='$age' AND ageTo >='$age' AND gender='$gender' AND FIND_IN_SET($category, category) Having result=1";


$result = $conn->query($sql);
$count = 0;
$arrayofData=array();

if ($result->num_rows > 0) {
    //output data of each row
  while ($row = $result->fetch_assoc()) {
     array_push($arrayofData, $row);
  }       

foreach ($arrayofData as $key => $value) {
  //query to update status to inside in the tractusers table
  $query="INSERT INTO trackusers (id, creator, type, latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['username']}', '{$value['type']}',  ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['id']}, 'INSIDE', NOW() )";
  $result=$conn->query($query);
if ($result) {
  //save tracked user's data into activegeo table
  $query2="INSERT INTO activegeofence (id, creator, type ,latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['username']}', '{$value['type']}' , ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['id']}, 'INSIDE', NOW()) ON DUPLICATE KEY UPDATE dateTime=NOW()";
  $result2=$conn->query($query2);
  if ($result2) {
     // echo "Could not successfully run query ($result2) from DB: " . mysqli_error($conn);
     return "Found Polygon";
   }
} 

// $mail = new PHPMailer(); 
// try {
//     //Server settings
//     // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail->isSMTP();                                      // Set mailer to use SMTP
//     $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
//     $mail->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail->Username = 'mbbarry91@gmail.com';                 // SMTP username
//     $mail->Password = 'bienvenumb1';                           // SMTP password
//     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//     $mail->Port = 587;                                    // TCP port to connect to

//     //Recipients
//     $mail->setFrom('suport@plot.com', 'Plot');
//     $mail->addAddress("{$value['email']}", 'Barry');     // Add a recipient
//     // $mail->addAddress('mbbarry91@gmail.com');               // Name is optional
//     // $mail->addReplyTo('info@example.com', 'Information');
//     // $mail->addCC('cc@example.com');
//     // $mail->addBCC('bcc@example.com');

//     //Attachments
//     // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

//     //date
//     $datetime=date('D, d M Y H:i:s');
//     //Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'User just entered your geofence';
//     $mail->Body    = "<H1>Bellow are the details</H1><br>". 
//                      "Geofence Name: {$value['username']}"."<br>".              
//                      "User Entered: $username"."<br>". 
//                      "Time: $datetime <br>";
//     $mail->AltBody ='This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     //echo 'Message has been sent';
// } catch (Exception $e) {
//     echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
// }

 unset($arrayofData);
}
      

} else {
  //check the users inside the active goefen 
  $query="SELECT * FROM activegeofence where id='$username' and type='Polygon'";
  $resultquery= $conn->query($query);
  $arrayofgeofences = array();
  if($resultquery->num_rows > 0){
    while ($row= $resultquery->fetch_assoc()) {
      array_push($arrayofgeofences, $row);
    }
  //update status exit  
foreach ($arrayofgeofences as $key=> $value) {
  $trackquery2="INSERT INTO trackusers (id, creator, type, latLng, geofence_id, status, dateTime) VALUES ('$username', '{$value['creator']}', '{$value['type']}', ST_GEOMFROMTEXT('POINT($lat $lng)'), {$value['geofence_id']}, 'EXIT', NOW())";
       $trackresult2 = $conn->query($trackquery2);
if ($trackresult2) {
//delete row in the table
  $trackquery2="DELETE FROM activegeofence WHERE id='$username' and geofence_id= {$value['geofence_id']}";
     $trackresult2 = $conn->query($trackquery2);
     if ($trackresult2) {
         // echo "Could not successfully run query ($trackresult2) from DB: " . mysqli_error($conn);
         return "Exit Polygon";
           }
    }     
    return $arrayofgeofences;
unset($arrayofgeofences);
}
  
} else{
  //update status to no geofence
  $trackquery2="INSERT INTO trackusers (id, latLng, status, dateTime) VALUES ('$username', ST_GEOMFROMTEXT('POINT($lat $lng)'), 'NO GEOFENCE', NOW())";
       $trackresult2 = $conn->query($trackquery2);
       if ($trackresult2) {
           // echo "Could not successfully run query ($trackresult2) from DB: " . mysqli_error($conn);
           return "No Geofence";
             }
          }
    }
  $conn->close();  
}

//function caller conditions
if(findPointsInsideCircle($lat, $lng, $username, $age, $gender, $category) && findPointsInsidePolygon($lat, $lng, $username, $age, $gender, $category)){
	$var1 = findPointsInsideCircle($lat, $lng, $username, $age, $gender, $category);
	$var2 = findPointsInsidePolygon($lat, $lng, $username, $age, $gender, $category);
	array_push($response, $var1);
	array_push($response, $var2);
} 

print_r(json_encode($response));


?>


