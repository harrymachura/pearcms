<?php
	include('config.php');
	include('language/'.$language.'.php');
$add_nav = "";
$get_nav_sites = $db->query("SELECT * FROM pages");

$check_start_page = $db->query("SELECT * FROM options WHERE id = '1'");
$check_arr = $check_start_page->fetchArray();
while ($row = $get_nav_sites->fetchArray()) {
  if ($check_arr['start_site'] == $row['id']){
    
  } else {
    $add_nav .= '<li><a href="'.$row['title'].'">'.$row['title'].'</a></li>';
  }
  
}
$navigation = '<li><a href="./">'.$start.'</a></li>
  <li><a href="posts">'.$posts.'</a></li>' . $add_nav;
?>