// let navbar = document.querySelector('.header .flex .navbar');

// document.querySelector('#menu-btn').onclick = () =>{
//    navbar.classList.toggle('active');
// }

// window.onscroll = () =>{
//     navbar.classList.remove('active');
// };

/* Start Slider functions */

// function openCart() {
//   // document.getElementById("disabled").disabled = true;
//   setTimeout(openNav, 3000);
// }

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

let slides = document.querySelectorAll(
  ".home-bg .home .slider-container .slide"
);
let index = 0;

function next() {
  slides[index].classList.remove("active");
  index = (index + 1) % slides.length;
  slides[index].classList.add("active");
}

function prev() {
  slides[index].classList.remove("active");
  index = (index - 1 + slides.length) % slides.length;
  slides[index].classList.add("active");
}

/* End Slider functions */

/* Start Home Page Tabbed Food Menu */

function openFood(event, categoryName) {
  var i, x, tabs;
  x = document.getElementsByClassName("tab-content");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tabs = document.getElementsByClassName("tab");
  for (i = 0; i < x.length; i++) {
    tabs[i].className = tabs[i].className.replace(" tab-active", "");
  }
  document.getElementById(categoryName).style.display = "block";
  event.currentTarget.className += " tab-active";
}

/* End Home Page Tabbed Food Menu*/

/* Start Home Page Tabbed Main Menu */

function clickMenu(event) {
  var i, tabs;
  tabs = document.getElementsByClassName("target");
  for (i = 0; i < tabs.length; i++) {
    tabs[i].className = tabs[i].className.replace(" active", "");
  }

  event.currentTarget.className += " active";
}

function load() {
  if (url == "contact.php") {
    var element = document.getElementById("activecontact");
    element.classList.add("active");
  } else if (url == "index.php") {
    var element = document.getElementById("activehome");
    element.classList.add("active");
  }
}

/* End Home Page Tabbed Main Menu*/

/* Start Cart functions */

let cart = document.querySelector(".shopping-cart");

document.querySelector("#cart-btn").onclick = () => {
  cart.classList.add("active");
};

document.querySelector("#close-cart").onclick = () => {
  cart.classList.remove("active");
};

document.querySelector("#csbtn").onclick = () => {
  cart.classList.remove("active");
};

/* End Cart functions */
