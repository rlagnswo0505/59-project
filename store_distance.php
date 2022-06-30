<?php
include_once "db/db_list.php";

session_start();

$my_lat = $_GET['my_lat'];
$my_lng = $_GET['my_lng'];

$param = [
    "my_lat" => $my_lat,
    "my_lng" => $my_lng
];
// print json_encode($param);
$argo =  sel_user_recom();
$result = store_distance($my_lat, $my_lng, 35.8700317, 128.6005225);
print json_encode($result);
