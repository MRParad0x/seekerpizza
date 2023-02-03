<?php

include 'conn.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $ssid = session_id();
} else {
    $user_id = '';
    $ssid = session_id();
}

$discount = 0;
$_SESSION['discount'] = 0;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Order Confirmation</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/orderconfirmed.css'>

    <!-- favicon file link  -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- google custom font link  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- google poppins font link  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


</head>

<body>

<div class="body-layout">
<section class="flex">

    <!-- header -->

    <header class="header">

        <div class="site-logo">
        <img onclick="imageClicked()" src="img/logovertical.png" alt="">
        </div>

    </header>

    <div class="content">
        <div class="content-container">
            <div class="content-box">
                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_rXwz8k6MJO.json"  background="rgba(255, 255, 255, 0)"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                <h1>Your Order Has Been Received !<br/>Working on it now...</h1>
                <p>Thank you for your purchase !</p>
                <p>Your Order No : <?php echo $_SESSION['uuid']; ?></php></p>
                <p>Your will receive an order confirmation email with details of your order.</p>
                <button onclick="location.href='/dashboard.php';">Go to My Account</button>
                <button onclick="location.href='/index.php';">Continue Shopping</button>
            </div>

            <div class="order-confirm-container">
                <h2>Order Details</h2>

            <div class="table-container">
			<table id="orderconfirm" class="order-confirm-table">
				<thead>
					<tr>
						<th>Item</th>
                        <th>Qty</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php

$show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, order_items.orderitemsQty, order_items.orderitemsTotal from products INNER JOIN order_items ON products.productId = order_items.productId WHERE orderId = ?");
$show_products->execute([$_SESSION['uuid']]);

if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

					<tr>
                        <td><?=$fetch_products['productName'];?></td>
                        <td><?=$fetch_products['orderitemsQty'];?></td>
						<td><?=$fetch_products['orderitemsTotal'];?></td>
					</tr>
        <?php
}
}
?>
				</tbody>
			</table>
            </div>

            <div class="cart-subtotal-container">
            <hr>
        <div class="cart-subtotal">

<?php
$show_subtotal = $conn->prepare("SELECT sum(order_items.orderitemsTotal) as subtotal from order_items WHERE orderId = ?");
$show_subtotal->execute([$_SESSION['uuid']]);
if ($show_subtotal->rowCount() > 0) {
    while ($fetch_subtotal = $show_subtotal->fetch(PDO::FETCH_ASSOC)) {
        $subtotal = $fetch_subtotal['subtotal'];
    }
    {?>
        <p>Subtotal</p>
        <p class="bold">LKR <?php echo $subtotal; ?></p>

<?php
}
}
?>
        </div>

        <?php
$show_discount = $conn->prepare("SELECT orderDiscount as discount, orderTotal as total from sp_order WHERE orderId = ?");
$show_discount->execute([$_SESSION['uuid']]);
if ($show_discount->rowCount() > 0) {
    while ($fetch_discount = $show_discount->fetch(PDO::FETCH_ASSOC)) {
        $discount = $fetch_discount['discount'];
        $total = $fetch_discount['total'];
    }
    if ($discount > 0) {?>

        <div class="cart-discount">
        <p>Discount</p>
        <p class="bold"><?php echo '- LKR ' . $discount; ?></p>
        </div>

<?php }?>

        <div class="cart-delivery">
        <p>Delivery</p>
        <p class="bold">Pickup</p>
        </div>

        <hr>

        <div class="cart-total">
        <p>Total</p>
        <p class="bold"><?php echo 'LKR ' . $total ?></p>
        </div>

<?php
}
?>

        </div>

        </div>

    </div>
</div>

</section>
</div>

    <!-- custom js file link  -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
   function imageClicked() {
    window.open("index.php", "_self");
   	}
</script>

</body>

</html>
