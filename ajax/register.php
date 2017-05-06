<?php

include_once("../header.php");

if(!jIsAjax()){
    die("Not ajax");
}

if(isset($_POST['usr_name'])){
    $name = $_POST['usr_name'];
}else{
    die("No name");
}

if(isset($_POST['psw_enc'])){
    $psw = $_POST['psw_enc'];
}else{
    die("No psw_enc");
}

$qry = "INSERT INTO users(username, password_enc) VALUES('$name', '$psw')";
$res = mysqli_query($db, $qry);

if(!$res){
    die("Failed");
}
echo("Ok");

?>