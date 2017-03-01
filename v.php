<?php
	include_once 'header.php';
	$ffg = FFMpeg\FFMpeg::create();
?>
<!DOCTYPE html />
<html>
	<head>
		<?php
			include_once 'default_head.php';
		?>
	</head>
	<body>
		<?php
			include_once 'menu.php';
		?>
		<div class="playercontainer" >
			<video id="vd1">
				<source src="<?php echo(VDX_HOME); ?>/videos/7/240p.mp4" type="video/mp4" />
				<source src="<?php echo(VDX_HOME); ?>/videos/7/original.mp4" type="video/mp4" />
				<source src="<?php echo(VDX_HOME); ?>/videos/7/480p.mp4" type="video/mp4" />
			</video>
			<div class="playercontrols" id="ctrls">
				<button id="play_pause_btn" class="playButton fa fa-play" onclick="playVideo(1)"></button>
				<button id="volume_down_btn" class="volumeButton fa fa-volume-down"></button>
				<progress id="progress" clas="progress" min="0" max="100" value="0">0% progress</progress>
		</div>
	</body>
</html>