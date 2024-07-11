document.addEventListener("DOMContentLoaded", function () {
  var menuButton = document.getElementById("menuButton");
  var menuList = document.getElementById("menuList");

  menuButton.addEventListener("click", function () {
    menuList.classList.toggle("hidden");
  });
});
