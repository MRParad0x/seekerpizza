<?php

include 'conn.php';

session_start();

$_SESSION['redirectcheckout'] = $_SERVER['REQUEST_URI'];

if (isset($_SESSION['roleType'])) {
    $ssid = session_id();
    $userNIC = $_SESSION['userNIC'];
} else {
    $ssid = session_id();
}
$discount = 0;
$_SESSION['discount'] = 0;

if (isset($_POST['submit'])) {

    $uuid = $_POST['uuid'];
    $uuid = filter_var($uuid, FILTER_UNSAFE_RAW);
    $_SESSION['uuid'] = $uuid;
    $orderTotal = $_SESSION['orderTotal'];
    $orderStatus = 'Processing';
    $orderDiscount = $_POST['discount'];
    $orderDiscount = filter_var($orderDiscount, FILTER_UNSAFE_RAW);

    $insert_order = $conn->prepare("INSERT INTO sp_order (orderId, userNIC, orderDiscount, orderTotal, orderStatus) VALUES(?,?,?,?,?)");
    $insert_order->execute([$uuid, $userNIC, $orderDiscount, $orderTotal, $orderStatus]);
    $regcreate[] = 'Great! <br> Your account has been successfully created.';

    $show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productImage, cart_item.cartitemId, cart_item.cartitemQty, cart_item.sessionId, coupon.couponCode, coupon.couponDiscount, products.productPrice*cart_item.cartitemQty as subtotal from cart_item INNER JOIN products ON cart_item.productId = products.productId INNER JOIN coupon ON coupon.couponId = products.couponId WHERE cart_item.sessionId = ? ");
    $show_products->execute([$ssid]);
    if ($show_products->rowCount() > 0) {
        while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {

            $cartitemIdd = $fetch_products['cartitemId'];
            $sessionId = $fetch_products['sessionId'];
            $productId = $fetch_products['productId'];
            $productId = filter_var($productId, FILTER_UNSAFE_RAW);
            $orderitemsQty = $fetch_products['cartitemQty'];
            $orderitemsQty = filter_var($orderitemsQty, FILTER_UNSAFE_RAW);
            $orderitemsTotal = $fetch_products['subtotal'];
            $orderitemsTotal = filter_var($orderitemsTotal, FILTER_UNSAFE_RAW);

            $insert_order_items = $conn->prepare("INSERT INTO order_items (orderId, productId, orderitemsQty, orderitemsTotal) VALUES(?,?,?,?)");
            $insert_order_items->execute([$uuid, $productId, $orderitemsQty, $orderitemsTotal]);
        }
        $delete_cart_item = $conn->prepare("DELETE FROM cart_item WHERE sessionId = ? ");
        $delete_cart_item->execute([$sessionId]);
    }

    $delete_cart_item = $conn->prepare("DELETE FROM shopping_session WHERE ssId = ?");
    $delete_cart_item->execute([$sessionId]);
    header('location:orderconfirmed.php');
}

