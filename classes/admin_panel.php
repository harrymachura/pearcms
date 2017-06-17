<div onclick="active_panel()" id="open_panel_bt" title="Admin Panel"></div>
<div id="admin_panel" class="admin_panel">
<a href="admin.php?logout"><div class="logout_bt" title="Logout"></div></a> 
  <div id="close" onclick="panel_hidde()"></div>
  <div style="height: 32px; line-height: 24px; background-color: rgba(100,100,100,.5); display: block; text-align: center; width: 100%;"><span style="line-height: 32px;">Admin Panel</span></div>
    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title"><?php echo $posts; ?><span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?new_note"><?php echo $new_post; ?></a></li>
        <li><a href=""><?php echo $posts; ?></a></li>
        <?php echo event('admin_panel_post_button', ""); ?>
      </ol>
      </span>
    </div>
    
    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title"><?php echo $sites; ?><span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?new_site"><?php echo $new_site; ?></a></li>
        <li><a href=""><?php echo $sites; ?></a></li>
        <?php echo event('admin_panel_site_button', ""); ?>
      </ol>
      </span>
    </div>

    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title"><?php echo $plugins; ?><span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?plugins"><?php echo $show; ?></a></li>
        <li><a href="#"><?php echo $install; ?></a></li>
        <?php echo event('admin_panel_plugin_button', ""); ?>
      </ol>
      </span>
    </div>

    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title"><?php echo $settings; ?><span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?settings"><?php echo $general; ?></a></li>
        <li><a href=""><?php echo $design; ?></a></li>
        <?php echo event('admin_panel_setting_button', ""); ?>
      </ol>
      </span>
    </div> 

    <div class="panel_group">
      <div onclick="toggle(this)" class="group_title"><?php echo $users; ?><span style="float: right;">+</span></div><span class="group_content">
      <ol id="panel_list">
        <li><a href="admin.php?users"><?php echo $users; ?></a></li>
        <li><a href=""><?php echo $groups; ?></a></li>
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