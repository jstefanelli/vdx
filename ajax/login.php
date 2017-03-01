<?php

include_once "../header.php";

if(!is_ajax()){
    header("location: ..");
    die("Not ajax");
}

if(!isset($_POST['usr_name'])){
    die("No usr");
}

if(!isset($_POST['psw_enc'])){
    die("No Psw");
}
$usr = $_POST['usr_name'];
$psw = $_POST['psw_enc'];


$res = mysqli_query($db, "SELECT id FROM users WHERE username = '$usr' AND password_enc = '$psw'");
if(!$res){
    echo("Failed. " . mysqli_error($db));
    return;
}
if($rs=mysqli_fetch_array($res)){
    $_SESSION['usr_id'] = $rs['id'];
    $_SESSION['usr_name'] = $usr;
    echo("Ok.");
    return;
}else{
    echo("Failed");
    return;
}

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest";
}	

?>