/* Start Backend Tabbed Menu */

var btnContainer = document.getElementById("navid");

var btns = btnContainer.getElementsByClassName("menubtn");

for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

/* End Backend Tabbed Menu*/

/* Start Add Popup Button Function */

var blur = document.getElementById("blur");
var popupone = document.getElementById("popupone");
var popuptwo = document.getElementById("popuptwo");
var popupthree = document.getElementById("popupthree");
var popupfour = document.getElementById("popupfour");

function closePopup() {
  var blur = document.getElementById("blur");
  var popupone = document.getElementById("popupone");
  popupone.classList.remove("active");
  blur.classList.remove("active");
}

function openPopup() {
  var blur = document.getElementById("blur");
  var popupone = document.getElementById("popupone");
  blur.classList.toggle("active");
  popupone.classList.toggle("active");
}

function submitPopup() {
  // popuptwo.classList.toggle("active");
  // window.open("/product.php", "_blank");
}

/* End Add Popup Button Function */

function regform() {
  var popuptwo = document.getElementById("popuptwo");
  popuptwo.classList.toggle("active");
}

function okay() {
  var popuptwo = document.getElementById("popuptwo");
  popuptwo.classList.remove("active");
}

/* Start update Popup Button Function */

function updatePopup() {
  var blur = document.getElementById("blur");
  var popupthree = document.getElementById("popupthree");
  blur.classList.toggle("active");
  popupthree.classList.toggle("active");
}

function closeUpdatePopup() {
  var blur = document.getElementById("blur");
  var popupthree = document.getElementById("popupthree");
  popupthree.classList.remove("active");
  blur.classList.remove("active");
}

/* End update Popup Button Function */

/* Start View order Popup Button Function */

function vieworderPopup() {
  var blur = document.getElementById("blur");
  var popupfour = document.getElementById("popupfour");
  blur.classList.toggle("active");
  popupfour.classList.toggle("active");
}

function closeViewOrderPopup() {
  var blur = document.getElementById("blur");
  var popupfour = document.getElementById("popupfour");
  popupfour.classList.remove("active");
  blur.classList.remove("active");
}

/* End View order update Popup Button Function */

const params = new URLSearchParams(window.location.search);
const update = params.get("update");
const vieworder = params.get("vieworder");

if (update) {
  setTimeout(updatePopup, 100);
} else if (vieworder) {
  setTimeout(vieworderPopup, 100);
}

$(document).ready(function () {
  $("#search").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#pltable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});

/* Start Update Popup Button Function */

/* Start Add File Upload Image Preview Function */

function showPreview(event) {
  if (event.target.files.length > 0) {
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("add-file-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}

/* End Add File Upload Image Preview Function */

/* Start Update File Upload Image Preview Function */

function updateShowPreview(event) {
  if (event.target.files.length > 0) {
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("update-file-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}

/* End Update File Upload Image Preview Function */
