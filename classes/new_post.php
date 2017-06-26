<?php
if (isset($_GET['new_note'])) {
  if (permission("create_post") == 1){
    //Abfrage der Nutzer ID vom Login
        $userid = $_SESSION['userid'];
         
        $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
        $row = $result->fetchArray();
    ?>
    <p align="center" style="font-size: 32px;"><?php echo language::new_post; ?></p>
    <div class="new_note">
    <script src="codesnippet.js"></script>
    <script src="upload.js"></script>
    <form method="post" action="?public_note">
    <table align="center" width="100%">
      <tr><td><?php echo language::author; ?>: <?php echo $row['username']; ?></td></tr>
      <tr><td><input type="text" name="note_title" placeholder="<?php echo language::title_placeholder; ?>"></td></tr>
      <tr><td align="left" style="float: left;"><button onclick="insert_img()" type="button">Image</button><button onclick="insert_audio()" type="button">Audio(MP3)</button><button onclick="insert_video()" type="button">Video(MP4)</button><button onclick="insert_center()" type="button">Center</button></tr>
      <tr><td><textarea name="note_content" placeholder="<?php echo language::content_placeholder; ?>" id="note_content"></textarea></td></tr>
      <tr><td><input type="text" name="note_keywords" placeholder="<?php echo language::keywords_placeholder; ?>"></td></tr>
    </table>
    <button name="pub_note" class="pub_button"><?php echo language::publish; ?></button>
    </form>
    </div>
    <div id="upload_popup_bg">
            <div id="upload_popup_frame">
            <div class="close" id="close_upload_frame" onclick="close_upload_frame()"><hr class="close_a"><hr class="close_b"></div>
            <h2 style="text-align: center; padding-bottom: 10px;">Datei hochladen</h2>
              <form action="" method="post" enctype="multipart/form-data">
              <table class="file_upload">
                <tr><td><?php echo language::file; ?>:</td><td><input name="file" type="file" id="fileA" onchange="fileChange();"/></td></tr>
                <tr><td><?php echo language::filename; ?>:</td><td><div id="fileName"></div></td></tr>
                <tr><td><?php echo language::filesize; ?>:</td><td><div id="fileSize"></div></td></tr>
                <tr><td><?php echo language::filetype; ?>:</td><td><div id="fileType"></div></td></tr>
                <tr><td><?php echo language::process; ?>:</td><td><progress id="progress" style="margin-top:10px" value="0" max="100"></progress> <span id="prozent"></span></td></tr>
                <tr><td><?php echo language::link; ?>:</td><td><a href="#" id="finish"></td></tr>
                <tr><td><input name="upload" value="<?php echo language::upload; ?>" type="button" onclick="uploadFile();" /></td><td><input name="abort" value="<?php echo language::abort; ?>" type="button" onclick="uploadAbort();" /></td></tr>
              </table>   
              </form>
              <table align="right"><tr><td align="right"><section>
                  <div class="checkboxOne">
                    <input type="checkbox" value="1" onchange="upload_notify()" id="checkboxOneInput" name="" />
                    <label for="checkboxOneInput"></label>
                  </div>
              </section></td><td>Benachrichtigung?</td></tr></table>
            </div>
          </div>
          <button onclick="upload_frame()">Datei hochladen</button>
    <?php
    } else {
      echo '<h2 style="text-align: center;">Zugriff verweigert!</h2>';
    }
  }
?>