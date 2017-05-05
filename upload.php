<?php
	include_once 'header.php';
?>
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
	<br />
	<br />
	<br />
	<br />
	<input type="file" accept=".wmv, .avi, .ogg, video/h264, video/h265, video/ogg, video/mp4" id="files" /><br />
	<button onclick="doUpload()">Upload</button>
	<script>
	
	function doUpload(){
		var file = $('#files')[0].files[0];
		startUpload(file, function(uuid){
			alert("Done!");
		});
	}
	
	</script>
	</body>
</html>