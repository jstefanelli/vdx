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
    <div class="main_cont">
		<?php
        if(!is_logged()){
        ?>
            <h1 class="error-text">Error: You need to be logged in to view this page.</h1>
        <?php
        }else{
        ?>
            <div class="main-form">
                <input type="file" accept=".wmv, .mp4, .avi, .h264, .h265, .ogg, video/h264, video/h265, video/ogg, video/mp4" id="fl0">Choose Video to upload...</input>
                <button onclick="doUpload()">Upload</button><br />
                <input type="text" id="txtTitle" /><br />
                <input type="text" id="txtDesc" /><br />
            </div>
        <?php
        }

        ?>

        <script type="text/javascript">
            function doUpload(){
                var file = $("#fl0")[0].files[0];
                if(file == undefined || file == null){
                    alert("Please choose a video file");
                }
                startUpload(file, function(uuid){
                    //alert("Uploaded: " + uuid);
                    alert("Upload Complete");
                    var title = $("#txtTitle").val();
                    var desc = $("#txtDesc").val();
                    $.post("ajax/makeVideo.php", {tmp_uuid: uuid, title: title, desc: desc}, function(data){
                        console.log("Make Video: " + data);
                    })
                });
            }
        </script>
    </div>
    </body>
</html>