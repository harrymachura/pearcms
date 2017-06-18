<?php
if (isset($_GET['public_site'])) {
	$userid = $_SESSION['userid'];
      
      $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
      $row = $result->fetchArray();
      $site_title = str_replace('"', '&quot;', $_POST['site_title']);
      $site_content = $_POST['site_content'];
      $site_keywords = $_POST['site_keywords'];
      $pass_check = $_POST['site_pass_check'];
      $site_pass = '';
      $site_author = $row['id'];
      date_default_timezone_set("Europe/Berlin");
      $timestamp = time();
      //if ($pass_check == "on"){
      	//if 
      //}
      $site_date = date("d.m.Y",$timestamp);
      if (strlen($site_title) > 0) {
        $db->exec('INSERT INTO pages (title, author, date, content, keywords) VALUES ("'.$site_title.'","'.$site_author.'","'.$site_date.'","'.$site_content.'","'.$site_keywords.'")');
        $lastid = $db->lastInsertRowid();
        echo '<meta http-equiv="refresh" content="0; URL='.$site_title.'">';
        echo $pass_check;
      } else {
        echo '<p style="font-size: 32px;" align="center">'.language::please_insert_a_title.'</p>';
        echo '<a href="'. $_SERVER['HTTP_REFERER'] .'">'.language::back.'</a>';
      }
}
?>