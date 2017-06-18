<?php 
$result = $db->query("SELECT * FROM pages WHERE id = '$site'");
$result_array = $result->fetchArray();
?>
<!DOCTYPE html>
<html lang="de">
<head<?php echo event('head_attributes', ""); ?>>
  <title><?php
   echo get_header('title'). " - ". $result_array['title'];
   ?></title>
   <?php echo event('meta', ""); ?>
  <meta charset="UTF-8">
  <meta name="content-language" content="de" />
  <meta name="author"           content="Harry Machura" />
  <meta name="publisher"        content="Harry Machura" />
  <meta name="copyright"        content="<?php echo get_header('title'); ?>" />
  <meta name="keywords"         content="<?php echo event('meta_keywords', $result_array['keywords']); ?>" />
  <meta name="description"      content="<?php echo event('meta_description', $result_array['description']); ?>" />
  <meta name="language"         content="<?php echo event('meta_language', "Deutsch"); ?>" />
  <meta property="og:title" content="<?php echo get_header('title'). " - ". $result_array['title']; ?>"/>
  <meta property="og:description" content="<?php echo substr($result_array['title'], 0, 157); ?>"/>
  <meta property="og:image" content="http://at-tawhid.de/images/propertyimage/contact.jpg"/>
  <?php get_header('meta_tags'); ?>
</head>
<body>
<?php rep_logo(); ?>
<form>
<input type="text" class="search" name="search" />
</form>
<div class="rep_nav">
<div class="menu_btn" onclick="rotate()" id="menu"><hr id="a"><hr id="b"></div>
<script src="script/dropdown_menu.js"></script>
  </div>
<div id="menu_content">
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

<h1 style="text-align: center; padding: 0; margin: 0;"><?php echo $result_array['title']; ?></h1>
<?php 
if(isset($_SESSION['userid'])) {
    $edit_ = '<div style="text-align: center; padding-bottom: 10px; position: relativ;"><a href="admin.php?edit_site='.$site.'">['.language::edit.']</a><a href="admin.php?delete_site='.$site.'">['.language::delete.']</a></div>';
    echo $edit_;
  }
?>
<?php echo event('post_content', $result_array['content']); 
?>
</article>
<?php
}
?>
</div>
</div>
<?php echo event('footer', $footer ); ?>

<?php 
if(isset($_SESSION['userid'])) {
include('classes/admin_panel.php');
}
?>
</body>
</html>