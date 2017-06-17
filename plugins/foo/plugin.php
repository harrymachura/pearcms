<?php
event('footer', NULL, function($src) { 
  return "<center>Test</center>".$src;
});
?>