var mediaPlayer;
var playPauseBtn;
var progressBar;
var controls;
var container;

var btn240;
var btn480;
var btnOrig;

var btnFullscreen;

var source240;
var source480;
var sourceOrig;

var sourceElement;

var isPlaying;
var status;
var isFullscreen;

document.addEventListener("DOMContentLoaded", function() {
    mediaPlayer = $("#vd1").get(0);
    mediaPlayer.addEventListener("ended", onVideoEnd);
    mediaPlayer.addEventListener("timeupdate", onVideoProgress);
    mediaPlayer.addEventListener("waiting", onVideoBuffering);
    container = $(".playercontainer")[0];
    container.addEventListener("mouseenter", function() {
        controls.removeClass("hidden");
    });
    container.addEventListener("mouseleave", function() {
        controls.addClass("hidden");
    });
    container = $(".playercontainer");
    playPauseBtn = $("#play_pause_btn");
    progressBar = $("#progress");
    progressBar.on("click", onProgressClick);
    controls = $("#ctrls");
    controls.addClass("hidden");

    btn240 = $("#btn_240");
    btn480 = $("#btn_480");
    btnOrig = $("#btn_orig");
    btnFullscreen = $("#btn_fullscreen");

    btn240.on("click", setQuality240);
    btn480.on("click", setQuality480);
    btnOrig.on("click", setQualityOrig);
    btnFullscreen.on("click", switchFS);

    sourceElement = $("#src0");

    source240 = VDX_HOME + "/videos/" + video_id + "/240p.mp4";
    source480 = VDX_HOME + "/videos/" + video_id + "/480p.mp4";
    sourceOrig = VDX_HOME + "/videos/" + video_id + "/original.mp4";
    isPlaying = false;
    isFullscreen = false;
    $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange', function(e) {
        console.log(e);

    });
});

function setQuality240(event) {
    var time = mediaPlayer.currentTime;
    sourceElement.attr("src", source240);
    btn240.addClass("selected");
    btn480.removeClass("selected");
    btnOrig.removeClass("selected");
    mediaPlayer.load();
    mediaPlayer.currentTime = time;
    if (isPlaying)
        mediaPlayer.play();
}

function setQuality480(event) {
    var time = mediaPlayer.currentTime;
    sourceElement.attr("src", source480);
    btn480.addClass("selected");
    btn240.removeClass("selected");
    btnOrig.removeClass("selected");
    mediaPlayer.load();
    mediaPlayer.currentTime = time;
    if (isPlaying)
        mediaPlayer.play();

}

function setQualityOrig(event) {
    var time = mediaPlayer.currentTime;
    sourceElement.attr("src", sourceOrig);
    btnOrig.addClass("selected");
    btn240.removeClass("selected");
    btn480.removeClass("selected");
    mediaPlayer.load();
    mediaPlayer.currentTime = time;
    if (isPlaying)
        mediaPlayer.play();
}

function onVideoBuffering(event) {
    progressBar.removeAttr('value');
}


function switchFS(evetn) {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            container.addClass("fullscreen");
            isFullscreen = true;
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            container.addClass("fullscreen");
            isFullscreen = true;
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            container.addClass("fullscreen");
            isFullscreen = true;
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            container.removeClass("fullscreen");
            isFullscreen = false;
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            container.removeClass("fullscreen");
            isFullscreen = false;
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            container.removeClass("fullscreen");
            isFullscreen = false;
            document.webkitCancelFullScreen();
        }
    }
}

function onVideoEnd() {
    playPauseBtn.removeClass("fa-pause");
    playPauseBtn.addClass("fa-play");
    isPlaying = false;
}

function onProgressClick(event) {
    var x = event.pageX - this.offsetLeft - event.target.parentElement.parentElement.offsetLeft, // or e.offsetX (less support, though)
        y = event.pageY - this.offsetTop, // or e.offsetY
        clickedValue = x * this.max / this.offsetWidth,
        isClicked = clickedValue <= this.value;
    //console.log("X: " + clickedValue);
    mediaPlayer.currentTime = mediaPlayer.duration * (clickedValue / 100);
}

function onVideoProgress() {
    var perc = Math.floor((100 * mediaPlayer.currentTime) / mediaPlayer.duration);
    //console.log(perc);
    progressBar.val(perc);
    var b = mediaPlayer.buffered;
    var i = b.length;
    while (i--) {
        var start = b.start(i);
        var end = b.end(i);
        var duration = mediaPlayer.duration;
        console.log("Duration: " + duration + " Start: " + start + " End: " + end);
    }
    progressBar.val();
    progressBar.innerHTML = perc + "% played";
}

function playVideo(id) {
    var mediaController = $("#vd" + id);

    if (mediaPlayer.paused || mediaPlayer.ended) {
        playPauseBtn.removeClass("fa-play");
        playPauseBtn.addClass("fa-pause");
        mediaPlayer.play();
        isPlaying = true;
    } else {
        playPauseBtn.removeClass("fa-pause");
        playPauseBtn.addClass("fa-play");
        mediaPlayer.pause();
        isPlaying = false;
    }
}