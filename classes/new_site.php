<?php
if (isset($_GET['new_site'])){
    //Abfrage der Nutzer ID vom Login
        $userid = $_SESSION['userid'];
         
        $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
        $row = $result->fetchArray();
    ?>
    <p align="center" style="font-size: 32px;"><?php echo $new_site; ?></p>
    <div class="new_note">
    <script src="codesnippet.js"></script>
    <script src="upload.js"></script>
    <form method="post" action="?public_site">
    <table align="center" width="100%">
      <tr><td>Author: <?php echo $row['display_name']; ?></td></tr>
      <tr><td><input type="text" name="site_title" placeholder="Seitentitel"></td></tr>
      <tr><td align="left" style="float: left;"><button onclick="insert_img()" type="button">Image</button><button onclick="insert_audio()" type="button">Audio(MP3)</button><button onclick="insert_video()" type="button">Video(MP4)</button><button onclick="insert_center()" type="button">Center</button></tr>
      <tr><td><textarea name="site_content" placeholder="Inhalt" id="site_content"></textarea></td></tr>
      <tr><td><input type="text" name="site_keywords" placeholder="Keywords"></td></tr>
      <tr><td align="left"><input type="checkbox" name="site_pass_check" onclick="show_inpass()" style="float: left; height: 16px; width: 16px; margin-top: 1px;"> Passwort?<br><input type="password" id="site_pass_txt" name="site_pass" style="display: none; margin-left: auto; margin-right: auto;" placeholder="Seitenpasswort..."></td></tr>
    </table>
    <script>
      function show_inpass(){
        
        var site_pass = document.getElementById('site_pass_txt');
        if (site_pass.style.display == "none"){
          site_pass.style.display = "inline";
        } else {
          site_pass.style.display = "none";
        }
      }
    </script>
    <button name="pub_site" class="pub_button">Publizieren</button>
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
  ?>