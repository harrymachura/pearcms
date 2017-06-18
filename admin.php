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
<script src="script/sha512.js"></script>
<div class="rep_nav">
<div class="menu_btn" onclick="rotate()" id="menu"><hr id="a"><hr id="b"></div>
<script src="script/dropdown_menu.js"></script>
  </div>
<div id="menu_content">
<?php
echo $navigation;
?>
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
  include('classes/list_plugins.php');

  if (isset($_GET['users'])) {
    ?>
    <h1 style="text-align: center;">Benutzer</h1>
    <?php
    $get_users = $db->query("SELECT * FROM users");
    ?>
    <button onclick="show_pop(this)">Neuer Benutzer</button>
    <div class="popup_bg" id="popup_bg">
                <div class="popup_frm">
                <h2 style="text-align: center; margin: 10px;">Neuer Benutzer</h2>
                <table width="100%">
                  <tr><td>Benutzername*:</td><td><input type="text" name="username" id="username"></td></tr>
                  <tr><td>Name:</td><td><input type="text" name="name" id="name"></td></tr>
                  <tr><td>E-Mail*:</td><td><input type="mail" name="name" id="mail"></td></tr>
                  <tr><td>Passwort*:</td><td><input type="password" name="password" id="password"></td></tr>
                  <tr><td>Gruppe*:</td><td><select id="group">
                    <?php
                      $groups = $db->query("SELECT * FROM groups");
                      while ($row = $groups->fetchArray()) {
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                      }
                    ?>
                  </select></td></tr>
                </table>
                <table width="100%"><tr><td align="right" width="50%"><button onclick="create_user()">Erstellen</button></td><td align="left"><button onclick="close_pop()">Abbrechen</button></td></tr></table>
                <div id="create_status" style="text-align: center; padding: 10px; font-size: 22px;"></div>
                </div>
    </div>
    <div class="popup_bg" id="user_del">
                <div class="popup_frm" id="pop_del" style="top: 30%;"></div>
    </div>
    <script src="script/users.js"></script>
    <table align="center" class="user_list" id="user_list">
    <tr><td><b>Benutzer</b></td><td><b>Name</b></td><td><b>E-Mail</b></td><td><b>Gruppe</b></td></tr>
    <?php
    function get_group($id){
      $db = new SQLite3('database/db.sqlite');
      $get_group_name = $db->query("SELECT * FROM groups WHERE id = '$id'");
      $arr = $get_group_name->fetchArray();
      return $arr['name'];
    }
    while ($row = $get_users->fetchArray()) {
      ?>
      <tr id="<?php echo $row['username']; ?>_list"><td><?php echo $row['username']; ?><br><a href="?edit_user=<?php echo $row['username']; ?>"><button>Bearbeiten</button></a> <button onclick="delete_popup(this)" value="<?php echo $row['username']; ?>">Löschen</button></td><td><?php echo $row['display_name']; ?></td><td><?php echo $row['mail']; ?></td><td><?php echo get_group($row['group']); ?></td></tr>
      <?php
    }
    ?>
    </table>

    <?php
  }
}
}
?>
</div>
</div>
<?php echo event('footer', $footer ); ?>
<?php 
if(isset($_SESSION['userid'])) {
include('classes/admin_panel.php');
}
?>
</body>
</html>