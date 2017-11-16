<?php
/*
user_service.php
Service to log a user in, if logged in this service will return the users details in JSON format
*/

//ini_set('display_errors',1);
//error_reporting(E_ALL);

session_start();

/* output in necessary format */
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');  
header('Access-Control-Allow-Headers: *');  



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	if( isset( $_SESSION['pp_email'] ) ){
		echo '{"message":"logged in", "email":"'.$_SESSION['pp_email'].'", "id":"'.$_SESSION['pp_id'].'"}';
	}
	else{
		echo '{"error":"not logged in"}';	
	}
	
	return;
}

//make sure user not already logged in

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if ( !$request->email || !$request->password ) {
	echo '{"error":"Invalid login credentials"}';
	return;
}

$email = $request->email;
$password = $request->password;

//if post try log user in and return JSON
//if get return JSON if user logged in else return error

// !todo initial validation

require_once('../utils/connect.php');

// To protect MySQL injection (more detail about MySQL injection)
$email = $link->real_escape_string( stripslashes( $email ) );
$password = $link->real_escape_string( stripslashes( $password ) );

//get user from DB

/* grab user info from the db */
$query = "SELECT * FROM users WHERE email = '$email' and del = 0 LIMIT 1";

$result = $link->query($query) or die('Errant query:  '.$query);

$row_cnt = $result->num_rows;

if( $row_cnt == 0 ){
	echo '{"error":"No user with this email in system"}';
}
else{
	
	$row = $result->fetch_assoc();
	//check passwords match
	$hash = $row['password'];

	if (!password_verify($password, $hash)) {
		echo '{"error":"invalid password"}';
		return;
	}

	//User already logged in
	if( isset( $_SESSION['pp_email'] ) ){
		unset( $_SESSION['pp_id'] );
        unset( $_SESSION['pp_email'] );
		//update session with new user credentials
        $_SESSION['pp_id'] =  $row['id'];
		$_SESSION['pp_email'] = $email;
	}
	else{
		//create new session vars
        $_SESSION['pp_id'] =  $row['id'];
		$_SESSION['pp_email'] = $email;
	}

	//admin session

	//admin jazz
	$admin = $row['admin'];

	if( $admin==1){
		$_SESSION['admin'] = True;
	}
	else{
		unset( $_SESSION['admin'] );
	}

	echo '{"message":"User logged in successfully", "id":"'.$row['id'].'", "email":"'.$email.'", "token":"'.$row['token'].'"}';
}


/* disconnect from the db */

$result->close();
$link->close();

?>