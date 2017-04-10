<?php

include '../header.php';

if(!is_ajax()){
	die("Not ajax");
}

class retval{
	public $mirrorAddress;
	public $playbackId;
}

$qry = "SELECT MIN(tmp.cnt) AS cntx, mirrors.id AS mirror_id, mirrors.address AS mirror_address FROM mirrors, (SELECT mirrors.id AS mirror_id, COUNT(playbacks.id_mirror) AS cnt FROM mirrors LEFT JOIN playbacks ON mirrors.id = playbacks.id_mirror group by 1) AS tmp WHERE mirror_id = mirrors.id ";
$res = $db->query($qry);

if(!$res){
	echo ("Error: " . mysqli_error($db));
	return;
}else{
	$arr = $res->fetch_array();
	$mirrorAddr = $arr['mirror_address'];
	$mirrorId = $arr['mirror_id'];
	$qrx = "INSERT INTO playbacks(id_mirror) VALUES('$mirrorId')";
	$rsx = $db->query($qrx);
	if($rsx ){
		$playbackId = $db->insert_id;
	}
	$rvl = new retval();
	$rvl->mirrorAddress = $mirrorAddr;
	$rvl->playbackId = $playbackId;
	$retvl = json_encode($rvl);
	echo($retvl);
	return;
}

function is_ajax(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

?>