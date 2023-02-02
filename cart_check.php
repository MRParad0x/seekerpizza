<?php

$show_cart_products = $conn->prepare("SELECT productId from cart_item WHERE cart_item.sessionId = ? ");
$show_cart_products->execute([$ssid]);
if ($show_cart_products->rowCount() > 0) {
    while ($fetch_cart_products = $show_cart_products->fetch(PDO::FETCH_ASSOC)) {?>

        <script>
        var v = document.getElementsByClassName('addToCartBtn');

        for (var i = 0; i < v.length; i++) {
            var value = v[i].value;
            var cartvalue = '<?=$fetch_cart_products['productId'];?>';

        if(value == cartvalue){
            x = document.getElementsByClassName('addToCartBtn');
            x[i].disabled=true;
            x[i].innerText ="ALREADY ADDED";
            }
        }
        </script>
        <?php }}?>