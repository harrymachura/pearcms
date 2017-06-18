<?php
if (isset($_GET['logout'])) {
    session_destroy();
     ?>
    <p align="center" style="font-size: 32px;"><?php echo language::logout_successful; ?></p>
    <p align="center"><?php echo language::redirect_in_seconds; ?></p>
    <meta http-equiv="refresh" content="3; URL=admin.php">
    <?php
  }
?>