<?php 
//Starte Session
session_start();

//Füge andere Klassen hinzu
include('include.php');
 ?>
<!DOCTYPE html>
<html lang="de">
<head>
  <title><?php 
  // Ermittel den Dokumenttitel
   echo get_header('title'); ?> - Admin</title>
  <meta charset="UTF-8">
  <?php 
  // Ermittel die Meta Tags
  get_header('meta_tags'); ?>
</head>
<body>
<div id="notify"></div>
<?php 
// Ersetze das Logo
rep_logo(); ?>
<form>
<input type="text" class="search" name="search" />
</form>
<script src="script/dropdown_menu.js"></script>
<div class="rep_nav">
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"></button>
  <div id="myDropdown" class="dropdown-content">
<?php
//Navigationsmenü für Mobile Ansicht
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
//Navigationsmenü
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
    include('classes/admin_login.php');
} else {
  //Wenn es eine Usersession gibt dann gebe folgendes aus:
  include('classes/logout.php');

  //Beitrag bearbeiten
  include('classes/edit_post.php');

  //Beitrag speichern
  include('classes/save_post.php');

  //Neuer Beitrag
  include('classes/new_post.php');

  //Beitrag publizieren
  include('classes/public_post.php');

  //Beitrag löschen
  include('classes/delete_post.php');

  //Neue Seite erstellen
  include('classes/new_site.php');

  include('classes/public_site.php');

  include('classes/settings.php');
  //Wenn es weder keinen Post oder GET gibt dann zeige Admin Startseite an.
  include('classes/admin_page.php');

  //Plugins auflisten
  if (isset($_GET['plugins'])){
    ?>
    <h1 style="text-align: center;">Plugins</h1>

    <?php
    $dirHandle = dir("plugins");
 
    // Verzeichnis Datei für Datei lesen
    while (($f = $dirHandle->read()) != false) {
       // Nur ausgeben, wenn nicht . oder ..
        if ($f != "." && $f != ".."){
            // Wenn es sich um ein Verzeichnis handelt
            if (!is_dir("files/".$f)){
              $xml=simplexml_load_file("plugins/".$f."/info.xml");
              ?>
              <table class="plugin_container">
                <tr>
                  <td><img src="<?php echo "plugins/".$f."/thumb.png" ?>"></td>
                  <td>
                    <table>
                      <tr>
                        <td>Name:</td><td><?php echo $xml->name; ?></td>
                      </tr>
                      <tr>
                        <td>Version:</td><td><?php echo $xml->version; ?></td>
                      </tr>
                      <tr>
                        <td>Entwickler:</td><td><?php echo $xml->developer; ?></td>
                      </tr>
                      <tr>
                        <td>Website:</td><td><?php echo $xml->website; ?></td>
                      </tr>
                      <tr>
                        <td>E-Mail:</td><td><?php echo $xml->mail; ?></td>
                      </tr>
                      <tr><td></td><td><button>deaktivieren</button> <button>löschen</button></td></tr>
                    </table>
                  </td>
                </tr>
              </table>
              <?php
            }
        }
    }
    // Verzeichnis wieder schließen
    $dirHandle->close();
  }
}
}
?>
</div>
</div>
<?php echo $footer; ?>
<?php 
if(isset($_SESSION['userid'])) {
include('classes/admin_panel.php');
}
?>
</body>
</html>