if (isset($_POST['guest'])) {

    $uuid = $_POST['uuid'];
    $uuid = filter_var($uuid, FILTER_UNSAFE_RAW);
    $_SESSION['uuid'] = $uuid;
    $orderTotal = $_SESSION['orderTotal'];
    $orderStatus = 'Processing';
    $orderDiscount = $_POST['discount'];
    $orderDiscount = filter_var($orderDiscount, FILTER_UNSAFE_RAW);
    $guestFName = $_POST['guestFName'];
    $guestFName = filter_var($guestFName, FILTER_UNSAFE_RAW);
    $guestLName = $_POST['guestLName'];
    $guestLName = filter_var($guestLName, FILTER_UNSAFE_RAW);
    $guestAddress = $_POST['guestAddress'];
    $guestAddress = filter_var($guestAddress, FILTER_UNSAFE_RAW);
    $guestCity = $_POST['guestCity'];
    $guestCity = filter_var($guestCity, FILTER_UNSAFE_RAW);
    $guestPostalCode = $_POST['guestPostalCode'];
    $guestPostalCode = filter_var($guestPostalCode, FILTER_UNSAFE_RAW);
    $guestNumber = $_POST['guestNumber'];
    $guestNumber = filter_var($guestNumber, FILTER_UNSAFE_RAW);
    $gid = $_POST['gid'];
    $gid = filter_var($gid, FILTER_UNSAFE_RAW);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_UNSAFE_RAW);

    $insert_order_items = $conn->prepare("INSERT INTO guest (guestNIC, guestEmail, guestFName, guestLName, guestAddress, guestCity, guestPostalCode, guestNumber) VALUES(?,?,?,?,?,?,?,?)");
    $insert_order_items->execute([$gid, $email, $guestFName, $guestLName, $guestAddress, $guestCity, $guestPostalCode, $guestNumber]);

    $insert_order = $conn->prepare("INSERT INTO sp_order (orderId, guestNIC, orderDiscount, orderTotal, orderStatus) VALUES(?,?,?,?,?)");
    $insert_order->execute([$uuid, $gid, $orderDiscount, $orderTotal, $orderStatus]);
    $regcreate[] = 'Great! <br> Your account has been successfully created.';

    $show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productImage, cart_item.cartitemId, cart_item.cartitemQty, cart_item.sessionId, coupon.couponCode, coupon.couponDiscount, products.productPrice*cart_item.cartitemQty as subtotal from cart_item INNER JOIN products ON cart_item.productId = products.productId INNER JOIN coupon ON coupon.couponId = products.couponId WHERE cart_item.sessionId = ? ");
    $show_products->execute([$ssid]);
    if ($show_products->rowCount() > 0) {
        while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {

            $cartitemIdd = $fetch_products['cartitemId'];
            $sessionId = $fetch_products['sessionId'];
            $productId = $fetch_products['productId'];
            $productId = filter_var($productId, FILTER_UNSAFE_RAW);
            $orderitemsQty = $fetch_products['cartitemQty'];
            $orderitemsQty = filter_var($orderitemsQty, FILTER_UNSAFE_RAW);
            $orderitemsTotal = $fetch_products['subtotal'];
            $orderitemsTotal = filter_var($orderitemsTotal, FILTER_UNSAFE_RAW);

            $insert_order_items = $conn->prepare("INSERT INTO order_items (orderId, productId, orderitemsQty, orderitemsTotal) VALUES(?,?,?,?)");
            $insert_order_items->execute([$uuid, $productId, $orderitemsQty, $orderitemsTotal]);
        }
        $delete_cart_item = $conn->prepare("DELETE FROM cart_item WHERE sessionId = ? ");
        $delete_cart_item->execute([$sessionId]);
    }

    $delete_cart_item = $conn->prepare("DELETE FROM shopping_session WHERE ssId = ?");
    $delete_cart_item->execute([$sessionId]);
    header('location:orderconfirmed.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Checkout</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/checkout.css'>

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

<body onload="apply()">

<div class="body-layout">
<section class="flex">

    <!-- header -->

    <header class="header">

        <div class="site-head">
            <div class="site-logo">
            <img onclick="imageClicked()" src="img/logovertical.png" alt="">
            </div>
            <div class="user-name">
<?php
if (isset($_SESSION['roleType'])) {
    $user_id = $_SESSION['roleType'];
    echo "<i class=\"fa-solid fa-user\"></i><p>Hi ";
    echo $_SESSION['userFName'];
    echo ",</p>";
}
?>
            </div>
        </div>

    </header>

    <div class="content">

        <div class="section-one">
        <div class="section-one-container">

        <div class="notify-msg">

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<span id="success" class="success-msg">' . $message . '</span>';
    }
}
if (isset($error)) {
    foreach ($error as $error) {
        echo '<span id="error" class="error-msg">' . $error . '</span>';
    }
}
?>
        </div>

