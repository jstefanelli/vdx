<?php

include_once "../header.php";

if(!is_ajax()){
    die("not ajax");
}

if(!is_logged()){
    die("nl");
}

if(!isset($_POST['tmp_uuid'])){
    die("nvr"); // no video referenced
}

set_time_limit(300);

if(!isset($_POST['title']) || strlen($_POST['title']) <= 0){
    $title = "Untitled Video";
}else{
    $title = $_POST['title'];
}

if(!isset($_POST['desc'])|| strlen($_POST['desc']) <= 0){
    $desc = " ";
}else{
    $desc = $_POST['desc'];
}

$tmp_uuid = $_POST['tmp_uuid'];

$var = file_get_contents(LCL_HOME . "/tmp_up/" . $tmp_uuid . "/.info" );
$info = json_decode($var);
$fileName = $info->name;

$ffm = FFMpeg\FFMpeg::create([
    'ffmpeg.binaries' => FFMPEG_PATH,
    'ffprobe.binaries' => FFPROBE_PATH
]);
$video = $ffm->open(LCL_HOME . "/tmp_up/" . $tmp_uuid . "/". $fileName );
$usr_id = getUsrId();
$res = $db->query("INSERT INTO videos(title, description, user_id) VALUES('$title', '$desc', '$usr_id')");
if(!$res){
    die("Error: " . mysqli_error($db));
}
$myId = $db->insert_id;
$format240 = new FFMpeg\Format\Video\X264();
$format240->setAudioCodec("libfdk_aac");
$format480 = new FFMpeg\Format\Video\X264();
$format480->setAudioCodec("libfdk_aac");
$formatOrig = new FFMpeg\Format\Video\X264();
$formatOrig->setAudioCodec("libfdk_aac");
$format240->setKiloBitrate(300);
$format480->setKiloBitrate(1131);
$formatOrig->setKiloBitrate(1024 * 5);

mkdir(LCL_HOME . "/videos/" . $myId);
$video->filters()->framerate(new FFMpeg\Coordinate\FrameRate(30), 15)->resize(new FFMpeg\Coordinate\Dimension(1920, 1080))->synchronize();
$video->save($formatOrig, LCL_HOME . "/videos/" . $myId . "/original.mp4");
$video->filters()->framerate(new FFMpeg\Coordinate\FrameRate(30), 15)->resize(new FFMpeg\Coordinate\Dimension(426, 240))->synchronize();
$video->save($format240, LCL_HOME . "/videos/" . $myId . "/240p.mp4");
$video->filters()->framerate(new FFMpeg\Coordinate\FrameRate(30), 15)->resize(new FFMpeg\Coordinate\Dimension(854,480))->synchronize();
$video->save($format480, LCL_HOME . "/videos/" . $myId . "/480p.mp4");

$qry = "SELECT * FROM mirrors";
$res = $db->query($qry);
if(!$res){
    die("Error: Query Failed");
}
while($row = $res->fetch_array()){

    execInBackground("mono " . LCL_HOME . "/utils/vdxSync.exe --ip " . $row['address']. " --file " . LCL_HOME . "/videos/" . $myId . "/original.mp4" . " --id " . $myId);    
    execInBackground("mono " . LCL_HOME . "/utils/vdxSync.exe --ip " . $row['address']. " --file " . LCL_HOME . "/videos/" . $myId . "/240p.mp4" . " --id " . $myId);  
    execInBackground("mono " . LCL_HOME . "/utils/vdxSync.exe --ip " . $row['address']. " --file " . LCL_HOME . "/videos/" . $myId . "/480p.mp4" . " --id " . $myId);  
    //file_put_contents(LCL_HOME . "/videos/" . $myId . "/uploaded.inf", "Uploaded to " . $row['address'] . " with command:\n" . "mono " . LCL_HOME . "/utils/vdxSync.exe --ip " . $row['address']. " --file " . LCL_HOME . "/videos/" . $myId . "/480p.mp4" . " --id " . $myId);
}
die("OK");

function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r")); 
    }
    else {
        exec($cmd . " > /dev/null &");  
    }
} 


?>