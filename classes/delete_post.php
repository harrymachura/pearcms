<?php
if (isset($_GET['delete_note'])){
        
        $db->exec('DELETE FROM posts WHERE id='.$_GET['delete_note']);
        echo '<p align="center" style="font-size: 32px;">Notiz gelöscht</p>';
        echo '<meta http-equiv="refresh" content="2; URL=posts">';
  }
?>