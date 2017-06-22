<?php
if (isset($_GET['plugins'])){
    ?>
    <h1 style="text-align: center;">Plugins</h1>

    <?php
    if (permission("show_plugins") == 1){
      include('classes/plugins_frm.php');
    } else {
       echo '<h2 style="text-align: center;">Zugriff verweigert!</h2>';
    }
    
      
      
    if (permission("show_plugins") == 1){
    ?>
    <script type="text/javascript">
        function show_pop(){
          document.getElementById('popup_bg').style.visibility = "visible";
          document.getElementById('popup_bg').style.opacity = "1";
        }
        function close_pop(){
         var popup = document.getElementById('popup_bg');
         document.getElementById('popup_bg').style.opacity = "0";
         popup.style.visibility = "hidden";
        }
        function show_notify(val) {
        // Get the snackbar DIV
        var x = document.getElementById("notify")
        x.innerHTML = val;
        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }

        function deactive_plugin(src) {
          
        var xhttp = new XMLHttpRequest();

        var url = "classes/plugins_frm.php";
        var params = "deactive_plugin=" + src.value;
        xhttp.open("POST", url, true);
        //Send the proper header information along with the request
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("Content-length", params.length);
        xhttp.setRequestHeader("Connection", "close");

        xhttp.onreadystatechange = function() {//Call a function when the state changes.
          if(xhttp.readyState == 4 && xhttp.status == 200) {
            show_notify(xhttp.responseText);
            if (src.className == 'activate_bt') {
              src.innerHTML = "<?php echo language::activate; ?>";
              src.className = "deactivate_bt";
            } else {
              src.innerHTML = "<?php echo language::deactivate; ?>";
              src.className = "activate_bt";
            }
            

          }
        }
        xhttp.send(params);
        }
    </script>

    <?php
  }
  }
  ?>