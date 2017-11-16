<?php
/* 
has_user_entered.php
check has a user entered a certain comp
*/

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo '{"error":"please use post"}'; 
    return;
}


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if ( !$_POST['id'] ) {
    echo '{"error":"no id"}';
    return;
}

if( isset( $_SESSION['pp_id'] ) ){

    require_once('../utils/connect.php');

    $uid = $_SESSION['pp_id'];
    $cid = $_POST['id'];

    $cid = $link->real_escape_string($cid);

    $query = "SELECT id from answers where userFK = $uid AND competitionFK = $cid";

    $result = $link->query($query) or die('Errant query');

    //check if user has entered

    $row_cnt = $result->num_rows;

    if($row_cnt > 0){
        echo '{"result":"true"}';
    }else{
        echo '{"result":"false"}';
    }
    /* disconnect from the db */
    $result->close();
    $link->close();
    return;
}
else{
    echo '{"error":"not logged in"}';
    return;
}


?>