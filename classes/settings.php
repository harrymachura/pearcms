<?php
if(isset($_GET['settings'])){
  if (permission("edit_settings") == 1){
    ?>
    <h2 style="text-align: center;"><?php echo language::settings; ?></h2>
    <table width="80%" align="center">
      <tr>
        <td><?php echo language::site_title; ?>:</td><td><input type="text" id="site_title" name="site_title" value="<?php echo get_header('title'); ?>"></td>
      </tr>
      <tr>
        <td><?php echo language::site_description; ?>:</td><td><input type="text" id="site_description" name="site_description" value="<?php echo get_header('description'); ?>"></td>
      </tr>
      <tr>
        <td><?php echo language::e_mail_adress; ?>:</td><td><input type="email" id="admin_mail" name="admin_mail" value="<?php echo get_header('admin_mail'); ?>"></td>
      </tr>
      <tr>
        <td><?php echo language::theme; ?>:</td><td><select id="theme" name="theme">
          <?php
          $get_theme = $db->query("SELECT * FROM options WHERE id='1'");
          $get_current_theme = $get_theme->fetchArray();
          foreach (glob("themes/*", GLOB_ONLYDIR) as $filename) {
            $sp = explode("/", $filename);
            if ($sp[1] == $get_current_theme['theme']){
              echo '<option value="'.$sp[1].'" selected>'.$sp[1].'</option>'."\n";
            } else {
              echo '<option value="'.$sp[1].'">'.$sp[1].'</option>'."\n";
            }
              
            }
            
          ?>
        </select></td>
      </tr>
      <tr><td><?php echo language::startsite; ?>:</td><td>
      <select id="start_page">
      <?php 
      $get_sites = $db->query("SELECT * FROM pages");
      $get_current_page = $db->query("SELECT * FROM options WHERE id='1'");
      $curr_arr = $get_current_page->fetchArray();
      while ($row = $get_sites->fetchArray()) {
        if ($row['id'] == $curr_arr['start_site']){
          echo '<option value="'.$row['id'].'" selected>'.$row['title'].'</option>'."\n";
        } else {
          echo '<option value="'.$row['id'].'">'.$row['title'].'</option>'."\n";
        }
        
      }
      ?>
      </select>
      </td></tr>
    </table>
    <button style="position: relative; display: block; margin-left: auto; margin-right: auto;" onclick="save_settings(this)" value="Gespeichert"><?php echo language::save; ?></button>
    <script type="text/javascript">
        function show_notify(val) {
        // Get the snackbar DIV
        var x = document.getElementById("notify")
        x.innerHTML = val;
        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }

        function save_settings(src) {
          
        var xhttp = new XMLHttpRequest();
        var site_title = document.getElementById('site_title');
        var site_description = document.getElementById('site_description');
        var admin_mail = document.getElementById('admin_mail');
        var thme = document.getElementById('theme');
        var start_page = document.getElementById('start_page');
        var url = "classes/save_settings.php";
        var params = "site_title=" + site_title.value + "&site_description=" + site_description.value + "&admin_mail=" + admin_mail.value + "&theme=" + theme.value + "&start_page=" + start_page.value;
        xhttp.open("POST", url, true);
        //Send the proper header information along with the request
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("Content-length", params.length);
        xhttp.setRequestHeader("Connection", "close");

        xhttp.onreadystatechange = function() {//Call a function when the state changes.
          if(xhttp.readyState == 4 && xhttp.status == 200) {
            show_notify(xhttp.responseText);
          }
        }
        xhttp.send(params);
        }
    </script>

    
    <?php
  } else {
    echo '<h2 style="text-align: center;">Zugriff verweigert!</h2>';
  }
  }
?>