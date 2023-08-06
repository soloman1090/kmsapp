var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
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
  const availableHeight = window.innerHeight - navbar.offsetHeight;
  content.style.height = `${availableHeight}px`;
});
