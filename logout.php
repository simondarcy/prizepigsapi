<?php
/* 
logout.php
This service simply logs a user out
*/
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
session_start();
session_destroy();
echo '{"message":"User logged out"}';
?>