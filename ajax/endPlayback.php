<?php

include "../header.php";

if(!is_ajax()){
	die("Not ajax");
}

if(!isset($_REQUEST['plbk_id'])){
	die("No data");
}

$playback_id = $_REQUEST['plbk_id'];

$res = $db->query("DELETE FROM playbacks WHERE id='$playback_id'");
if($res){
	echo('OK');
}else{
	echo('Die in a fire: ' + mysqli_error($db));
}

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

?>