<?php
if (isset($userNIC) && ($userNIC !== null)) {
    $show_user_address = $conn->prepare("SELECT * FROM user WHERE userNIC = ? ");
    $show_user_address->execute([$userNIC]);

    if ($show_user_address->rowCount() > 0) {
        while ($fetch_address = $show_user_address->fetch(PDO::FETCH_ASSOC)) {

            ?>
                <div class="contact-info">
                <h1>Contact Information</h1>
                </div>

                <form action="" method="post">
                <table class="table-one">
                    <tr>
                        <td colspan="2">
                            <input type="email" name="email" placeholder="Email" value="<?=$fetch_address['userEmail'];?>" required>
                        </td>
                    </tr>
                </table>

                <div class="billing-info">
                <h1>Billing Information</h1>
                </div>



                <table class="table-two">
                    <tr>
                        <td>
                            <input type="text" name="firstName" placeholder="First Name" value="<?=$fetch_address['userFName'];?>" required>
                        </td>
                        <td>
                            <input type="text" name="lastName" placeholder="Last Name" value="<?=$fetch_address['userLName'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="address" placeholder="Address" value="<?=$fetch_address['userAddress'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="city" placeholder="City" value="<?=$fetch_address['userCity'];?>" required>
                        </td>
                        <td>
                            <input type="text" name="postalcode" placeholder="Postal Code" value="<?=$fetch_address['userPostalCode'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="tel" name="phoneNumber" placeholder="Phone Number" value="<?=$fetch_address['userNumber'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="uuid" id ="uuid" value="">
                            <input type="hidden" name="discount" id="discount" value="0">
                            <input type="submit" oncload="uniqueID()" name="submit" value="Submit">
                        </td>
                    </tr>
                </table>
                </form>
<?php
}
    }
} else {
    ?>
                <div class="contact-info">
                <h1>Contact Information</h1>
                <p>Already have an account? <span onclick="location.href='/login.php';">LOG IN</span></p>
                </div>

                <form action="" method="post">
                <table class="table-one">
                    <tr>
                        <td colspan="2">
                            <input type="email" name="email" placeholder="Email" value="" required>
                        </td>
                    </tr>
                </table>

                <div class="billing-info">
                <h1>Billing Information</h1>
                </div>



                <table class="table-two">
                    <tr>
                        <td>
                            <input type="text" name="guestFName" placeholder="First Name" value="" required>
                        </td>
                        <td>
                            <input type="text" name="guestLName" placeholder="Last Name" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="guestAddress" placeholder="Address" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="guestCity" placeholder="City" value="" required>
                        </td>
                        <td>
                            <input type="text" name="guestPostalCode" placeholder="Postal Code" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="tel" name="guestNumber" placeholder="Phone Number" value="" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="uuid" id="uuid" value="">
                            <input type="hidden" name="gid" id="gid" value="">
                            <input type="hidden" name="discount" id="discount" value="0">
                            <input type="submit" oncload="gid()" name="guest" value="Submit">
                        </td>
                    </tr>
                </table>
                </form>
<?php
}
?>



        </div>
        </div>

        <div class="section-two">
        <div class="section-two-container">

        <div class="order-info">
            <h1>Order Summary</h1>
        </div>

        <div class="cart-product-box">

<?php
$show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productImage, cart_item.cartitemId, cart_item.cartitemQty, coupon.couponCode, coupon.couponDiscount, products.productPrice*cart_item.cartitemQty as subtotal from cart_item INNER JOIN products ON cart_item.productId = products.productId INNER JOIN coupon ON coupon.couponId = products.couponId WHERE cart_item.sessionId = ? ");

$show_products->execute([$ssid]);

if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <input type="hidden" name="productId" value="<?=$fetch_products['productId'];?>" >
        <input type="hidden" name="orderitemsQty" value="<?=$fetch_products['cartitemQty'];?>" >
        <input type="hidden" name="orderitemsTotal" value="<?=$fetch_products['subtotal'];?>" >
        <div class="cart-details">
        <div class="cart-product">
            <img src="img/<?=$fetch_products['productImage'];?>" alt="">
            <div class="cart-product-nandq">
            <p id="cart-product-name" class="bold"><?=$fetch_products['productName'];?></p>
            <p id="cart-product-qty" class="bold">x <?=$fetch_products['cartitemQty'];?></p>
            </div>
        </div>
        <p class="bold">LKR <?=$fetch_products['subtotal']?></p>
        </div>
<?php
}
}
?>

        </div>
        <hr>

        <form action="" method="POST">

        <div class="cart-coupon">
        <p>Coupon Code</p>
        <input type="text" class="cart-coupon-code" name="couponCode" placeholder="Enter the Code">
        <input type="submit" class="cart-coupon-btn" name="apply" value="Apply ">
        </div>

        </form>

        <div class="cart-subtotal">

