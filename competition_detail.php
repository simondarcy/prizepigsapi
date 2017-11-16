<?php
/*
Service to get competition details of a single competition and return it in JSON format
Example: /api/competition_detail.php?compid=47
*/

ini_set('display_errors',1);
error_reporting(E_ALL);

//make sure compid is in request
if (!isset($_GET['compid'])){
    echo '{"error":"no id"}';
    return;
}

//get comp id from get request
$compid = htmlspecialchars($_GET["compid"]);

//set JSON headers
header('Content-type: application/json');

//setup cache
require "../utils/SimpleCache.php";
$cache = new Gilbitron\Util\SimpleCache();
$cache->cache_time = 120;
$cache_key =  'competition_'.$compid;

//try get data from cache
if($data = $cache->get_cache($cache_key)){
    header('FromCache: true');
    echo $data;
    return;
}

//Nothing in cache continue.

//DB connection
require_once('../utils/connect.php');

/* grab the posts from the db */
$query = "SELECT competition.*, question.question, question.option1, question.option2, question.option3, question.answer,
          !(competition.enddate > NOW()) as finished
          FROM competitions as competition
          LEFT JOIN questions as question on question.competitionFK = competition.id
          WHERE competition.id = $compid and competition.status=0";

$result = $link->query($query) or die('Errant query:  '.$query);

/* create one master array of the records */
$posts = array();

if( $result->num_rows > 0 ) {
    while($row = $result->fetch_object()) {
        array_push($posts, $row);
    }
    //cache data
    $data = json_encode($posts[0]);
    $cache->set_cache($cache_key, $data);
    //output data
    echo $data;
}
else{
    echo '{"error":"404 Competition not found"}';
}

/* disconnect from the db */
$result->close();
$link->close();

?>