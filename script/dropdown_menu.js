var a = document.getElementById('a');
var b = document.getElementById('b');
  function rotate(){
    a.className = "a";
    b.className = "b";
    var content = document.getElementById('menu_content');
    content.style.left = "0";
    content.style.boxShadow = "0px 10px 20px #000";
    content.style.visibility = "visible";
  }
  function clear_menu(){
    a.className = "a_clear";
    b.className = "b_clear";
    var content = document.getElementById('menu_content');
    content.style.left = "-81%";
    content.style.boxShadow = "0px 0px 0px #000";
    content.style.visibility = "hidden";
  }