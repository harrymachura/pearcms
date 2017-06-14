<?php
if (isset($_GET['logout'])) {
    session_destroy();
     ?>
    <p align="center" style="font-size: 32px;">Logout erfolgreich!</p>
    <p align="center">Du wirst in 3 Sekunden automatisch umgeleitet.</p>
    <meta http-equiv="refresh" content="3; URL=admin.php">
    <?php
  }
?>