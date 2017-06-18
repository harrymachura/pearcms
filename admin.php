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
    <h1 style="text-align: center;">Plugins</h1>
    <?php
    $get_users = $db->query("SELECT * FROM users");
    ?>
    <button onclick="show_pop(this)">Neuer Benutzer</button>
    <div class="popup_bg" id="popup_bg">
                <div class="popup_frm">
                <h2 style="text-align: center; margin: 10px;">Neuer Benutzer</h2>
                <table>
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
    <script type="text/javascript">
      function create_user(){
        var xhttp = new XMLHttpRequest();
        var status = document.getElementById('create_status');
        status.style.animation = "fadein 1s";
        var username = document.getElementById('username').value;
        var display_name = document.getElementById('name').value;
        var mail = document.getElementById('mail').value;
        var password = document.getElementById('password').value;
        var group = document.getElementById('group').value;

        var url = "classes/create_user.php";
        var params = "create_user&username=" + username + "&display_name=" + display_name + "&mail=" + mail + "&password=" + SHA512(password).toUpperCase() + "&group=" + group;
        if (password.length > 7) {
          xhttp.open("POST", url, true);
          //Send the proper header information along with the request
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.setRequestHeader("Content-length", params.length);
          xhttp.setRequestHeader("Connection", "close");
        } else {
          status.innerHTML = 'Das Passwort muss mindestens 8 Zeichen enthalten!';
          setTimeout(fadeout_error, 1000);
        }
        

        xhttp.onreadystatechange = function() {//Call a function when the state changes.
          if(xhttp.readyState == 4 && xhttp.status == 200) {
            switch(xhttp.responseText){
              case '0':
                status.innerHTML = '<span style="color: green;">Benutzer erstellt!</span>';
                setTimeout(fadeout, 1000);
              break;

              case '1':
                status.innerHTML = '<span style="color: red;">Die E-Mail ist nicht korrekt!</span>';
                setTimeout(fadeout_error, 1000);
              break;

              case '2':
                status.innerHTML = '<span style="color: red;">Der Benutzername ist zu kurz.</span>';
                setTimeout(fadeout_error, 1000);
              break;
            }
            
          }
        }
        xhttp.send(params);

        
      }
      function fadeout_error(){
        var status = document.getElementById('create_status');
        status.style.animation = "fadeout 1s";
        status.style.opacity = "0";
      }
      function fadeout(){
        var status = document.getElementById('create_status');
        status.style.animation = "fadeout 1s";
        status.style.opacity = "0";
        setTimeout(close_pop,1000);
      }
      function show_pop(){
          document.getElementById('popup_bg').style.visibility = "visible";
          document.getElementById('popup_bg').style.opacity = "1";
        }
        function close_pop(){
         var popup = document.getElementById('popup_bg');
         document.getElementById('popup_bg').style.opacity = "0";
         popup.style.visibility = "hidden";
        }
    </script>
    <table align="center" class="user_list">
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
      <tr><td><?php echo $row['username']; ?><br><a href="?edit_user=<?php echo $row['username']; ?>"><button>Bearbeiten</button></a> <a href="?delete_user=<?php echo $row['username']; ?>"><button>Löschen</button></a></td><td><?php echo $row['display_name']; ?></td><td><?php echo $row['mail']; ?></td><td><?php echo get_group($row['group']); ?></td></tr>
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