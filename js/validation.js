var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm_password");

function validatePassword() {
  if (password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords do not Match");
  } else {
    confirm_password.setCustomValidity("");
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

var phone_input = document.getElementById("checkNumber");

phone_input.addEventListener("input", () => {
  phone_input.setCustomValidity("");
  phone_input.checkValidity();
});

phone_input.addEventListener("invalid", () => {
  if (phone_input.value === "") {
    phone_input.setCustomValidity("Please enter the phone number");
  } else {
    phone_input.setCustomValidity(
      "Please enter the phone number in this format: 0778523659"
    );
  }
});

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

var nic_input = document.getElementById("checkNIC");

nic_input.addEventListener("input", () => {
  nic_input.setCustomValidity("");
  nic_input.checkValidity();
});

nic_input.addEventListener("invalid", () => {
  if (nic_input.value === "") {
    nic_input.setCustomValidity("Please enter NIC number");
  } else {
    nic_input.setCustomValidity(
      "Please enter the NIC in this format: 952632143V 0r 9526321432345"
    );
  }
});
