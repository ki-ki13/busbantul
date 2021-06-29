// pergantian navbar
var btnContainer = document.getElementById("navbar");
var btns = btnContainer.getElementsByClassName("btn");

for (var i = 0; i < btns.length; i++){
    btns[i].addEventListener('click',function(){
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active");
        this.className += " active";
    })
}

// Membuka stop pada jalur
var coll = document.getElementsByClassName("jalur");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}