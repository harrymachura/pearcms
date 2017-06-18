<?php
if (isset($_GET['save_note'])) {
    $note_title = str_replace('&nbsp;', '"', $_POST['note_title']);
    $note_content = $_POST['note_content'];
    $note_keywords = $_POST['note_keywords'];
    $note_id = $_POST['note_id'];
    date_default_timezone_set("Europe/Berlin");
    $timestamp = time();
    $note_date = date("d.m.Y",$timestamp);
    
      if (strlen($note_title) > 0) {
      $db->exec("UPDATE posts SET title = '$note_title', content = '$note_content', keywords = '$note_keywords', date = '$note_date' WHERE id = '$note_id'");
        echo '<p align="center" style="font-size: 32px;">'.language::post_saved.'</p>';
        echo '<meta http-equiv="refresh" content="2; URL=posts?id='.$note_id.'">';
      } else {
        echo '<p style="font-size: 32px;" align="center">'.language::please_insert_a_title.'</p>';
        echo '<a href="'. $_SERVER['HTTP_REFERER'] .'">'.language::back.'</a>';
      }
  }
?>