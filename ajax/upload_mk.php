<?php

class upload_info{
	public $tot_parts;
	public $part_size;
	public $curr_parts;
	public $tmp_id;
	public $name;
}

if(!is_ajax()){
	die("Not ajax");
}

if(!isset($_POST['n_parts'])){
	die("No parts");
}

if(!isset($_POST['part_size'])){
	die("No size");
}

if(!isset($_POST['name'])){
	die("No name");
}

include_once '../header.php';

$id = mt_rand(0, 999999);
while(file_exists(LCL_HOME . "/tmp_up/" . $id)){
	$id = mt_rand(0, 999999);
}

mkdir(LCL_HOME . "/tmp_up/" . $id);

$f = fopen(LCL_HOME . "/tmp_up/" . $id . "/.info", "w");

$inf = new upload_info();
$inf->tot_parts = $_POST['n_parts'];
$inf->part_size = $_POST['part_size'];
$inf->curr_parts = 0;
$inf->tmp_id = $id;
$inf->name = $_POST['name'];

$jsn_data = json_encode($inf);

fwrite($f, $jsn_data);
fclose($f);

echo($id);

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest";
}	

?>