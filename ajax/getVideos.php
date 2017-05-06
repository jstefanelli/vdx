<?php

include_once '../header.php';

if(!jIsAjax()){
	die("Not ajax");
}

if(!isset($_POST['qry'])){
	$qry = "SELECT videos.*, users.username AS author FROM videos, users WHERE users.id = videos.user_id";
}else{
	$vl = mysqli_real_escape_string($db, $_POST['qry']);
	$qry = "SELECT videos.*, users.username AS author FROM videos, users WHERE title LIKE '%$vl%' AND users.id = videos.user_id";
}
$res = mysqli_query($db, $qry);
if(!$res){
	die("Query failed: " . mysqli_error($db));
}
$rvl = array();
while($row = mysqli_fetch_assoc($res)){
	$val = new video_out();
	$val->id = $row['id'];
	$val->title = $row['title'];
	$val->description = $row['description'];
	$val->user_id = $row['user_id'];
	$val->author = $row['author'];
	array_push($rvl, $val);
}
$rvl_json = json_encode($rvl);
echo($rvl_json);
?>