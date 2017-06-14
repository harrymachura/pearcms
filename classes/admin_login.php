<?php
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
            <meta http-equiv="refresh" content="3; URL=admin.php">
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
?>