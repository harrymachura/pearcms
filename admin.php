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
      echo '<tr><td>'. $group_name['name'] .'<button style="margin-left: 5px;">Löschen</button><button onclick="open_group_edit(this)" value="'.$group_name['id'].'">Bearbeiten</button></td></tr>';
    }
    ?>
    </table>
    <div id="edit_group_bg">
      <div id="edit_group_frame">
      <div class="close" id="close_upload_frame" onclick="close_group_edit_frame()"><hr class="close_a"><hr class="close_b"></div>
      <div style="text-align: center; font-size: 24px; padding-bottom: 20px;">Gruppe „<b><span id="groupname"></span></b>“ bearbeiten.</div>
      <div class="group_scroll">
      <table style="padding: 10px;" align="center">
        <tr><td>Beiträge erstellen:<input id="create_post_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Seiten erstellen:<input id="create_site_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Beiträge bearbeiten:<input id="edit_post_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Seiten bearbeiten:<input id="edit_site_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Fremde Beiträge bearbeiten:<input id="edit_other_post_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Fremde Seiten bearbeiten:<input id="edit_other_site_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Einstellungen ändern:<input id="change_settings_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Plugins anzeigen:<input id="show_plugins_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Plugins installieren:<input id="install_plugins_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Plugins entfernen:<input id="remove_plugins_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Plugins aktivieren/deaktivieren:<input id="plugins_visibility_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Benutzer anzeigen:<input id="show_users_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Benutzer erstellen:<input id="create_users_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Benutzer entfernen:<input id="remove_users_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Benutzer bearbeiten:<input id="edit_users_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Gruppen anzeigen:<input id="show_groups_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Gruppen erstellen:<input id="create_groups_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Gruppen entfernen:<input id="remove_groups_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
        <tr><td>Gruppen bearbeiten:<input id="edit_groups_cb" class="group_checkbox" type="checkbox" onclick="change_group_entry(this)"></td></tr>
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
        var xhttp = new XMLHttpRequest();
            var url = "classes/group_function.php";
            var params = "group_data=" + group_id.value;
              xhttp.open("POST", url, true);
              //Send the proper header information along with the request
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.setRequestHeader("Content-length", params.length);
              xhttp.setRequestHeader("Connection", "close");

              xhttp.onreadystatechange = function() {//Call a function when the state changes.
              if(xhttp.readyState == 4 && xhttp.status == 200) {
                var edit_frame = document.getElementById('edit_group_bg');     
                var group_arr = JSON.parse(xhttp.responseText);
                document.getElementById('create_post_cb').checked = parse_state(group_arr.create_post);
                document.getElementById('create_post_cb').value = group_id.value;

                document.getElementById('create_site_cb').checked = parse_state(group_arr.create_site);
                document.getElementById('create_site_cb').value = group_id.value;

                document.getElementById('edit_post_cb').checked = parse_state(group_arr.edit_post);
                document.getElementById('edit_post_cb').value = group_id.value;

                document.getElementById('edit_site_cb').checked = parse_state(group_arr.edit_site);
                document.getElementById('edit_site_cb').value = group_id.value;

                document.getElementById('edit_other_post_cb').checked = parse_state(group_arr.edit_other_posts);
                document.getElementById('edit_other_post_cb').value = group_id.value;

                document.getElementById('edit_other_site_cb').checked = parse_state(group_arr.edit_other_sites);
                document.getElementById('edit_other_site_cb').value = group_id.value;

                document.getElementById('change_settings_cb').checked = parse_state(group_arr.edit_settings);
                document.getElementById('change_settings_cb').value = group_id.value;

                document.getElementById('show_plugins_cb').checked = parse_state(group_arr.show_plugins);
                document.getElementById('show_plugins_cb').value = group_id.value;

                document.getElementById('install_plugins_cb').checked = parse_state(group_arr.install_plugins);
                document.getElementById('install_plugins_cb').value = group_id.value;

                document.getElementById('remove_plugins_cb').checked = parse_state(group_arr.remove_plugins);
                document.getElementById('remove_plugins_cb').value = group_id.value;

                document.getElementById('plugins_visibility_cb').checked = parse_state(group_arr.visibility_plugins);
                document.getElementById('plugins_visibility_cb').value = group_id.value;

                document.getElementById('show_users_cb').checked = parse_state(group_arr.show_users);
                document.getElementById('show_users_cb').value = group_id.value;

                document.getElementById('create_users_cb').checked = parse_state(group_arr.create_users);
                document.getElementById('create_users_cb').value = group_id.value;

                document.getElementById('remove_users_cb').checked = parse_state(group_arr.remove_users);
                document.getElementById('remove_users_cb').value = group_id.value;

                document.getElementById('edit_users_cb').checked = parse_state(group_arr.edit_users);
                document.getElementById('edit_users_cb').value = group_id.value;

                document.getElementById('show_groups_cb').checked = parse_state(group_arr.show_groups);
                document.getElementById('show_groups_cb').value = group_id.value;

                document.getElementById('create_groups_cb').checked = parse_state(group_arr.create_groups);
                document.getElementById('create_groups_cb').value = group_id.value;

                document.getElementById('remove_groups_cb').checked = parse_state(group_arr.remove_groups);
                document.getElementById('remove_groups_cb').value = group_id.value;

                document.getElementById('edit_groups_cb').checked = parse_state(group_arr.edit_groups);
                document.getElementById('edit_groups_cb').value = group_id.value;

                document.getElementById('groupname').innerHTML = group_arr.name;
                edit_frame.style.opacity = "1";
                edit_frame.style.visibility = "visible";
              }
            }
            xhttp.send(params);
      }
      function change_group_entry(entry){
        alert(entry.checked);
      }
      function parse_state(integer){
        if (integer == 1) {
          return true;
        } else {
          return false;
        }
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