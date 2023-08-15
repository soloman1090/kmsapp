var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

window.onload = function () {
  let button = document.getElementById("btnn");
  let item = document.getElementById("myCont");

  button.onclick = function () {
    if (item.style.display === "block") {
      item.style.display = "none";
    }
  }


}

document.addEventListener('DOMContentLoaded', () => {
  const navbar = document.getElementById('upHeader');
  const content = document.getElementById('overContent');
  const secondavailableHeight = window.innerHeight - 200
  const availableHeight = secondavailableHeight - navbar.offsetHeight;
  content.style.height = `${availableHeight}px`;
});


var prevPage = "";
var currPage = "";

function showhide(event) {
  prevPage = currPage;
  currPage = event.id.split("_")[1];
  if (prevPage !== currPage) {
    showEle(currPage);
    if (prevPage !== '') {
      hideEle(prevPage);
    }
  } else if (prevPage === currPage) {
    showEle(currPage);
  } else {
    toggle(currPage);
  }
}

function toggle(id) {
  var curr = document.getElementById(id);
  if (curr.style.display === 'block') {
    curr.style.display = 'none';
    // updateBtn('btn_'+id, '');
  } else {
    curr.style.display = 'block';
    // updateBtn('btn_'+id, '');
  }

}

function updateBtn(id, newStr) {
  var btn = document.getElementById(id);
  btn.innerHTML = newStr + ' ' + btn.innerHTML.split(' ')[1];
}

function showEle(id) {
  document.getElementById(id).style.display = 'block';
  // updateBtn('btn_'+id,'');
}

function hideEle(id) {
  document.getElementById(id).style.display = 'none';
  // updateBtn('btn_'+id, '');
}

var data = document.getElementById("datta");
let botBtn1 = document.getElementById("btn_vise");

botBtn1.onclick = function () {
  if (data.style.display === "block") {
    data.style.display = "none";
  }
}


$(document).ready(function () {

  $("#theTarget").skippr();
  console.log("The target")

});


// Defaults   
$("#theTarget").skippr({

  transition: 'slide',
  speed: 1000,
  easing: 'easeOutQuart',
  navType: 'block',
  childrenElementType: 'div',
  arrows: true,
  autoPlay: false,
  autoPlayDuration: 5000,
  keyboardOnAlways: true,
  hidePrevious: false

});