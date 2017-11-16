<?php
/* reset password */



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	echo '{"error":"please use post"}';	
	return;
}

// make sure email address passes in
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if ( !$request->password || !$request->key ) {
	echo '{"error":"missing information"}';
	return;
}


//connect
require_once('../utils/connect.php');

$key = $request->key;
$password = $request->password;

$password = $link->real_escape_string( stripslashes( $password ) );

// query db to make sure email exists

$query = "SELECT * FROM password_reset WHERE `key` = '$key' LIMIT 1";
$result = $link->query($query) or die('Errant query:  '.$query);
$row_cnt = $result->num_rows;

if($row_cnt == 0){
	echo '{"error":"This key does not exist"}';
	$link->close();
	return;
}else{

	$hash = password_hash($password, PASSWORD_DEFAULT);
	//get data
	$data = $result->fetch_assoc(); 
	$keyid = $data['id'];
	$uid = $data['uid'];

	//update users with new password
	$query = "UPDATE users SET password='$hash' WHERE id = '$uid'";
	$result = $link->query($query) or die('Could not save password:  '.$query);
	//delete key
	$query = "DELETE FROM password_reset WHERE id=$keyid";
	$result = $link->query($query) or die('Could not remove password reset key:  '.$query);
	echo '{"message":"password reset :) "}';

	return;
}




?>