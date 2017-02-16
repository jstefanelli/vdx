<?php

function is_logged(){
    return isset($_SESSION['usr_id']);
}

function getUsrId(){
    return ($_SESSION['usr_id']);
}

?>