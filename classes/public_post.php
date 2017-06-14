<?php
if (isset($_POST['pub_note'])){
      $userid = $_SESSION['userid'];
      
      $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
      $row = $result->fetchArray();
      $note_title = str_replace('"', '&quot;', $_POST['note_title']);
      $note_content = $_POST['note_content'];
      $note_keywords = $_POST['note_keywords'];
      $note_author = $row['id'];
      date_default_timezone_set("Europe/Berlin");
      $timestamp = time();
      $note_date = date("d.m.Y",$timestamp);
      if (strlen($note_title) > 0) {
        $db->exec('INSERT INTO posts (title, author, date, content, keywords) VALUES ("'.$note_title.'","'.$note_author.'","'.$note_date.'","'.$note_content.'","'.$note_keywords.'")');
        $lastid = $db->lastInsertRowid();
        echo '<meta http-equiv="refresh" content="0; URL=posts?id='.$lastid.'">';
      } else {
        echo '<p style="font-size: 32px;" align="center">Bitte gebe einen Titel ein!</p>';
        echo '<a href="'. $_SERVER['HTTP_REFERER'] .'">Zurück</a>';
      }
  }
?>