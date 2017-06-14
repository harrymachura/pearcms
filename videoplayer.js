var myVideo = document.getElementById("video1");
var pbutton = document.getElementById("vplay");
var duration = myVideo.duration; 
function set_time() {
  myVideo.currentTime = document.getElementById('rngtimeline').value;
}

function playPause() {
document.getElementById('rngtimeline').max = myVideo.duration;
    if (myVideo.paused) {
      myVideo.play();
      pbutton.style.backgroundImage = 'url(images/pause.svg)';
    } else {
      myVideo.pause();
      pbutton.style.backgroundImage = 'url(images/play.svg)';
    } 

}
var fullScreenButton = document.getElementById("full-screen");
// Event listener for the full-screen button
fullScreenButton.addEventListener("click", function() {
  if (myVideo.requestFullscreen) {
    myVideo.requestFullscreen();
  } else if (myVideo.mozRequestFullScreen) {
    myVideo.mozRequestFullScreen(); // Firefox
  } else if (myVideo.webkitRequestFullscreen) {
    myVideo.webkitRequestFullscreen(); // Chrome and Safari
  }
});
function fmtMSS(s){
    return(s-(s%=60))/60+(9<s?':':':0')+Math.round(s);
}
function videoUpdate(){
document.getElementById('v_duration').innerHTML = fmtMSS(myVideo.duration - myVideo.currentTime);
document.getElementById('rngtimeline').value = myVideo.currentTime;
}
myVideo.addEventListener('timeupdate', videoUpdate);
function backblur(){
  document.getElementById('controls').style.opacity = "1";
  document.getElementById('video1').style.filter = "blur(4px) grayscale(1) brightness(0.5)";
}
function hide_controlls() {
  
}
function unbackblur(){
  document.getElementById('video1').style.filter = "blur(0px) grayscale(0) brightness(1)";
  document.getElementById('controls').style.opacity = "0";
  setTimeout(hide_controlls, 3000);
}
function setVideoVolume(volume) {
   myVideo.volume = volume;
}