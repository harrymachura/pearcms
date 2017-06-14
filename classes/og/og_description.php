<?php 
    if (!empty($_GET)) {
      switch($_GET){
        case !empty($_GET['id']):
           
           $result = $db->query("SELECT * FROM posts WHERE id = '". $_GET['id'] ."'");
           $row = $result->fetchArray();
           echo strip_tags(substr(nl2br($row['content']), 0, 255));
        break;

        case !empty($_GET['search']):
             echo "";
        break;   

        default:
             echo "";
        break;}
  } else { 
    echo "Notizen";
  }
?>