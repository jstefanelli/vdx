<div class="header">
	<h1>Project VDX</h1>
	<div class="menubar">
		<a class="button" href="<?php echo(VDX_HOME);?>/"><h1>Home</h1></a>
		<a class="button" href="<?php echo(VDX_HOME);?>/c"><h1>Browse Channels</h1></a>
		<a class="button" href="<?php echo(VDX_HOME);?>/u"><h1>Upload a Video</h1></a>
	</div>
<?php 	if(!is_logged()){ ?>
	<div class="logincntr" id="menuLogin">
		Login<br />
		<div class="loginBar">
			<h1>Username: </h1><input type="text" id="txtUsr" /><br />
			<h1>Password: </h1><input type="password" id="txtPsw" /><br />
			<button onclick="doLogin()">LOGIN</button>
		</div>
	</div>
<?php 	}else{?>
	<div class="logoutcntr">
		<a onclick="doLogout()">Logout</a><br />
	</div>
<?php } ?>
</div>