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
		<div class="main_gallery_cont">
			<div class="main_gallery">
				<a class="selected_img" style="background-color: #FF0000" id="img1" ></a>
				<a style="background-color: #00FF00" id="img2"></a>
				<a style="background-color: #0000FF" id="img3"></a>
				<div class="button-bar">
					<button id="gallery_btn_1" onclick="selectGalleryImg(1)"></button>
					<button id="gallery_btn_2" onclick="selectGalleryImg(2)"></button>
					<button id="gallery_btn_3" onclick="selectGalleryImg(3)"></button>
				</div>
			</div>
		</div>
	
		<script>
			function selectGalleryImg(id){
				$(".selected_img").removeClass("selected_img");
				$("#img" + id).addClass("selected_img");
			}
		</script>
	</body>
</html>