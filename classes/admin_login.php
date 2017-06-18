<?php
if(isset($_GET['login'])) {
      //Überprüfe ob der Benutzername größer als 4 Zeichen ist und das Passwort größer als 6 Zeichen ist. 
      if (strlen($_POST['user']) > 3 && strlen($_POST['password']) > 6) {
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
            <p align="center" style="font-size: 32px;"><?php echo language::login_successful; ?></p>
            <p align="center"><?php echo language::redirect_in_seconds; ?></p>
            <meta http-equiv="refresh" content="3; URL=admin.php">
            <?php
          } else {
            echo '<h2 style="text-align: center;">'.language::login_failed.'</h2>';
          }
        } else {
          echo '<h2 style="text-align: center;">'.language::login_failed.'</h2>';
        }
      } else {
        echo '<h2 style="text-align: center;">'.language::login_failed.'</h2>';
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
        <td align="center"><input type="text" name="user" placeholder="<?php echo language::username_placeholder; ?>"></td>
      </tr>
        <tr>
        <td align="center"><input type="password" name="password" placeholder="<?php echo language::password_placeholder; ?>"></td>
      </tr>
      <tr>
        <td align="center"><button>Login</button></td>
      </tr>
    </table>
    </form>
  <?php
}
?>