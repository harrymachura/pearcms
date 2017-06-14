      function insert_img() {
       var area = document.getElementById("note_content")
       area.value += "[img][/img]";
        var input = document.getElementById ("note_content");
                input.selectionStart = area.value.length - 6;
                input.selectionEnd = area.value.length - 6;
                input.focus ();
      }

      function insert_audio() {
      	var area = document.getElementById("note_content")
       area.value += '<iframe class="video_frm" src="audio.php?src=" style="border: solid; width: 350px; height: 150px;"></iframe>';
        var input = document.getElementById ("note_content");
                input.selectionStart = area.value.length - 8;
                input.selectionEnd = area.value.length - 8;
                input.focus ();
      }

      function insert_video() {
      	var area = document.getElementById("note_content")
       area.value += '<iframe class="video_frm" src="video.php?src=" style="border: none; width: 720px; height: 360px;"></iframe>';
        var input = document.getElementById ("note_content");
                input.selectionStart = area.value.length - 62;
                input.selectionEnd = area.value.length - 62;
                input.focus ();
      }
      function insert_center() {
      	var area = document.getElementById("note_content")
       area.value += "[center][/center]";
        var input = document.getElementById ("note_content");
                input.selectionStart = area.value.length - 9;
                input.selectionEnd = area.value.length - 9;
                input.focus ();
      }