<?php
$show_products = $conn->prepare("SELECT sum(products.productPrice*cart_item.cartitemQty) as subtotal from cart_item INNER JOIN products ON cart_item.productId = products.productId WHERE cart_item.sessionId = ?");
$show_products->execute([$ssid]);
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['subtotal'] = $fetch_products['subtotal'];
    }
    {?>
        <p>Subtotal</p>
        <p class="bold">LKR <?=$_SESSION['subtotal'];?></p>

<?php
}
}
?>
        </div>

    <?php if (isset($_POST['apply'])) {

    $couponCode = $_POST['couponCode'];
    $couponCode = filter_var($couponCode, FILTER_UNSAFE_RAW);

    $show_discount = $conn->prepare("SELECT couponCode, couponDiscount from coupon WHERE couponCode = ? ");
    $show_discount->execute([$couponCode]);

    if ($show_discount->rowCount() > 0) {
        while ($fetch_discount = $show_discount->fetch(PDO::FETCH_ASSOC)) {
            $dbcouponCode = $fetch_discount['couponCode'];

            if ($dbcouponCode == $couponCode) {
                $_SESSION['couponDiscount'] = $fetch_discount['couponDiscount'];
                $couponDiscount = $_SESSION['couponDiscount'];
                ?>
        <div class="cart-discount">

        <p>Discount&emsp;<i class="fa-solid fa-percent"></i><span class="coupon-saving">Saving <?php echo ($couponDiscount * 100) . '%&emsp;<i class="fa-solid fa-tag"></i> ' . $couponCode ?></span></p>
        <p id="coupon-saving" class="bold"><?php

                $_SESSION['discount'] = $_SESSION['subtotal'] * $couponDiscount;
                $discount = $_SESSION['discount'];
                echo '- LKR ' . $discount;?></p>

        </div>

        <?php $message[] = 'Coupon added.';}}?>

<?php
} else {
        $error[] = 'Enter a valid coupon.';
    }
}
?>
        <div class="cart-delivery">

        <p>Delivery</p>
        <p class="bold">Pickup</p>

        </div>

        <hr>

        <div class="cart-total">

        <p>Total</p>
        <p class="bold"><?php echo 'LKR ' . $_SESSION['orderTotal'] = $_SESSION['subtotal'] - $discount; ?></p>

        </div>

        </div>
        </div>
    </div>

</section>
</div>

    <!-- custom js file link  -->
    <script>
        function uniqueID(){
        function chr4(){
        return Math.random().toString(16).slice(-4);
        }
        return "OID-" + chr4() + chr4();
        }
        document.getElementById("uuid").value = uniqueID();
    </script>

    <script>
        function gid(){
        function chr4(){
        return Math.random().toString(16).slice(-4);
        }
        return "GID-" + chr4() + chr4();
        }
        document.getElementById("gid").value = gid();
    </script>

    <script>
        function imageClicked() {
        window.open("index.php", "_self");
   	    }
    </script>

    <script>
        function apply(){
            let txt = document.getElementById("coupon-saving").innerText;
            var num = txt.replace(/[^0-9]/g, '');
            document.getElementById("discount").value = num;
        }
    </script>

</body>

</html>
