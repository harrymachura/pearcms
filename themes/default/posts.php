<!DOCTYPE html>
<html>
<head>
  <title>at-Tawhid - <?php include('classes/og/og_title.php'); ?></title>
  <meta charset="UTF-8">
  <meta name="content-language" content="de" />
  <meta name="author"           content="<?php include('classes/og/og_author.php'); ?>" />
  <meta name="publisher"        content="<?php include('classes/og/og_author.php'); ?>" />
  <meta name="copyright"        content="at-Tawhid" />
  <meta name="keywords"         content="<?php include('classes/og/og_keywords.php'); ?>" />
  <meta name="description"      content="<?php include('classes/og/og_description.php');?>" />
  <meta property="og:title" content="at-Tawhid - <?php include('classes/og/og_title.php'); ?>"/>
  <meta property="og:description" content="<?php include('classes/og/og_description.php');?>"/>
  <meta property="og:image" content="http://at-tawhid.de/images/propertyimage/posts.jpg"/>
  <meta name="language"         content="Deutsch" />
  <?php get_header('meta_tags'); ?>
</head>
<body>
<?php rep_logo(); ?>
<form>
<input type="text" class="search" name="search" />
</form>
<script src="script/dropdown_menu.js"></script>
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
<article>
<!--Posts Content-->
<?php include('classes/post_content.php'); ?>
</article>
</div>
</div>
<?php echo $footer; ?>
<?php 
if(isset($_SESSION['userid'])) {
include('classes/admin_panel.php');
}
?>
</body>
</html>