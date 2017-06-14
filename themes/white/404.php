<!DOCTYPE html>
<html lang="de">
<?php 
include('include.php');
?>
<head>
  <title><?php echo get_header('title'); ?> - 404</title>
  <meta charset="UTF-8">
  <meta name="content-language" content="de" />
  <meta name="copyright"        content="<?php echo get_header('title'); ?>" />
  <meta name="description"      content="Seite nicht gefunden!" />
  <meta name="language"         content="Deutsch" />
  <meta property="og:title" content="<?php echo get_header('title'); ?> - 404"/>
  <meta property="og:description" content="Seite nicht gefunden!"/>
  <meta property="og:image" content="http://at-tawhid.de/images/propertyimage/contact.jpg"/>
  <?php get_header(); ?>
</head>
<body>
<div class="rep_logo">
<img src="images/codeveloper.svg" alt="Logo" width="380" style="padding-top: 10px; padding-left: 50px;">
</div>
<form>
<input type="text" class="search" name="search" />
</form>
<script type="text/javascript">
  /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<div class="rep_nav">
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"></button>
  <div id="myDropdown" class="dropdown-content">
<?php
echo $navigation;
?>
  </div>
</div>
<form>
<input type="text" class="search_rep" name="search" />
</form>
</div>
<ul id="drop-nav">
<?php
echo $navigation;
?>
</ul>
<div class="wrapper">
<div class="site">

<?php
if (isset($_GET['search'])) {
  search($_GET['search']);
} else {
?>
<article>
<h2 style="text-align: center;">404</h2>
<h2 style="text-align: center;">Fehler! 404</h2>
</article>
<?php
}
?>
</div>
</div>
<?php echo $footer; ?>
</body>
</html>