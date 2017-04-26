<?php

session_start();

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/localConfig.php'; //Defines VDX_HOME, LCL_HOME, FFMPEG_PATH and FFPROBE_PATH
include_once __DIR__ . '/php_common/usr_funcs.php';


$db = mysqli_connect("localhost", "root", "", "vdx");

if(!$db){
	die("DB Connection Failed.");
}


?>