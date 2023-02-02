/* Start Order Status color change Function */

const collection = document.getElementsByClassName("status_color");

for (let i = 0; i < collection.length; i++) {
  if (collection[i].innerHTML == "Completed") {
    collection[i].style.backgroundColor = "#29a64f";
  } else if (collection[i].innerHTML == "Ready") {
    collection[i].style.backgroundColor = "#389bc9";
  } else if (collection[i].innerHTML == "Preparing") {
    collection[i].style.backgroundColor = "#b8892a";
  } else if (collection[i].innerHTML == "Refunded") {
    collection[i].style.backgroundColor = "#e8701a";
  } else if (collection[i].innerHTML == "Cancelled") {
    collection[i].style.backgroundColor = "#FF4069";
  } else {
    collection[i].style.backgroundColor = "#856bbf";
  }
}

/* End Order Status color change Function */
