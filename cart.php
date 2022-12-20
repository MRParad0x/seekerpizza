<div class=shopping-cart>
    <section>

        <div class="cart-head">
        <button id="close-cart" class="fa-solid fa-circle-xmark" ></button>
        <h1>Cart</h1>
        </div>

        <div class="cart-box">
        <form action="" method="post">
        <div class="cart-content-container">

<?php
$show_products = $conn->prepare("SELECT products.productName, products.productPrice, products.productImage, cart_item.cartitemId, cart_item.cartitemQty, products.productPrice*cart_item.cartitemQty as subtotal from cart_item INNER JOIN products ON cart_item.productId = products.productId WHERE cart_item.sessionId = ? ");
$show_products->execute([$ssid]);
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <div class="cart-content">

        <div>

            <input type="hidden" name="cartitemIdd" value="<?=$fetch_products['cartitemId'];?>">
            <button id="remove-item" type="submit" class="fa-solid fa-delete-left" name="delete" onclick="return confirm('Are you sure? you want to delete this item?');"></button>

        <img src="img/<?=$fetch_products['productImage'];?>" alt="">
        </div>
            <table>
                <tr>
                    <td class="col1">
                        <label class="item-name"><?=$fetch_products['productName'];?></label>
                    </td>
                    <td>
                        <input id="cartqty" type="number" class="qty" name="cartitemQty[]" min="1" maxlength="2" value="<?=$fetch_products['cartitemQty'];?>" max="10">
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                    <label class="item-price">Price:</label>
                    </td>
                    <td>
                    <label class="item-price">LKR</label>
                    <label id="itemprice" class="item-price"><?=$fetch_products['productPrice'];?></label>
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                    <label class="item-subtotal">Subtotal</label>
                    </td>
                    <td>
                    <label class="item-price">LKR</label>
                    <label id="itemsubtotal" class="item-subtotal"><?=$fetch_products['subtotal'];?></label>
                    </td>
                </tr>
            </table>
        </div>

<?php
}
} else {
    echo '<p class=no-product>No product has been added!</p>';
}
?>

    </div>

    <div class="carttotal-container">
    <div class="carttotal">

<?php
$show_products = $conn->prepare("SELECT cartitemId, cartitemQty from cart_item WHERE sessionId = ?");
$show_products->execute([$ssid]);
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <input type="hidden" name="cartitemId[]" value="<?=$fetch_products['cartitemId'];?>">
<?php
}

    ?>
        <div class="clear-update-btn">
        <input type="submit" onclick="getqty()" class="cart-update-btn" name="update_qty" value="update Cart">
        <input type="submit" class="cart-clear-btn" name="delete_all" value="Clear Cart" onclick="return confirm('Are you sure? you want to delete All items?');">
        </div>

</form>
        <hr/>
        <table class="carttotal-table">

<?php
$show_products = $conn->prepare("SELECT sum(products.productPrice*cart_item.cartitemQty) as subtotal from cart_item INNER JOIN products ON cart_item.productId = products.productId WHERE cart_item.sessionId = ?");
    $show_products->execute([$ssid]);
    if ($show_products->rowCount() > 0) {
        while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
        <div>
            <tr>
                <td><label class="cart-coupon-total-label">Subtotal</label></td>
                <td><label class="cart-coupon-total">LKR <?=$fetch_products['subtotal'];?></label></td>
            </tr>
        </div>
<?php
}
        ?>

        </table>
        <hr/>

    <div class="cartbtns">
    <button type="submit" name="checkout" id="ccbtn" onclick="location.href='/checkout.php';"><i class="fa-regular fa-credit-card"></i><span>Checkout</span></button>
    <button id="csbtn"><i class="fa-solid fa-bag-shopping"></i><span>Continue Shopping</span></button>
    </div>
    </div>
    </div>

<?php
}
}
?>

    </div>
    </section>
    </div>