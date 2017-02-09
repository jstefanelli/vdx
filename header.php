<?php

include_once __DIR__ . '/vendor/autoload.php';

$db = mysqli_connect("localhost", "root", "", "vdx");

if(!$db){
	die("DB Connection Failed.");
}

?>