<?php

include "../header.php";

if(!is_ajax()){
	die("Not Ajax");
}

$qry_res = $db->query("SELECT id FROM videos");
if(!$qry_res){
	die("Failed query: " . mysqli_error($db));
}

$arr = array();

while($row = $qry_res->fetch_array()){
	array_push($arr, $row['id']);
}

$json_arr = json_encode($arr);
echo($json_arr);

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest";
}

?>