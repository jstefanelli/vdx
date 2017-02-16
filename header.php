<?php

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/php_common/usr_funcs.php';


define('VDX_HOME', "http://localhost/vdx");
define('LCL_HOME', "F:\\xampp\\htdocs\\vdx");

session_start();

$db = mysqli_connect("localhost", "root", "", "vdx");

if(!$db){
	die("DB Connection Failed.");
}


?>