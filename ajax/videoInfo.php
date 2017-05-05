<?php

include "../header.php";

class video_info{
	public $id;
	public $title;
	public $description;
	public $user_id;
}

if(!is_ajax()){
	die("Not Ajax");
}

if(!isset($_POST['id'])){
	die("No id");
}

$id = $_POST['id'];

$qry_res = $db->query("SELECT * FROM videos WHERE id = '$id'");
if(!$qry_res){
	die("Failed query: " . mysqli_error($db));
}

$arr = new video_info();

while($row = $qry_res->fetch_array()){
	$arr->id = $row['id'];
	$arr->titile = $row['title'];
	$arr->description = $row['description'];
	$arr->user_id = $row['user_id']; 
}

$json_arr = json_encode($arr);
echo($arr);

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest";
}

?>