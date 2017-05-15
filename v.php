<?php
	include_once 'header.php';
?>
<!DOCTYPE html />
<html>
	<head>
		<?php
			include_once 'default_head.php';
		?>
		<script src="<?php echo(VDX_HOME);?>/js/player.js"></script>
	</head>
	<body>

		<?php

		$slp = strrpos($_SERVER['REQUEST_URI'], '/');
		$video_id = substr($_SERVER['REQUEST_URI'], $slp + 1);
		if(strlen($video_id == 0)){
			header('location: ' . VDX_HOME);
			return;
		}
		$qry_res = $db->query("SELECT * FROM videos WHERE id='$video_id'");


		?>
		<script>

		var VDX_HOME = '<?php echo(VDX_HOME); ?>';
		var video_id = <?php echo($video_id); ?>;

		</script>
		<?php
			include_once 'menu.php';
		?>
		<?php
		if(!$qry_res || $qry_res->num_rows != 1){
			?>
			<div class="playercontainer">

			<?php
			echo("<p style='color:red; text-align: center; width: 100%'>Video not found</p>");
			if(!$qry_res){
				echo("<br/><p style='color:red; text-align: center; width: 100%'>Error: " . mysqli_error($db) . '</p>');
			}
			$db->close();
			?>
			</div>
		</body>
	</html>
		<?php
			return;
		}
		$title = 'MISSING_TITLE';
		$desc = 'MISSING_DESC';
		$uploader_id = -1;
		$uploader_name = "";
		while($row = $qry_res->fetch_array()){
			$title = $row['title'];
			$desc = $row['description'];
			$uploader_id = $row['user_id'];
			$usr_res = $db->query("SELECT username FROM users WHERE id='$uploader_id'");
			if(!$usr_res || $usr_res->num_rows != 1){
				$uploader_name = "MISSING";
			}else{
				while($rw = $usr_res->fetch_array()){
					$uploader_name = $rw['username'];
				}
			}
		}
		$db->close();
		?>
		<div class="playercontainer">
			<div class="video_side">
				<h2><?php echo($title); ?></h2>
				<h3>Uploaded by: <?php echo($uploader_name); ?></h3>
				<br />
				<h4><?php echo($desc); ?></h4>
			</div>
			<div class="video_main">
				<video id="vd1">
					<source id="src0" />
				</video>
				<div class="playercontrols" id="ctrls">
					<button id="play_pause_btn" class="playButton fa fa-play" onclick="playVideo(1)"></button>
					<button id="volume_down_btn" class="volumeButton fa fa-volume-down"></button>
					<button id="btn_240" class="qualitybutton selected">240</button>
					<button id="btn_480" class="qualitybutton">480</button>
					<button id="btn_orig" class="qualitybutton">original</button>
					<button id="btn_fullscreen" class="qulaitybutton fa fa-expand"></button>
					<progress id="progress" class="progress" min="0" max="100" value="0">0% progress</progress>
				</div>
			</div>
		</div>
	</body>
</html>