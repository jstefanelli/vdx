function doLogin() {
    var usr = $("#txtUsr").val();
    var psw = $("#txtPsw").val();
    var sha = new jsSHA("SHA-256", "TEXT");
    sha.update(psw);
    var psw_enc = sha.getHash("HEX");

    $.post(VDX_HOME + "/ajax/login.php", { usr_name: usr, psw_enc: psw_enc }, function(response) {
        console.log("Login: " + response);
        window.location.reload();
    });
}

function doRegister(){
    var usr = $("#txtRUsr").val();
    var psw = $("#txtRPsw1").val();
    var psw2 = $("#txtRPsw2").val();
    if(psw != psw2){
        alert("Passwords don't match.");
        return;
    }
    var sha = new jsSHA("SHA-256", "TEXT");
    sha.update(psw);
    var psw_enc = sha.getHash("HEX");

    $.post(VDX_HOME + "/ajax/register.php", { usr_name: usr, psw_enc: psw_enc }, function(response) {
        console.log("Register: " + response);
        if(response.toLowerCase() == "ok"){
            alert("Registered succesfully");
            window.location.reload();
        }else{
            alert("Username already in use");
        }
    });
}

function doLogout() {
    $.post("ajax/logout.php", {}, function(response) {
        console.log("Logout: " + response);
        window.location.href = ".";
    });
}

function goUpload(){
    window.location.href = "u";
}

function toggle_login(){
    if($("#menuLogin").css("display") == "none"){
        $("#menuLogin").css("display", "block");
        $("#menuRegister").css("display", "none");
    }else{
        $("#menuLogin").css("display", "none");
    }
}

function toggle_register(){
    if($("#menuRegister").css("display") == "none"){
        $("#menuRegister").css("display", "block");
        $("#menuLogin").css("display", "none");
    }else{
        $("#menuRegister").css("display", "none");
    }    
}