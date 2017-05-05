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