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
	<input type="file" id="files" /><br />
	<button onclick="doUpload()">Upload</button>
	<script type="text/javascript">
		
		function uploadStatus(){
			this.file = 0;
			this.parts = 0;
			this.part_size = 0;
			this.id = 0;
			this.last_byte = 0;
			this.last_bytes_sent = 0;
			this.bytes_left = 0;
			this.uuid = 0;
			this.address = "null";
		}

		function sendPart(data, address, id){
			
		}

		function getUploadUUID(address){

		}

		function nextPart(ups){
			if(ups.id == ups.parts){
				return;
			}
			var reader = new FileReader();
			reader.ups = ups;
			reader.onloadend = function(evt){
				if(evt.target.readyState == FileReader.DONE){
					var data = evt.target.result;
					console.log(this.jps_id);


					nextPart(ups);
				}
			}

			var ptr = (ups.bytes_left > ups.part_size) ? ups.part_size : ups.bytes_left;
			var blob = ups.file.slice(ups.id * ups.part_size, ptr);
			ups.id++;
			ups.bytes_left -= ptr;
			reader.readAsBinaryString(blob);
		}
		
		function doUpload(){
			var ups = new uploadStatus();
			ups.file = $('#files')[0].files[0];
			
			ups.size = file.size;
			ups.bytes_left = file.size;
			ups.part_size = 1024 * 1024;
			ups.id = 0;
			ups.parts = Math.round(size / ups.part_size);
			if(ups.parts * ups.part_size < ups.size){
				ups.parts = ups.parts + 1;
			}
			console.log(nparts);

		}
	</script>
	</body>
</html>