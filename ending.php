<?php
/* 
ending.php
return a list of competitions that are ending in the next X days
*/

ini_set('display_errors',1);
error_reporting(E_ALL);

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

//setup cache
require "../utils/SimpleCache.php";
$cache = new Gilbitron\Util\SimpleCache();
$cache->cache_time = 500;
$cache_key =  'competitions_ending';

//try get data from cache
if($data = $cache->get_cache($cache_key)){
    header('FromCache: true');
    echo $data;
    return;
}

require_once('../utils/connect.php');

$query = "SELECT id, title, excerpt, enddate, image, county, location FROM competitions
where enddate > NOW() AND DATE(enddate) < CURDATE() + INTERVAL 3 DAY AND status=0 ORDER BY enddate ASC LIMIT 25";

$result = $link->query($query) or die('Errant query:  '.$query);

/* create one master array of the records */
$posts = array();
if( $result ) {
    while($row = $result->fetch_object()) {
        array_push($posts, $row);
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
