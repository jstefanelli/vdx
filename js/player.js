var mediaPlayer;
var playPauseBtn;
var progressBar;
var controls;
var container;

document.addEventListener("DOMContentLoaded", function() {
    mediaPlayer = $("#vd1").get(0);
    mediaPlayer.addEventListener("ended", onVideoEnd);
    mediaPlayer.addEventListener("timeupdate", onVideoProgress);
    container = $(".playercontainer")[0];
    container.addEventListener("mouseenter", function() {
        controls.removeClass("hidden");
    });
    container.addEventListener("mouseleave", function() {
        controls.addClass("hidden");
    });
    playPauseBtn = $("#play_pause_btn");
    progressBar = $("#progress");
    progressBar.on("click", onProgressClick);
    controls = $("#ctrls");
    controls.addClass("hidden");

})

function onVideoEnd() {
    playPauseBtn.removeClass("fa-pause");
    playPauseBtn.addClass("fa-play");
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
    progressBar.innerHTML = perc + "% played";
}

function playVideo(id) {
    var mediaController = $("#vd" + id);

    if (mediaPlayer.paused || mediaPlayer.ended) {
        playPauseBtn.removeClass("fa-play");
        playPauseBtn.addClass("fa-pause");
        mediaPlayer.play();
    } else {
        playPauseBtn.removeClass("fa-pause");
        playPauseBtn.addClass("fa-play");
        mediaPlayer.pause();
    }
}