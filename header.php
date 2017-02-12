<?php

include_once __DIR__ . '/vendor/autoload.php';

define('VDX_HOME', "http://localhost/vdx");
define('LCL_HOME', "F:\\xampp\\htdocs\\vdx");

$db = mysqli_connect("localhost", "root", "", "vdx");

if(!$db){
	die("DB Connection Failed.");
}

?>