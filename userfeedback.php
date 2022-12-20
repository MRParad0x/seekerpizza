<!-- HTML form to allow users to select an item and add it to the cart -->
<form id="add-to-cart-form">
  <label for="item-select">Choose an item:</label>
  <select id="item-select">
    <option value="item1">Item 1</option>
    <option value="item2">Item 2</option>
    <option value="item3">Item 3</option>
  </select>
  <button type="submit">Add to Cart</button>
</form>

<!-- PHP code to handle the form submission and add the item to the cart -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start the session
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // If they are logged in, use their user ID as the cart ID
        $cart_id = $_SESSION['user_id'];
    } else {
        // If they are not logged in, use their session ID as the cart ID
        $cart_id = session_id();
    }

    // Check if the cart exists in the session
    if (!isset($_SESSION['cart'][$cart_id])) {
        // If it doesn't exist, create an empty cart
        $_SESSION['cart'][$cart_id] = array();
    }

    // Get the cart from the session
    $cart = &$_SESSION['cart'][$cart_id];

    // Get the selected item from the form
    $selectedItem = $_POST['item-select'];

    // Add the item to the cart
    $index = array_search($selectedItem, $cart);
    if ($index !== false) {
        // If the item is already in the cart, update the quantity
        $cart[$index]['quantity']++;
    } else {
        // If the item is not in the cart, add it
        $cart[] = array(
            'item' => $selectedItem,
            'quantity' => 1,
        );
    }
}
?>

<!-- JavaScript function to handle the form submission and update the cart display -->
<script>
  var form = document.getElementById('add-to-cart-form');
  form.onsubmit = function() {
    // Submit the form using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'cart.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        // If the request was successful, update the cart display
        updateCart();
      } else {
        // If there was an error, show an error message
        alert('Error adding item to cart: ' + xhr.responseText);
      }
    };
    xhr.send(new FormData(form));
  };
</script>