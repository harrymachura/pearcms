<?php
if (isset($_GET['edit_note'])) {
    $note_id = $_GET["edit_note"];
        
      //Ausgabe einer Notiz aus dem GET ID
    $result_edit_note = $db->query("SELECT * FROM posts WHERE id = '". $note_id ."'");
    $row_edit_note = $result_edit_note->fetchArray();
    ?>
    <p align="center" style="font-size: 32px;">Notiz bearbeitn</p>
    <div class="new_note">
    <script src="codesnippet.js"></script>
    <script src="upload.js"></script>
    <form method="post" action="?save_note">
    <table align="center" width="100%">
      <tr><td>Author: <?php echo $row_edit_note['author']; ?></td></tr>
      <tr><td><input type="text" name="note_title" placeholder="Titel" value="<?php echo str_replace('"', "&quot;", $row_edit_note['title']); ?>"></td></tr>
      <tr><td align="left" style="float: left;"><button onclick="insert_img()" type="button">Image</button><button onclick="insert_audio()" type="button">Audio(MP3)</button><button onclick="insert_video()" type="button">Video(MP4)</button><button onclick="insert_center()" type="button">Center</button></tr>
      <tr><td><textarea name="note_content" placeholder="Inhalt" id="note_content"><?php echo $row_edit_note['content']; ?></textarea></td></tr>
      <tr><td><input type="text" name="note_keywords" placeholder="Keywords" value="<?php echo $row_edit_note['keywords']; ?>"></td></tr>
    </table>
    <button name="save_note" class="pub_button">Speichern</button>
    <input type="hidden" name="note_id" value="<?php echo $row_edit_note['id']; ?>">
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