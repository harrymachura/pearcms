<?php
if (isset($_GET['search'])) {
  search($_GET['search']);
} else {
if (isset($_GET['id'])) {
  //Ausgabe einer Notiz aus dem GET ID
  $result = $db->query("SELECT * FROM posts WHERE id = '". $_GET['id'] ."'");
  $row = $result->fetchArray();
  $edit = "";
  $author_id = $row['author'];
  $author_arr = $db->query("SELECT * FROM users WHERE id = '$author_id'");
  $author = $author_arr->fetchArray();
  if(isset($_SESSION['userid'])) {
    $edit = '<a href="admin.php?edit_note='. $row['id'] .'">['.language::edit.']</a><a href="admin.php?delete_note='. $row['id'] .'">['.language::delete.']</a>';
  }
  echo '<table width="100%">';
  echo '<tr><td align="center"><h2 style="text-align: center;">'. $row['title'] .'</h2>'. $edit .'</td></tr>';
  echo '<tr><td align="center">'.$author['display_name'].' / '.$row['date'].'</td></tr>';
  echo '<tr><td><article><div>'.codesnippet(nl2br($row['content'])).'</div></article></td></tr>';
  echo '<tr><td style="font-size: 12px; border: solid; border-width: 0px; border-radius: 6px; background-color: rgba(255,255,255,0.2);" align="center">'.$row['keywords'].'</td></tr>';
  echo '</table>';
} else {
  //Auflisten aller Notizen
  $result = $db->query('SELECT * FROM posts ORDER BY id DESC');
  $rows_ = $db->query("SELECT COUNT(*) as count FROM posts");  
  $row_ = $rows_->fetchArray();
  $numRows = $row_['count'];
  if ($numRows > 0) {
    while ($row = $result->fetchArray()) {
        $edit = "";
      if(isset($_SESSION['userid'])) {
        $edit = '<div style="font-size: 14px;"><a href="admin.php?edit_note='.$row['id'].'">['.language::edit.']</a><a href="admin.php?delete_note='.$row['id'].'">['.language::delete.']</a><div>';
      }
      $author_id = $row['author'];
      $author_arr = $db->query("SELECT * FROM users WHERE id = '$author_id'");
      $author = $author_arr->fetchArray();
      echo '<div class="note_list">
      <table>
        <tr><td style="font-size: 26px; padding: 5px; background-color: rgba(230,230,230,0.4); border-top-left-radius: 5px; border-top-right-radius: 5px;"><a href="?id='.$row['id'].'"><h1 style="padding:0; margin:0; margin-left: 5px; margin-top: 5px; font-size: 26px;"><b>'.$row['title'].'</b></h1>'. $edit .'</a></td></tr>
        <tr><td style="background-color: rgba(200,255,255,0.3); text-align: center;"><p style="margin:0; padding:0; font-size:14px;">Author '.$author['display_name'].' / '.$row['date'].'</p></td></tr>
        <tr><td style="background-color: rgba(255,255,255,0.1); padding: 15px;">'.nl2br(strip_tags(substr($row['content'], 0, 500))).'...</td></tr>
        <tr><td style="text-align: center; font-size: 12px; background-color: rgba(255,255,255,0.3);">Keywords: '.$row['keywords'].'</td></tr>
      </table>
    </div><br>';
          }
  } else {
    echo '<h2 style="text-align: center;">'.language::no_posts_available.'</h2>';
  }
    }
}
?>