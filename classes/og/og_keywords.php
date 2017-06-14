<?php 
    if (!empty($_GET)) {
      switch($_GET){
        case !empty($_GET['id']):
           
           $result = $db->query("SELECT * FROM posts WHERE id = '". $_GET['id'] ."'");
           $row = $result->fetchArray();
           echo str_replace(" ", ", ", $row['keywords']);
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