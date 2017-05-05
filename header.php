<?php

session_start();

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/localConfig.php'; //Defines VDX_HOME, LCL_HOME, FFMPEG_PATH and FFPROBE_PATH
include_once __DIR__ . '/php_common/usr_funcs.php';
include_once __DIR__ . '/php_common/classes.php';


$db = mysqli_connect("localhost", "root", "", "vdx");

if(!$db){
	die("DB Connection Failed.");
}

function jIsAjax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest";
}

?>