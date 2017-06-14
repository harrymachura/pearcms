
<?php
$src = $_GET['src'];

?>
<link rel="stylesheet" href="css/audioplayer.css" type="text/css" media="screen" />
<center>
<audio id="music" preload="true"><source src="<?php echo $src; ?>"></audio><div id="audioplayer"><button id="pButton" class="play"></button><div id="timeline"><div id="playhead"></div><div id="duration"></div></div><input type="range" onchange="setVolume(this.value)" class="audio_range" id="rngVolume" min="0" max="1" step="0.01" value="1"></div></center>
<script src="audioplayer.js"></script>