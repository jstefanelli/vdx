<div class="header">
	<h1><a href="<?php echo(VDX_HOME); ?>">Project VDX</a></h1>
	<form class="menubar" action="javascript:search()">
		<input type="text" id="menu_src" class="searchArea" placeholder="Search" <?php
			if(isset($_GET['search_val'])){
				echo ("value='" . $_GET['search_val'] ."'");
			}
		?>/>
		<a href="javascript:search()" class="fa fa-search" id="menu_btn"></a>
	</form>
<?php 	if(!is_logged()){ ?>
	<div class="logincntr"  >
		<a href="javascript:toggle_login()">Login</a>
		<a href="javascript:toggle_register()">Register</a>
	</div>
	<div class="loginStuff" id="menuLogin">
		<form action="javascript:doLogin()">
			<input type="text" placeholder="Username" name="vdx_user" id="txtUsr"/>
			<input type="password" placeholder="Password" name="vdx_psw" id="txtPsw" />
			<input type="submit" value="Submit">
		</form>
	</div>
	<div class="registerStuff" id="menuRegister">
		<form action="javascript:doRegister()">
			<input type="text" placeholder="Username" name="vdx_r_user" id="txtRUsr"/>
			<input type="password" placeholder="Password" name="vdx_r_psw_0" id="txtRPsw1" />
			<input type="password" placeholder="Password" name="vdx_r_psw_1" id="txtRPsw2" />
			<input type="submit" value="Submit">
		</form>
	</div>
<?php 	}else{?>
	<div class="logoutcntr">
		<a onclick="goUpload()">Upload</a>
		<a onclick="doLogout()">Logout</a>
	</div>
<?php } ?>
</div>