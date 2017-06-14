var music = document.getElementById('music'); // id for audio element
var duration = music.duration; // Duration of audio clip, calculated here for embedding purposes
var pButton = document.getElementById('pButton'); // play button
var playhead = document.getElementById('playhead'); // playhead
var timeline = document.getElementById('timeline'); // timeline

// timeline width adjusted for playhead
var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;

// play button event listenter
pButton.addEventListener("click", play);

// timeupdate event listener
music.addEventListener("timeupdate", timeUpdate, false);

// makes timeline clickable
timeline.addEventListener("click", function(event) {
    moveplayhead(event);
    music.currentTime = duration * clickPercent(event);
}, false);

// returns click as decimal (.77) of the total timelineWidth
function clickPercent(event) {
    return (event.clientX - getPosition(timeline)) / timelineWidth;
}

// makes playhead draggable
playhead.addEventListener('mousedown', mouseDown, false);
window.addEventListener('mouseup', mouseUp, false);

// Boolean value so that audio position is updated only when the playhead is released
var onplayhead = false;

// mouseDown EventListener
function mouseDown() {
    onplayhead = true;
    window.addEventListener('mousemove', moveplayhead, true);
    music.removeEventListener('timeupdate', timeUpdate, false);
}

// mouseUp EventListener
// getting input from all mouse clicks
function mouseUp(event) {
    if (onplayhead == true) {
        moveplayhead(event);
        window.removeEventListener('mousemove', moveplayhead, true);
        // change current time
        music.currentTime = duration * clickPercent(event);
        music.addEventListener('timeupdate', timeUpdate, false);
    }
    onplayhead = false;
}
// mousemove EventListener
// Moves playhead as user drags
function moveplayhead(event) {
    var newMargLeft = event.clientX - getPosition(timeline);
    
    if (newMargLeft >= 0 && newMargLeft <= timelineWidth) {
        playhead.style.marginLeft = newMargLeft + "px";
    }
    if (newMargLeft < 0) {
        playhead.style.marginLeft = "0px";
    }
    if (newMargLeft > timelineWidth) {
        playhead.style.marginLeft = timelineWidth + "px";
    }
}
function fmtMSS(s){
    return(s-(s%=60))/60+(9<s?':':':0')+Math.round(s);
}
// timeUpdate
// Synchronizes playhead position with current point in audio
function timeUpdate() {
    document.getElementById('duration').innerHTML = fmtMSS(duration - music.currentTime);
    var playPercent = timelineWidth * (music.currentTime / duration);

    playhead.style.marginLeft = playPercent + "px";
    if (music.currentTime == duration) {
        pButton.className = "";
        pButton.className = "play";

    }
}
document.getElementById("timeline").onmouseover = function() 
{
    
    if (music.paused) {
        document.getElementById('timeline').style.backgroundColor = 'rgba(0,0,0,.5)';
    } else {
        document.getElementById('timeline').style.background = 'rgba(229,61,61,.7)';
    }
}
document.getElementById("timeline").onmouseleave = function() 
{ 
    if (music.paused) {
        document.getElementById('timeline').style.background = 'rgba(0,0,0,.3)';
    } else {
        document.getElementById('timeline').style.background = 'rgba(150,51,51,.5)';
    }
}
//Play and Pause
function play() {
    // start music

    if (music.paused) {
        music.play();
        // remove play, add pause
        pButton.className = "";
        pButton.className = "pause";
        document.getElementById('timeline').style.background = 'rgba(150,51,51,.5)';
        
    } else { // pause music
        music.pause();
        // remove pause, add play
        pButton.className = "";
        pButton.className = "play";
        document.getElementById('timeline').style.background = 'rgba(0,0,0,.3)';
    }
}
function setVolume(volume) {
   music.volume = volume;
}
// Gets audio file duration
music.addEventListener("canplaythrough", function() {
    duration = music.duration;
}, false);

// getPosition
// Returns elements left position relative to top-left of viewport
function getPosition(el) {
    return el.getBoundingClientRect().left;
}