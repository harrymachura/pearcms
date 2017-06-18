function create_user(){
        var xhttp = new XMLHttpRequest();
        var status = document.getElementById('create_status');
        status.style.animation = "fadein 1s";
        var username = document.getElementById('username').value;
        var display_name = document.getElementById('name').value;
        var mail = document.getElementById('mail').value;
        var password = document.getElementById('password').value;
        var group = document.getElementById('group').value;

        var url = "classes/user_function.php";
        var params = "create_user&username=" + username + "&display_name=" + display_name + "&mail=" + mail + "&password=" + SHA512(password).toUpperCase() + "&group=" + group;
        if (password.length > 7) {
          xhttp.open("POST", url, true);
          //Send the proper header information along with the request
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.setRequestHeader("Content-length", params.length);
          xhttp.setRequestHeader("Connection", "close");
        } else {
          status.innerHTML = 'Das Passwort muss mindestens 8 Zeichen enthalten!';
          setTimeout(fadeout_error, 1000);
        }
        

        xhttp.onreadystatechange = function() {//Call a function when the state changes.
          if(xhttp.readyState == 4 && xhttp.status == 200) {
            switch(xhttp.responseText){
              case '0':
                status.innerHTML = '<span style="color: green;">Benutzer erstellt!</span>';
                setTimeout(fadeout, 1000);
              break;

              case '1':
                status.innerHTML = '<span style="color: red;">Die E-Mail ist nicht korrekt!</span>';
                setTimeout(fadeout_error, 1000);
              break;

              case '2':
                status.innerHTML = '<span style="color: red;">Der Benutzername ist zu kurz.</span>';
                setTimeout(fadeout_error, 1000);
              break;

              case '3':
                status.innerHTML = '<span style="color: red;">Benutzer existiert bereits!</span>';
                setTimeout(fadeout_error, 1000);
              break;
            }
            
          }
        }
        xhttp.send(params);

        
      }

      function delete_user(username){
        var xhttp = new XMLHttpRequest();
        var url = "classes/user_function.php";
        var params = "delete_user=" + username.value;
          xhttp.open("POST", url, true);
          //Send the proper header information along with the request
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.setRequestHeader("Content-length", params.length);
          xhttp.setRequestHeader("Connection", "close");        

        xhttp.onreadystatechange = function() {//Call a function when the state changes.
          if(xhttp.readyState == 4 && xhttp.status == 200) {
            switch(xhttp.responseText){
              case '0':
                close_delete();
                var list_name = username.value + "_list";
                document.getElementById(list_name).remove();
              break;

              case '1':
              break;
            }
            
          }
        }
        xhttp.send(params);
      }
      function fadeout_error(){
        var status = document.getElementById('create_status');
        status.style.animation = "fadeout 1s";
        status.style.opacity = "0";
      }
      function fadeout(){
        var status = document.getElementById('create_status');
        status.style.animation = "fadeout 1s";
        status.style.opacity = "0";
        setTimeout(close_pop,1000);
        setTimeout(page_reload,1200);
      }
      function page_reload(){
        var username = document.getElementById('username').value;
        var display_name = document.getElementById('name').value;
        var mail = document.getElementById('mail').value;
        var password = document.getElementById('password').value;
        var group = document.getElementById('group').options[document.getElementById('group').selectedIndex].text;
        document.getElementById('user_list').innerHTML += '<tr id="' + username + '_list"><td>' + username + '<br><a href="?edit_user=' + username + '"><button>Bearbeiten</button></a> <button onclick="delete_popup(this)" value="' + username + '">Löschen</button></td><td>' + display_name + '</td><td>' + mail + '</td><td>' + group + '</td></tr>';
      }
      function show_pop(){
          document.getElementById('popup_bg').style.visibility = "visible";
          document.getElementById('popup_bg').style.opacity = "1";
        }
        function close_pop(){
         var popup = document.getElementById('popup_bg');
         document.getElementById('popup_bg').style.opacity = "0";
         popup.style.visibility = "hidden";
         
        }
        function delete_popup(user_id){
          document.getElementById('user_del').style.visibility = "visible";
          document.getElementById('user_del').style.opacity = "1";
          document.getElementById('pop_del').innerHTML = '<div style="font-size: 22px; padding-bottom: 20px; text-align: center;">Möchtest du wirklich <b>' + user_id.value + '</b> löschen?</div><div style="text-align: center; margin-bottom: 0; position: relativ;"><button style="width: 80px;" value="' + user_id.value + '" onclick="delete_user(this)">Ja</button> <button style="width: 80px;" onclick="close_delete()">Nein</button></div>';
        }

        function close_delete(){
          var popup_delete = document.getElementById('user_del');
          document.getElementById('user_del').style.opacity = "0";
          popup_delete.style.visibility = "hidden";
        }