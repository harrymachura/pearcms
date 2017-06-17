var a = document.getElementById('a');
var b = document.getElementById('b');
  function rotate(){
    a.className = "a";
    b.className = "b";
    var content = document.getElementById('menu_content');
    
    if (content.style.visibility == "visible"){
    a.className = "a_clear";
    b.className = "b_clear";
    content.style.left = "-81%";
    content.style.boxShadow = "0px 0px 0px #000";
    content.style.visibility = "hidden";
    content.style.opacity = "0";
    } else {
    content.style.left = "0";
    content.style.boxShadow = "0px 10px 20px #000";
    content.style.visibility = "visible";
    content.style.opacity = "1";
    }
  }