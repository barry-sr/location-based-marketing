<?php
include('session.php');
$_SESSION['logged_in'] = false;
//unset($_SESSION['logged_in']);
if(session_destroy() && !$_SESSION['logged_in']) // Destroying All Sessions
{
header("Location: ../User-panel/login.html"); // Redirecting To Home Page
}
