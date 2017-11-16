<?php
/* 
user_competitions.php
This service returns a list of competitions the logged in user has entered
*/

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../utils/check_token.php');

if( isset( $_SESSION['pp_id'] ) ){

    require_once('../utils/connect.php');

    $uid = $_SESSION['pp_id'];

    $query = "SELECT *, UNIX_TIMESTAMP(competition.enddate) AS epoch_enddate, UNIX_TIMESTAMP(answer.entered) AS epoch_entereddate
    FROM answers as answer
    LEFT JOIN competitions as competition on competition.id = answer.competitionFK
    WHERE answer.userFK = $uid
    AND competition.status = 0
    AND competition.startdate < now()
    AND competition.enddate > now()
    ORDER BY answer.entered DESC
    ";

    $result = $link->query($query) or die('Errant query:  '.$query);

    /* create one master array of the records */
    $posts = array();
    if( $result ) {
        while($row = $result->fetch_object()) {
            array_push($posts, $row);
            //$posts[] = array($row);
        }
    }

    /* output in necessary format */
    header('Content-type: application/json');

    echo json_encode(array('competitions'=>$posts));

    /* disconnect from the db */
    $result->close();
    $link->close();
}
else{
    echo '{"error":"not logged in"}';
    return;
}


?>