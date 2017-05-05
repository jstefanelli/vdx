function uploadStatus() {
    this.file = 0;
    this.parts = 0;
    this.part_size = 0;
    this.id = 0;
    this.last_byte = 0;
    this.last_bytes_sent = 0;
    this.bytes_left = 0;
    this.uuid = 0;
    this.name = "";
    this.done = function(uuid) { console.log("Finished upload to: " + uuid) };
    this.progress = null;
}

function sendPart(data, address, id, uuid, done) {
    var form_data = new FormData();
    form_data.append('file', data);
    form_data.append('id', id);
    form_data.append("uuid", uuid);
    $.ajax({
        url: address,
        dataType: 'text',
        contentType: false,
        cache: false,
        processData: false,
        data: form_data,
        type: 'POST',
        success: function(ajax_data) {
            //console.log(ajax_data);
            done();
        }
    });
}

function nextPart(ups) {
    if (ups.id == ups.parts) {
        $.post("ajax/upload_merge.php", { uuid: ups.uuid }, function(data) {
            //console.log(data);
            ups.done(ups.uuid);
        });
        return;
    }
    var ptr = (ups.bytes_left > ups.part_size) ? ups.part_size : ups.bytes_left;
    var blob = ups.file.slice(ups.id * ups.part_size, ups.id * ups.part_size + ptr);
    sendPart(blob, "ajax/upload_part.php", ups.id, ups.uuid, function() {

        ups.id++;
        ups.bytes_left -= ptr;
        var perc = (ups.id * 100) / ups.parts;
        if (ups.progress != null) {
            ups.progress(perc);
        }
        nextPart(ups);
    });
}

function startUpload(file, cb) {
    var ups = new uploadStatus();
    ups.file = file;

    ups.done = cb;
    ups.progress = null;

    ups.size = ups.file.size;
    ups.name = ups.file.name;
    ups.bytes_left = ups.file.size;
    ups.part_size = 1024 * 1024;
    ups.id = 0;
    ups.parts = Math.round(ups.size / ups.part_size);
    if (ups.parts * ups.part_size < ups.size) {
        ups.parts = ups.parts + 1;
    }
    $.post("ajax/upload_mk.php", { n_parts: ups.parts, part_size: ups.part_size, name: ups.name }, function(data) {
        if (data.startsWith('N')) {
            return;
        }
        //console.log(data);
        ups.uuid = data;
        nextPart(ups);
    });
    //console.log(ups.parts);
}


function startUpload(file, cb, progress) {
    var ups = new uploadStatus();
    ups.file = file;

    ups.done = cb;
    ups.progress = progress;

    ups.size = ups.file.size;
    ups.name = ups.file.name;
    ups.bytes_left = ups.file.size;
    ups.part_size = 1024 * 1024;
    ups.id = 0;
    ups.parts = Math.round(ups.size / ups.part_size);
    if (ups.parts * ups.part_size < ups.size) {
        ups.parts = ups.parts + 1;
    }
    $.post("ajax/upload_mk.php", { n_parts: ups.parts, part_size: ups.part_size, name: ups.name }, function(data) {
        if (data.startsWith('N')) {
            return;
        }
        //console.log(data);
        ups.uuid = data;
        nextPart(ups);
    });
    //console.log(ups.parts);
}