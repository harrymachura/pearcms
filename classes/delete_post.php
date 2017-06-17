<?php
if (isset($_GET['delete_note'])){
        
        $db->exec('DELETE FROM posts WHERE id='.$_GET['delete_note']);
        echo '<p align="center" style="font-size: 32px;">'.$post_deleted.'</p>';
        echo '<meta http-equiv="refresh" content="0; URL=posts">';
  }
?>