<?php 
/*
comeptitions_service.php
This service gets a list of all currently running competitions
*/

ini_set('display_errors',1);
error_reporting(E_ALL);

//query defauts
$number_of_posts = 25; //Number of comps returned
$category = ""; //update query to only return comps in a certain category
$featured = ""; //update query to only return comps flagged as featured

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

//DB connection
require_once('../utils/connect.php');

//If ?limit is passed in and its a valid number and its less than the max
if (isset($_GET['limit']) && is_numeric( $_GET['limit']) && $_GET['limit'] < $number_of_posts){
	$number_of_posts = $_GET['limit'];
}

if (isset($_GET['category'])){
	$category = "AND category='" . $link->real_escape_string( stripslashes($_GET['category']) ) . "'";
}

if (isset($_GET['featured']) && is_numeric( $_GET['featured']) && $_GET['featured'] == 1){
	$featured = "AND featured=1";
}

//setup cache
require "../utils/SimpleCache.php";
$cache = new Gilbitron\Util\SimpleCache();
$cache->cache_time = 120;
$cache_key =  'competitions_service_'.$number_of_posts.$category.$featured;

//try get data from cache
if($data = $cache->get_cache($cache_key)){
    header('FromCache: true');
    echo $data;
    return;
}

	
/* grab the posts from the db */
$query = "SELECT competition.*, question.question, question.option1, question.option2, question.option3, question.answer
          FROM competitions as competition
          LEFT JOIN questions as question on question.competitionFK = competition.id
          WHERE 
          competition.status=0
          AND competition.startdate < now() AND competition.enddate > now() 
          $category
          $featured
          GROUP BY competition.id 
          ORDER BY competition.startdate DESC 
          LIMIT $number_of_posts
          ";
	
	$result = $link->query($query) or die('{"error":"Errant query"}');

	/* create one master array of the records */
	$posts = array();
	if( $result ) {
        while($row = $result->fetch_object()) {
			array_push($posts, $row);
			//$posts[] = array($row);
		}
	}
	$data=json_encode(array('competitions'=>$posts));
	//set cache
	$cache->set_cache($cache_key, $data);
	echo $data;
	
	/* disconnect from the db */
	$result->close();
	$link->close();

?>