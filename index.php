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
		<div class="index-content">
			<div class="index-sidebar">
				<h3 id="link_upload"><a href="u">Upload</a></h3><br/>
				<h3>Register:</h3>
				<form action="javascript:register()">
					<input type="text" name="vdx_username" id="vdx_reg_username" placeholder="Username" /><br/>
					<input type="password" name="vdx_password" id="vdx_reg_psw" placeholder="Password" /><br/>
					<input type="password" name="vdx_password_confirm" id="vdx_reg_psw_2" placeholder="Confirm password" /><br/>
					<input type="submit" value="Register" />
				</form>
			</div>
			<div class="index-videos" id="vds">
			</div>
		</div>
		<script>
			function goto(id){
				console.log("goto " + id);
			}

			function parse(data){
				$("#vds").empty();
				var arr = JSON.parse(data);
				arr.forEach(function(val){
					$("#vds").append("<div style='background-image: url(videos/" + val.id +  "/thumb.jpg)' class='video_button' onclick='goto(" + val.id + ")'>" +
					 "<img src='videos/" + val.id + "/thumb.jpg' />" +
					 "<h2 class='author'>" + val.author + "</h2>" +
					 "<h1 class='title'>" + val.title + "</h1>" +
					 "</div>");
				});
			}

			function search(){
				var src = $("#menu_src").val();
				if(src != ""){
					$.post("ajax/getVideos.php", {qry: src}, function(data){
						console.log(data);
						parse(data);
					});
				}else{
					$.post("ajax/getVideos.php", {}, function(data){
						console.log(data);
						parse(data);
					});
				}
			}

			document.addEventListener("DOMContentLoaded", function() {
				search();
				$("#menu_src").on("keyup", search);
			});
		</script>
	</body>
</html>