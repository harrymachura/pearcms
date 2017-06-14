<!DOCTYPE html>
<html lang="de">
<head>
  <title>at-Tawhid - Admin</title>
  <meta charset="UTF-8">
  <?php get_header('meta_tags'); ?>
</head>
<body>
<div class="rep_logo">
<img src="images/codeveloper.svg" alt="Logo" width="380" style="padding-top: 10px; padding-left: 50px;">
</div>
<form>
<input type="text" class="search" name="search" />
</form>
<script type="text/javascript">
  /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<div class="rep_nav">
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"></button>
  <div id="myDropdown" class="dropdown-content">
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
  //Suchfunktion
  search($_GET['search']);
} else {
  //Überprüfe ob es eine Usersession gibt, falls nicht aktzeptiere login.
  if(!isset($_SESSION['userid'])) {
  //Überprüfe ob die Loginform ausgeführt wurde
    if(isset($_GET['login'])) {
      //Überprüfe ob der Benutzername größer als 4 Zeichen ist und das Passwort größer als 6 Zeichen ist. 
      if (strlen($_POST['user']) > 4 && strlen($_POST['password']) > 6) {
        $username = $_POST['user'];
        $password = $_POST['password'];
        $get_logindata = $db->query("SELECT * FROM users WHERE username = '".$username."'");
        $row = $get_logindata->fetchArray();
        //Überprüfe ob es den Benutzer gibt
        if (count($row['username']) > 0) {
          //Gleiche das Passwort ab.
          if (hash('sha512', $password) == strtolower($row['password'])){

            $_SESSION['userid'] = $row['id'];
            ?>
            <p align="center" style="font-size: 32px;">Login erfolgreich!</p>
            <p align="center">Du wirst in 3 Sekunden automatisch umgeleitet.</p>
            <meta http-equiv="refresh" content="3; URL=admin">
            <?php
          } else {
            echo '<h2 style="text-align: center;">Login fehlgeschlagen!</h2>';
          }
        } else {
          echo '<h2 style="text-align: center;">Login fehlgeschlagen!</h2>';
        }
      } else {
        echo '<h2 style="text-align: center;">Login fehlgeschlagen!</h2>';
      }
          
  } else {

  ?>
    <h1 style="text-align: center;">Admin</h1>
    <form action="?login=1" method="post">
    <table align="center" class="login" width="100%">
      <tr>
        <td align="center"><div class="avatar"></div></td>
      </tr>
      <tr>
        <td align="center"><input type="text" name="user" placeholder="Benutzername..."></td>
      </tr>
        <tr>
        <td align="center"><input type="password" name="password" placeholder="Passwort..."></td>
      </tr>
      <tr>
        <td align="center"><button>Login</button></td>
      </tr>
    </table>
    </form>
  <?php
}
} else {
  //Wenn es eine Usersession gibt dann gebe folgendes aus:
  if (isset($_GET['logout'])) {
    session_destroy();
     ?>
    <p align="center" style="font-size: 32px;">Logout erfolgreich!</p>
    <p align="center">Du wirst in 3 Sekunden automatisch umgeleitet.</p>
    <meta http-equiv="refresh" content="3; URL=admin">
    <?php
  }
  if (isset($_GET['edit_note'])) {
    $note_id = $_GET["edit_note"];
        
      //Ausgabe einer Notiz aus dem GET ID
    $result_edit_note = $db->query("SELECT * FROM notes WHERE id = '". $note_id ."'");
    $row_edit_note = $result_edit_note->fetchArray();
    echo "Hallo";
    ?>
    <p align="center" style="font-size: 32px;">Notiz bearbeitn</p>
    <div class="new_note">
    <script src="codesnippet.js"></script>
    <script src="upload.js"></script>
    <form method="post" action="?save_note">
    <table align="center" width="100%">
      <tr><td>Author: <?php echo $row_edit_note['author']; ?></td></tr>
      <tr><td><input type="text" name="note_title" placeholder="Titel" value="<?php echo str_replace('"', "&quot;", $row_edit_note['title']); ?>"></td></tr>
      <tr><td align="left" style="float: left;"><button onclick="insert_img()" type="button">Image</button><button onclick="insert_audio()" type="button">Audio(MP3)</button><button onclick="insert_video()" type="button">Video(MP4)</button><button onclick="insert_center()" type="button">Center</button></tr>
      <tr><td><textarea name="note_content" placeholder="Inhalt" id="note_content"><?php echo $row_edit_note['content']; ?></textarea></td></tr>
      <tr><td><input type="text" name="note_keywords" placeholder="Keywords" value="<?php echo $row_edit_note['keywords']; ?>"></td></tr>
    </table>
    <button name="save_note" class="pub_button">Speichern</button>
    <input type="hidden" name="note_id" value="<?php echo $row_edit_note['id']; ?>">
    </form>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
    <table class="file_upload">
      <tr><td>Datei:</td><td><input name="file" type="file" id="fileA" onchange="fileChange();"/></td></tr>
      <tr><td>Dateiname:</td><td><div id="fileName"></div></td></tr>
      <tr><td>Dateigröße:</td><td><div id="fileSize"></div></td></tr>
      <tr><td>Dateityp:</td><td><div id="fileType"></div></td></tr>
      <tr><td>Prozess:</td><td><progress id="progress" style="margin-top:10px" value="0" max="100"></progress> <span id="prozent"></span></td></tr>
      <tr><td>Link:</td><td><input type="text" id="finish" value=""></td></tr>
      <tr><td><input name="upload" value="Upload" type="button" onclick="uploadFile();" /></td><td><input name="abort" value="Abbrechen" type="button" onclick="uploadAbort();" /></td></tr>
    </table>   
    </form>
    <?php
  }
  if (isset($_GET['save_note'])) {
    $note_title = str_replace('&nbsp;', '"', $_POST['note_title']);
    $note_content = $_POST['note_content'];
    $note_keywords = $_POST['note_keywords'];
    $note_id = $_POST['note_id'];
    date_default_timezone_set("Europe/Berlin");
    $timestamp = time();
    $note_date = date("d.m.Y",$timestamp);
    
      if (strlen($note_title) > 0) {
      $db->exec("UPDATE notes SET title = '$note_title', content = '$note_content', keywords = '$note_keywords', date = '$note_date' WHERE id = '$note_id'");
        echo '<p align="center" style="font-size: 32px;">Notiz gespeichert!</p>';
        echo '<meta http-equiv="refresh" content="2; URL=posts.php?id='.$note_id.'">';
      } else {
        echo '<p style="font-size: 32px;" align="center">Bitte gebe einen Titel ein!</p>';
        echo '<a href="'. $_SERVER['HTTP_REFERER'] .'">Zurück</a>';
      }
  }
  if (isset($_GET['new_note'])) {
    //Abfrage der Nutzer ID vom Login
        $userid = $_SESSION['userid'];
         
        $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
        $row = $result->fetchArray();
    ?>
    <p align="center" style="font-size: 32px;">Neue Notiz</p>
    <div class="new_note">
    <script src="codesnippet.js"></script>
    <script src="upload.js"></script>
    <form method="post" action="?public_note">
    <table align="center" width="100%">
      <tr><td>Author: <?php echo $row['username']; ?></td></tr>
      <tr><td><input type="text" name="note_title" placeholder="Titel"></td></tr>
      <tr><td align="left" style="float: left;"><button onclick="insert_img()" type="button">Image</button><button onclick="insert_audio()" type="button">Audio(MP3)</button><button onclick="insert_video()" type="button">Video(MP4)</button><button onclick="insert_center()" type="button">Center</button></tr>
      <tr><td><textarea name="note_content" placeholder="Inhalt" id="note_content"></textarea></td></tr>
      <tr><td><input type="text" name="note_keywords" placeholder="Keywords"></td></tr>
    </table>
    <button name="pub_note" class="pub_button">Publizieren</button>
    </form>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
    <table class="file_upload">
      <tr><td>Datei:</td><td><input name="file" type="file" id="fileA" onchange="fileChange();"/></td></tr>
      <tr><td>Dateiname:</td><td><div id="fileName"></div></td></tr>
      <tr><td>Dateigröße:</td><td><div id="fileSize"></div></td></tr>
      <tr><td>Dateityp:</td><td><div id="fileType"></div></td></tr>
      <tr><td>Prozess:</td><td><progress id="progress" style="margin-top:10px" value="0" max="100"></progress> <span id="prozent"></span></td></tr>
      <tr><td>Link:</td><td><input type="text" id="finish" value=""></td></tr>
      <tr><td><input name="upload" value="Upload" type="button" onclick="uploadFile();" /></td><td><input name="abort" value="Abbrechen" type="button" onclick="uploadAbort();" /></td></tr>
    </table>   
    </form>
    <?php
  }
  if (isset($_POST['pub_note'])){
      $userid = $_SESSION['userid'];
      
      $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
      $row = $result->fetchArray();
      $note_title = str_replace('"', '&quot;', $_POST['note_title']);
      $note_content = $_POST['note_content'];
      $note_keywords = $_POST['note_keywords'];
      $note_author = $row['username'];
      date_default_timezone_set("Europe/Berlin");
      $timestamp = time();
      $note_date = date("d.m.Y",$timestamp);
      if (strlen($note_title) > 0) {
        $db->exec('INSERT INTO notes (title, author, date, content, keywords) VALUES ("'.$note_title.'","'.$note_author.'","'.$note_date.'","'.$note_content.'","'.$note_keywords.'")');
        $lastid = $db->lastInsertRowid();
        echo '<meta http-equiv="refresh" content="0; URL=posts.php?id='.$lastid.'">';
      } else {
        echo '<p style="font-size: 32px;" align="center">Bitte gebe einen Titel ein!</p>';
        echo '<a href="'. $_SERVER['HTTP_REFERER'] .'">Zurück</a>';
      }
  }

  if (isset($_GET['delete_note'])){
        
        $db->exec('DELETE FROM notes WHERE id='.$_GET['delete_note']);
        echo '<p align="center" style="font-size: 32px;">Notiz gelöscht</p>';
        echo '<meta http-equiv="refresh" content="2; URL=posts.php">';
  }

    //Wenn es weder keinen Post oder GET gibt dann zeige Admin Startseite an.
    if (empty($_GET) and empty($_POST))
    {
        // handle post data
        date_default_timezone_set("Europe/Berlin");
        $timestamp = time();
        $datum = date("d.m.Y",$timestamp);
        echo $datum;
        //Abfrage der Nutzer ID vom Login
        $userid = $_SESSION['userid'];
         
        $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
        $row = $result->fetchArray();
        echo "<h3>Willkommen ".$row['username']."</h3>";
        
    }
}
}
?>
</div>
</div>
<?php echo $footer; ?>
</body>
</html>