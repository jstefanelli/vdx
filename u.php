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
        include 'menu.php';
    ?>
    <div class="index-content">
		<?php
        if(!is_logged()){
        ?>
            <h1 class="error-text">Error: You need to be logged in to view this page.</h1>
        <?php
        }else{
        ?>
            <div class="uploadTitle">
                <canvas class="left">

                </canvas>
                <div class="right">
                    <h3>Title: </h3>
                    <input type="text" id="txtTitle" /><br />    
                    <input type="file" accept=".wmv, .mp4, .avi, .h264, .h265, .ogg, video/h264, video/h265, video/ogg, video/mp4" id="fl0" />
                    <button onclick="doUpload()" id="btnUp">Upload</button><br />
                </div>
            </div>
            <progress min="0" max="100" value="0" style="width: 100%; border-radius: 2px" id="prgUpload"></progress>
            <div class="uploadForm">
                <h3>Description:</h3><br/>
                <textarea type="text" id="txtDesc" rows="50" style="width: 100%; height: 60%; resize: none;"></textarea>
            </div>
        <?php
        }

        ?>
        
        <script type="text/javascript">
            var running = false;

            function doUpload(){
                if(running){
                    alert("An upload is already running.");
                    return;
                }
                var file = $("#fl0")[0].files[0];
                if(file == undefined || file == null){
                    alert("Please choose a video file");
                }
                running = true;
                startUploadP(file, function(uuid){
                    //alert("Uploaded: " + uuid);
                    alert("Upload Complete");
                    $("#prgUpload").removeAttr("value");
                    $("#prgUpload").removeAttr("max");
                    var title = $("#txtTitle").val();
                    var desc = $("#txtDesc").val();
                    $.post("ajax/makeVideo.php", {tmp_uuid: uuid, title: title, desc: desc}, function(data){
                        console.log("Make Video: " + data);
                        $("#prgUpload").attr("max", "100");
                        $("#prgUpload").attr("value", "0");
                        running = false;
                        alert("Encoding complete.");
                    })
                }, function(perc){
                    $("#prgUpload").val(perc);
                });
            }

            function search(){
                var vl = $("#menu_src").val();
                window.location.href = "<?php echo(VDX_HOME); ?>/?qry=" + vl;
            }

        </script>
    </div>
    </body>
</html>