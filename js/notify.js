let code = document.getElementById("notifymsg").innerHTML;
if (code.includes("#OID")) {
  var icon = document.getElementById("notifyicon");
  icon.classList.toggle("active");
}
