<?php

include_once 'header.php';

if(!is_ajax()){
	die("Not ajax");
}

if(!isset($_FILES['file'])){
	die("No file");
}

if(!isset($_POST['uuid'])){
	die("No UUID");
}

if(!isset($_POST['id'])){
	die("No id");
}

$uuid = $_POST['uuid'];
$id = $_POST['id'];
$info = "";

if(!file_exists(LCL_HOME. "/tmp_up/" . $uuid . '/.info')){
	die("Not found: UUID");
}	

$inf = file_get_contents(LCL_HOME. "/tmp_up/" . $uuid . '/.info');
$info = json_decode($inf);
$info->curr_parts++;
$inf = json_encode($info);
file_put_contents(LCL_HOME. "/tmp_up/" . $uuid . '/.info', $inf);

move_uploaded_file($_FILES['file']['tmp_name'], LCL_HOME . "/tmp_up/" . $uuid . "/" . $info->name . "." . $id);

echo('OK!');

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest";
}	

?>