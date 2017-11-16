<?php
/* 
register.php
This service is used to register new users
*/

// ini_set('display_errors',1);
// error_reporting(E_ALL);

session_start();


header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');  
header('Access-Control-Allow-Headers: *');  

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	echo '{"error":"please use post"}';	
	return;
}

//only required for web as in app user cant change ui to get register screen while logged in
if( isset( $_SESSION['pp_email'] ) ){
	echo '{"error":"Logged in users cannot register"}';	
	return;
}

//get posted data
$postdata = file_get_contents("php://input");
//convert posted data from JSON
$request = json_decode($postdata);

//make sure all info was posted || !$request->captcha 
if ( !$request->email || !$request->password ) {
	echo '{"error":"missing information"}';
	return;
}

/*check captcha
if ( !isset( $_SESSION['captcha'] ) || $_SESSION['captcha'] != $request->captcha ){
	echo '{"error":"Invalid captcha"}';
	return;
} 
*/

$email = $request->email;
$password = $request->password;
$DOB = $request->dob;
$gender = $request->gender;

//connect
require_once('../utils/connect.php');
require_once('../utils/token.php');

//prevent mysql injection
$email = $link->real_escape_string( stripslashes( $email ) );
$password = $link->real_escape_string( stripslashes( $password ) );
$DOB = $link->real_escape_string( stripslashes( $DOB) );
$gender = $link->real_escape_string( stripslashes( $gender ) );


// check if user already exists
$query = "SELECT id FROM users WHERE email = '$email' and del = 0 LIMIT 1";
$result = $link->query($query) or die('Errant query:  '.$query);
$row_cnt = $result->num_rows;

if($row_cnt > 0){
	echo '{"error":"user already exists"}';
	$link->close();
	return;
}else{

//hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

$token = Token::generate();
	
/* add new user to DB */
$query = "INSERT INTO `users` (`id`, `email`, `password`, `location`, `DOB`, `gender`, `joined`, `last_login`, `token`, `del`) VALUES (NULL, '$email', '$hash', '', '$DOB', $gender, CURRENT_TIMESTAMP, NULL, '$token', 0)";

$result = $link->query($query) or die('Errant query:  '.$query);
$newid = $link->insert_id;
$_SESSION['pp_email'] = $email;
$_SESSION['pp_id'] = $newid;

echo '{"message":"User registered successfully", "email":"'.$email.'", "id":"'.$newid.'", "token":"'.$token.'"}';

$link->close();

//Add user to our list in Mailchimp
require "../utils/MailChimp.php";
$MailChimp = new \Drewm\MailChimp('9f295ba07e2e2d9aa1e95dc0831d86b7-us10');

$result = $MailChimp->call('lists/subscribe', array(
                'id'                => 'c38974bfac',
                'email'             => array('email'=>$email),
                'merge_vars'        => array('GENDER'=>$gender, 'DOB'=>$DOB),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => true,
            ));


}
?>