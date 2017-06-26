<?php
if (isset($_GET['edit_note'])) {
    if (permission("edit_post") == 1){
      
        $note_id = $_GET["edit_note"];
          
        //Ausgabe einer Notiz aus dem GET ID
      $result_edit_note = $db->query("SELECT * FROM posts WHERE id = '". $note_id ."'");
      $row_edit_note = $result_edit_note->fetchArray();
      $userid = $_SESSION['userid'];
      if (empty($row_edit_note['author'] == $userid)){
        if (permission("edit_other_posts") == 1) {
        
          $result = $db->query("SELECT * FROM users WHERE id = '".$row_edit_note['author']."'");
          $row = $result->fetchArray();
          ?>
          <p align="center" style="font-size: 32px;"><?php echo language::edit_post; ?></p>
          <div class="new_note">
          <script src="codesnippet.js"></script>
          <script src="upload.js"></script>
          <form method="post" action="?save_note">
          <table align="center" width="100%">
            <tr><td><?php echo language::author; ?>: <?php echo $row['username']; ?></td></tr>
            <tr><td><input type="text" name="note_title" placeholder="<?php echo language::title_placeholder; ?>" value="<?php echo str_replace('"', "&quot;", $row_edit_note['title']); ?>"></td></tr>
            <tr><td align="left" style="float: left;"><button onclick="insert_img()" type="button">Image</button><button onclick="insert_audio()" type="button">Audio(MP3)</button><button onclick="insert_video()" type="button">Video(MP4)</button><button onclick="insert_center()" type="button">Center</button></tr>
            <tr><td><textarea name="note_content" placeholder="<?php echo language::content_placeholder; ?>" id="note_content"><?php echo $row_edit_note['content']; ?></textarea></td></tr>
            <tr><td><input type="text" name="note_keywords" placeholder="<?php echo language::keywords_placeholder; ?>" value="<?php echo $row_edit_note['keywords']; ?>"></td></tr>
          </table>
          <button name="save_note" class="pub_button"><?php echo language::save; ?></button>
          <input type="hidden" name="note_id" value="<?php echo $row_edit_note['id']; ?>">
          </form>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
          <table class="file_upload">
            <tr><td><?php echo language::file; ?>:</td><td><input name="file" type="file" id="fileA" onchange="fileChange();"/></td></tr>
            <tr><td><?php echo language::filename; ?>:</td><td><div id="fileName"></div></td></tr>
            <tr><td><?php echo language::filesize; ?>:</td><td><div id="fileSize"></div></td></tr>
            <tr><td><?php echo language::filetype; ?>:</td><td><div id="fileType"></div></td></tr>
            <tr><td><?php echo language::process; ?>:</td><td><progress id="progress" style="margin-top:10px" value="0" max="100"></progress> <span id="prozent"></span></td></tr>
            <tr><td><?php echo language::link; ?>:</td><td><input type="text" id="finish" value=""></td></tr>
            <tr><td><input name="upload" value="<?php echo language::upload; ?>" type="button" onclick="uploadFile();" /></td><td><input name="abort" value="<?php echo language::abort; ?>" type="button" onclick="uploadAbort();" /></td></tr>
          </table>   
          </form>
          <?php
        } else {
          echo '<h2 style="text-align: center;">Du kannst nur deine eigenen Beiträge bearbeiten.</h2>';
        }
      } else {
        $result = $db->query("SELECT * FROM users WHERE id = '".$row_edit_note['author']."'");
          $row = $result->fetchArray();
          ?>
          <p align="center" style="font-size: 32px;"><?php echo language::edit_post; ?></p>
          <div class="new_note">
          <script src="codesnippet.js"></script>
          <script src="upload.js"></script>
          <form method="post" action="?save_note">
          <table align="center" width="100%">
            <tr><td><?php echo language::author; ?>: <?php echo $row['username']; ?></td></tr>
            <tr><td><input type="text" name="note_title" placeholder="<?php echo language::title_placeholder; ?>" value="<?php echo str_replace('"', "&quot;", $row_edit_note['title']); ?>"></td></tr>
            <tr><td align="left" style="float: left;"><button onclick="insert_img()" type="button">Image</button><button onclick="insert_audio()" type="button">Audio(MP3)</button><button onclick="insert_video()" type="button">Video(MP4)</button><button onclick="insert_center()" type="button">Center</button></tr>
            <tr><td><textarea name="note_content" placeholder="<?php echo language::content_placeholder; ?>" id="note_content"><?php echo $row_edit_note['content']; ?></textarea></td></tr>
            <tr><td><input type="text" name="note_keywords" placeholder="<?php echo language::keywords_placeholder; ?>" value="<?php echo $row_edit_note['keywords']; ?>"></td></tr>
          </table>
          <button name="save_note" class="pub_button"><?php echo language::save; ?></button>
          <input type="hidden" name="note_id" value="<?php echo $row_edit_note['id']; ?>">
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
      }
        

      
      } else {
        echo '<h2 style="text-align: center;">Zugriff verweigert!</h2>';
      }
  }
?>