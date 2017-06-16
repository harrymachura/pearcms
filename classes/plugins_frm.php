<?php
if (isset($_POST['deactive_plugin'])){
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
	    		echo "Plugin aktiviert!";
	    	} else {
	    		$db->exec("UPDATE plugins SET name='$plugin_name', active='1' WHERE name='$plugin_name'");
	    		echo "Plugin deaktiviert!";
	    	}
	    	//$db->exec("UPDATE plugins SET name='$plugin_name', active=1");
	    	//echo 'Plugin deaktiviert!';
	    } else {
	    	$db->exec("INSERT INTO plugins (name, active) VALUES ('$plugin_name', 1)");
	    	echo 'Plugin deaktiviert!';
	    }
       // 
    } else {
    	$dirHandle = dir("plugins");
 
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
                  <td><img src="<?php echo "plugins/".$f."/thumb.png" ?>"></td>
                  <td>
                    <table>
                      <tr>
                        <td>Name:</td><td><?php echo $xml->name; ?></td>
                      </tr>
                      <tr>
                        <td>Version:</td><td><?php echo $xml->version; ?></td>
                      </tr>
                      <tr>
                        <td>Entwickler:</td><td><?php echo $xml->developer; ?></td>
                      </tr>
                      <tr>
                        <td>Website:</td><td><?php echo $xml->website; ?></td>
                      </tr>
                      <tr>
                        <td>E-Mail:</td><td><?php echo $xml->mail; ?></td>
                      </tr>
                      <?php 
                          $visible = "Aktivieren";
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
                                $visible = "Deaktivieren";
                                $css_class = 'class="activate_bt"';
                              } else {
                                $visible = "Aktivieren";
                                $css_class = 'class="deactivate_bt"';
                              }
                          } else {
                              $visible = "Deaktivieren";
                              $css_class = 'class="activate_bt"';
                              
                          }

                      ?>
                      <tr><td></td><td><button name="deactive_plugin" <?php echo $css_class; ?> onclick="deactive_plugin(this)" value="<?php echo $f; ?>"><?php 
                      	  echo $visible;
                          ?></button> <button class="delete_bt">löschen</button></td></tr>
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