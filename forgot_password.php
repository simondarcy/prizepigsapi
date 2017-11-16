 <?php
/* forgot password, accepts users email address, generates key and sends them a reset email  */



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	echo '{"error":"please use post"}';	
	return;
}

// make sure email address passes in
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if ( !$request->email ) {
	echo '{"error":"missing information"}';
	return;
}


//connect
require_once('../utils/connect.php');

$email = $request->email;
$email = $link->real_escape_string( stripslashes( $email ) );

// query db to make sure email exists
$query = "SELECT id FROM users WHERE email = '$email' and del = 0 LIMIT 1";
$result = $link->query($query) or die('Errant query:  '.$query);
$row_cnt = $result->num_rows;

if($row_cnt == 0){
	echo '{"error":"No user with this email"}';
	$link->close();
	return;
}else{

	/* make sure they dont already have a verification link */


	/* Create Key to store in DB */
	$key = '';
	for ($i = 1; $i <= 10; $i++) {
	    $key .= chr(rand(97, 122));
	}
	$key = md5($key);

	$uid = $result->fetch_assoc()['id'];
	
	//store in db
	$query = "INSERT INTO `password_reset` (`id`, `uid`, `key`, `timestamp`) VALUES (NULL, '$uid', '$key', CURRENT_TIMESTAMP)";

	$result = $link->query($query) or die('{"error":"A request was already send to this email address. Please contact info@prizepigs.ie for assistance."}');

 	//uid, time, key
 	$url = 'https://www.prizepigs.ie/reset-password.php?key='.$key;
	
	//send mail
	require_once('../utils/send_email.php');
	$subject = "Prize Pigs - Password Reset";
	$message = "<html><body><h1>Prize Pigs</h1>Hi there. We recieved a request to reset your password <a href='".$url."'>click here</a> to reset your password.</body></html>";
	sendEmail($email, $subject, $message);

	echo '{"message":"We have sent a reset link to '.$email.' Remember to check your spam folder"}';
	$link->close();
	return;
}




?>