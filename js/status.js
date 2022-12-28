/* Start Order Status color change Function */

var color = document.getElementById("status_color").innerText;
var i;
switch (true) {
  case color == "Completed":
    document.getElementById("status_color").style.background = "#29a64f";
    break;
  case color == "Ready":
    document.getElementById("status_color").style.background = "#389bc9";
    break;
  case color == "Preparing":
    document.getElementById("status_color").style.background = "#b8892a";
    break;
  case color == "Refunded":
    document.getElementById("status_color").style.background = "#e8701a";
    break;
  case color == "Cancelled":
    document.getElementById("status_color").style.background = "#FF4069";
    break;
  default:
    document.getElementById("status_color").style.background = "#856bbf";
}

/* End Order Status color change Function */
