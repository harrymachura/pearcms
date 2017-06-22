<?php

if (isset($_POST['deactive_plugin'])){
    include('../config.php');
    include('../language/'.$language.'.php');
		$db = new SQLite3('../database/db.sqlite');
		$plugin_name = $_POST['deactive_plugin'];
		$exist_plugin = $db->query("SELECT COUNT(*) as count FROM plugins WHERE name = '$plugin_name'");
		$row = $exist_plugin->fetchArray();
		$numRows = $row['count'];
	    if ($numRows > 0){
	    	$select_plugin = $db->query("SELECT * FROM plugins WHERE name = '$plugin_name'");
	    	$select_plugin_arr = $select_plugin->fetchArray();
	    	if ($select_plugin_arr['active'] > 0) {
	    		$db->exec("UPDATE plugins SET name='$plugin_name', active='0' WHERE name='$plugin_name'");
	    		echo language::plugin_activate;
	    	} else {
	    		$db->exec("UPDATE plugins SET name='$plugin_name', active='1' WHERE name='$plugin_name'");
	    		echo language::plugin_deactivate;
	    	}
	    } else {
	    	$db->exec("INSERT INTO plugins (name, active) VALUES ('$plugin_name', 1)");
	    	echo language::plugin_deactivate;
	    }
       // 
    } else {
    	$dirHandle = dir("plugins");
 ?>
              <div class="popup_bg" id="popup_bg">
                <div class="popup_frm">Test
                <button onclick="close_pop()" style="position: absolute; right: 5px; top: 5px; height: 22px; width: 22px; font-size: 14px;">X</button>
                </div>
              </div>
  <?php
    // Verzeichnis Datei für Datei lesen
    while (($f = $dirHandle->read()) != false) {
       // Nur ausgeben, wenn nicht . oder ..
        if ($f != "." && $f != ".."){
            // Wenn es sich um ein Verzeichnis handelt
            if (!is_dir("files/".$f)){
              $xml=simplexml_load_file("plugins/".$f."/info.xml");
              ?>
              <table class="plugin_container">
                <tr>
                  <td align="center"><img src="<?php echo "plugins/".$f."/thumb.png" ?>"></td>
                  <td>
                    <table>
                      <tr>
                        <td><?php echo language::name; ?>:</td><td><?php echo $xml->name; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo language::version; ?>:</td><td><?php echo $xml->version; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo language::developer; ?>:</td><td><?php echo $xml->developer; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo language::website; ?>:</td><td><a href="http://<?php echo $xml->website; ?>" target="_blank"><?php echo $xml->website; ?></a></td>
                      </tr>
                      <tr>
                        <td><?php echo language::e_mail; ?>:</td><td><?php echo $xml->mail; ?></td>
                      </tr>
                      <?php 
                          $visible = language::activate;
                          $css_class = 'class="activate_bt"';
                          $check_visible = $db->query("SELECT COUNT(*) as count FROM plugins WHERE name = '$f'");
                          $visible_row = $check_visible->fetchArray();
                          //Überprüfen ob das Plugin registriert wurde
                          if ($visible_row['count'] > 0) {
                              //Überprüfen ob das Plugin aktiviert oder deaktiviert ist
                              $get_plugin = $db->query("SELECT * FROM plugins WHERE name = '$f'");
                              $get_plugin_arr = $get_plugin->fetchArray();
                              if ($get_plugin_arr['active'] == 0){
                                //Plugin ist aktiviert
                                $visible = language::deactivate;
                                $css_class = 'class="activate_bt"';
                              } else {
                                $visible = language::activate;
                                $css_class = 'class="deactivate_bt"';
                              }
                          } else {
                              $visible = language::deactivate;
                              $css_class = 'class="activate_bt"';                  
                          }
                      ?>
                      <tr><td></td><td><?php if (permission("visibility_plugins") == 1){ ?><button name="deactive_plugin" <?php echo $css_class; ?> onclick="deactive_plugin(this)" value="<?php echo $f; ?>"><?php 
                      	  echo $visible;
                          ?></button><?php } ?> <?php if (permission("remove_plugins") == 1){ ?><button class="delete_bt" onclick="show_pop(this)" value="<?php echo $f; ?>"><?php echo language::delete; ?></button><?php } ?></td></tr>
                    </table>
                  </td>
                </tr>
              </table>
              <?php      
            }
        }
    }
    // Verzeichnis wieder schließen
    $dirHandle->close();
    }
?>