<?php

include_once '../header.php';

if(!is_ajax()){
    die("Not ajax");
}

if(!isset($_POST['uuid'])){
    die("No UUID");
}

$uuid = $_POST['uuid'];
$inf = file_get_contents(LCL_HOME. "/tmp_up/" . $uuid . '/.info');
$info = json_decode($inf);

$name = $info->name;
for($i = 0; $i < $info->tot_parts; $i++){
    $cnts = file_get_contents(LCL_HOME. "/tmp_up/" . $uuid . '/' . $name . "." . $i);

    file_put_contents(LCL_HOME. "/tmp_up/" . $uuid . '/' . $name, $cnts, FILE_APPEND);
    unlink(LCL_HOME. "/tmp_up/" . $uuid . '/' . $name . "." . $i);
}

echo("Merge OK!");

function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

?>