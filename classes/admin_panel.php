<div onclick="active_panel()" id="open_panel_bt" title="Admin Panel"></div>
<div id="admin_panel" class="admin_panel">
<a href="admin.php?logout"><div class="logout_bt" title="Logout"></div></a> 
  <div id="close" onclick="panel_hidde()"></div>
  <div style="height: 32px; line-height: 24px; background-color: rgba(100,100,100,.5); display: block; text-align: center; width: 100%;"><span style="line-height: 32px;">Admin Panel</span></div>
    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title">Beiträge<span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?new_note">Neuer Beitrag</a></li>
        <li><a href="">Beiträge</a></li>
        <?php echo event('admin_panel_post_button', ""); ?>
      </ol>
      </span>
    </div>
    
    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title">Seiten<span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?new_site">Seite erstellen</a></li>
        <li><a href="">Seiten</a></li>
        <?php echo event('admin_panel_site_button', ""); ?>
      </ol>
      </span>
    </div>

    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title">Plugins<span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?plugins">Anzeigen</a></li>
        <li><a href="#">Installieren</a></li>
        <?php echo event('admin_panel_plugin_button', ""); ?>
      </ol>
      </span>
    </div>

    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title">Einstellungen<span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?settings">Allgemein</a></li>
        <li><a href="">Design</a></li>
        <?php echo event('admin_panel_setting_button', ""); ?>
      </ol>
      </span>
    </div> 

    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title">Benutzer<span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?settings">Benutzer</a></li>
        <li><a href="">Gruppen</a></li>
        <?php echo event('admin_panel_user_button', ""); ?>
      </ol>
      </span>
    </div> 
</div>
<script type="text/javascript">
  function active_panel(){
    var panel = document.getElementById('admin_panel');
    var active_panel_bt = document.getElementById('open_panel_bt');
    open_panel_bt.style.opacity = "0";
    panel.style.left = "0";
    panel.style.boxShadow = "0px 0px 20px #000";
    panel.style.borderRightWidth = "1px";
    panel.style.opacity = "1";
    panel.focus();
  }
  function panel_hidde(){
    var panel = document.getElementById('admin_panel');
    panel.style.left = "-300px";
    panel.style.boxShadow = "none";
    panel.style.borderRightWidth = "0px";
    panel.style.opacity = "0";
    open_panel_bt.style.opacity = "1";
  }
  

  function toggle(obj){
    
    if (obj.nextSibling.style.display == "block") {
      obj.nextSibling.style.display = "none";
      obj.children[0].innerHTML = "+";
    } else {
      obj.nextSibling.style.display = "block";
      obj.children[0].innerHTML = "-";
    }
  }
</script>