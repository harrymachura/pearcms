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


  //Benutzerverwaltung
  include('classes/users.php');

  if (isset($_GET['groups'])){
    ?>
    <h2 style="text-align: center;">Gruppen</h2>
    <table class="groups_table">
      <tr><td><b>Gruppenname</b></td></tr>
    <?php
    $get_groups = $db->query("SELECT * FROM groups");
    while ($group_name = $get_groups->fetchArray()) {
      echo '<tr><td>'. $group_name['name'] .'<button onclick="open_group_edit(this)" value="'.$group_name['id'].'">Bearbeiten</button></td></tr>';
    }
    ?>
    </table>
    <style type="text/css">
      #edit_group_bg{
        visibility: hidden;
        opacity: 0;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 1;
        background-color: rgba(0,0,0,.5);
        transition: all 0.2s ease-in-out;
      }
      #edit_group_frame{
        width: 70%;
        min-width: 320px;
        position: relative;
        padding: 15px;
        border-radius: 10px;
        color: black;
        background-color: rgba(255,255,255,.8);
        margin-left: auto;
        margin-right: auto;
        top: 10vh;
        box-shadow: 0px 0px 10px #000;
        
        max-height: 80vh;
        min-height: 300px;
      }
      #edit_group_frame table{
        margin-left: auto;
        margin-right: auto;
        width: 100%;

      }
      #edit_group_frame tr {
        display: inline-flex;
        width: auto;

        padding-left: 20px;

      }
      #edit_group_frame td{
        width: 230px;
      }
      #edit_group_frame #checkBox{
        float: right;
      }
      .group_scroll{
        max-height: 70vh;
        min-height: 300px;
        overflow:auto;
        overflow-y: scroll;
      }
      input[type=checkbox]{
      -webkit-appearance: none;
      background-color: #fafafa;
      border: 1px solid #cacece;
      box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
      padding: 9px;
      top: 0px;
      border-radius: 3px;
      display: inline-block;
      position: relative;
      width: 16px;
      height: 16px;
      }
      input[type=checkbox]:active input[type=checkbox]:checked:active{
        box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
      }
      input[type=checkbox]:checked{
        background-color: #e9ecee;
        border: 1px solid #adb8c0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
        color: #7bba73;
      }
      input[type=checkbox]:hover{
        background-color: #e9ecee;
      }
      input[type=checkbox]:checked:after{
        content: '\2714';
        font-size: 14px;
        position: absolute;
        top: 0px;
        left: 3px;
        color: #7bba73;
      }
    </style>
    <div id="edit_group_bg">
      <div id="edit_group_frame">
      <div class="close" id="close_upload_frame" onclick="close_group_edit_frame()"><hr class="close_a"><hr class="close_b"></div>
      <h3 style="text-align: center;">Gruppe bearbeiten.</h3>
      <div class="group_scroll">
      <table style="padding: 10px;" align="center">
        <tr><td>Beiträge erstellen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Seiten erstellen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Beiträge bearbeiten:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Seiten bearbeiten:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Fremde Beiträge bearbeiten:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Fremde Seiten bearbeiten:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Einstellungen ändern:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Plugins anzeigen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Plugins installieren:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Plugins entfernen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Plugins aktivieren/deaktivieren:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Benutzer anzeigen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Benutzer erstellen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Benutzer entfernen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Benutzer bearbeiten:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Gruppen anzeigen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Gruppen erstellen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Gruppen entfernen:<input id="checkBox" type="checkbox"></td></tr>
        <tr><td>Gruppen bearbeiten:<input id="checkBox" type="checkbox"></td></tr>
      </table>
      </div>
      </div>
    </div>
    <script type="text/javascript">
      function close_group_edit_frame(){
        var edit_frame = document.getElementById('edit_group_bg');
        edit_frame.style.opacity = "0";
        edit_frame.style.visibility = "hidden";
      }
      function open_group_edit(group_id){
        var edit_frame = document.getElementById('edit_group_bg');
        edit_frame.style.opacity = "1";
        edit_frame.style.visibility = "visible";
      }
    </script>
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