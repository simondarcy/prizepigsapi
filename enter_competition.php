<?php
/* 
enter_competitiion.php
This service returns is used to enter a user into a competition
*/

//ini_set('display_errors',1);
//error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo '{"error":"please use post"}';
    return;
}

session_start();

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../utils/check_token.php');

//Check user session
if( isset( $_SESSION['pp_id'] ) ){
    $user_id = $_SESSION['pp_id'];
}
else{
    echo '{"error":"invalid session"}';
    return;
}

//get post data
$postdata = file_get_contents("php://input");
//decode the JSON
$request = json_decode($postdata);

//VALIDATION HERE

if (!$request->compid || !$request->answer){
	echo '{"error":"please select an answer"}';
	return;
}

$compid = $request->compid;
$answer = $request->answer;

//connect
require_once('../utils/connect.php');

$query = "INSERT INTO answers (userFK, competitionFK, answer) VALUES ($user_id, $compid, $answer)";

/* grab the posts from the db */
$result = $link->query($query) or die('Errant query:  '.$query);
echo '{"message":"Thank you for entering this competition."}';

$link->close();

?>