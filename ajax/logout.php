<?php

include_once '../header.php';

if(!isset($_SESSION['usr_id'])){
    echo("nl");
    return;
}

unset($_SESSION['usr_id']);
unset($_SESSION['usr_name']);

echo("OK");
return;

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest";
}	

?>