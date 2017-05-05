function doLogin() {
    var usr = $("#txtUsr").val();
    var psw = $("#txtPsw").val();
    var sha = new jsSHA("SHA-256", "TEXT");
    sha.update(psw);
    var psw_enc = sha.getHash("HEX");

    $.post(VDX_HOME + "/ajax/login.php", { usr_name: usr, psw_enc: psw_enc }, function(response) {
        console.log("Login: " + response);
        window.location.reload();
        $("#pippo").attr("disabled");
    });
}

function doLogout() {
    $.post("ajax/logout.php", {}, function(response) {
        console.log("Logout: " + response);
        window.location.href = ".";
    });
}