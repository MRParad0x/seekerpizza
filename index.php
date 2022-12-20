<?php

include 'conn.php';

session_start();
if (isset($_SESSION['roleType'])) {
    $ssid = session_id();
    echo $ssid;
    echo $_SESSION['userNIC'];
} else {
    $ssid = session_id();
    echo $ssid;
}

$host = "index.php";

if (isset($_POST['add_to_cart'])) {

    $productId = $_POST['productId'];
    $productId = filter_var($productId, FILTER_UNSAFE_RAW);
    $cartitemQty = $_POST['cartitemQty'];
    $cartitemQty = filter_var($cartitemQty, FILTER_UNSAFE_RAW);

    $select_sid = $conn->prepare("SELECT ssId from shopping_session WHERE ssId = ?");
    $select_sid->execute([$ssid]);
    $row = $select_sid->fetch(PDO::FETCH_ASSOC);

    if ($select_sid->rowCount() == 0) {
        $insert_session = $conn->prepare("INSERT INTO shopping_session (ssId) VALUES(?)");
        $insert_session->execute([$ssid]);

        $insert_cart_item = $conn->prepare("INSERT INTO cart_item (sessionId, productId, cartitemQty) VALUES(?,?,?)");
        $insert_cart_item->execute([$ssid, $productId, $cartitemQty]);
        $add[] = 'Pizza has been successfully Added to cart';
    } else {
        if ($row['ssId'] == ($ssid)) {
            $session[] = 'session already exits';
        } else {
            $insert_session = $conn->prepare("INSERT INTO shopping_session (ssId) VALUES(?)");
            $insert_session->execute([$ssid]);
        }
        $insert_cart_item = $conn->prepare("INSERT INTO cart_item (sessionId, productId, cartitemQty) VALUES(?,?,?)");
        $insert_cart_item->execute([$ssid, $productId, $cartitemQty]);
        $add[] = 'Pizza has been successfully Added to cart';
    }

}

if (isset($_POST['delete'])) {
    $cartitemIdd = $_POST['cartitemIdd'];
    $delete_cart_item = $conn->prepare("DELETE FROM cart_item WHERE cartitemId = ?");
    $delete_cart_item->execute([$cartitemIdd]);
    $message[] = 'cart item deleted!';
}

if (isset($_POST['delete_all'])) {
    $delete_cart_item = $conn->prepare("DELETE FROM cart_item WHERE sessionId = ?");
    $delete_cart_item->execute([$ssid]);
    $message[] = 'deleted all from cart!';
}

if (isset($_POST['update_qty'])) {
    foreach ($_POST['cartitemId'] as $row => $id) {
        $cartitemId = $id;
        echo "<br/>" . $cartitemId . "<br/>";
        $cartitemQty = ($_POST['cartitemQty'][$row]);
        echo "<br/>" . $cartitemQty . "<br/>";
        $update_qty = $conn->prepare("UPDATE cart_item SET cartitemQty =? WHERE cartitemId =?");
        $update_qty->execute([$cartitemQty, $cartitemId]);
        // echo '<script language="javascript">alert("juas");</script>';
    }
}

if (isset($_POST['checkout'])) {
    header('location:checkout.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Seekers Pizza</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>

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

<!-- Start header -->

<?php include 'header.php'?>

<!-- End header -->

    <div class="home-bg">

        <section class="home" id="home">

            <div class="slider-container">

                <div class="slide active">
                    <div class="content">
                        <h3>Chicken Pizza</h3>
                        <h4>Ingredients:</h4>
                        <p>tomato sauce, mozzarella cheese, cocktail, shrimps<br/> salmon, mussels, lemon, parsley</p>
                        <h2>Rs: 2000.00</h2>
                        <button>Go to Menu</button><br/>
                        <div class="fa-solid fa-circle-left" onclick="prev()"></div>
                        <div class="fa-solid fa-circle-right" onclick="next()"></div>
                    </div>
                    <div class="image">
                        <img src="img/pizza01.png" alt="">
                    </div>
                </div>

                <div class="slide">
                    <div class="content">
                        <h3>Seafood Pizza</h3>
                        <h4>Ingredients:</h4>
                        <p>tomato sauce, mozzarella cheese, cocktail, shrimps<br/> salmon, mussels, lemon, parsley</p>
                        <h2>Rs: 1500.00</h2>
                        <button>Go to Menu</button><br/>
                        <div class="fa-solid fa-circle-left" onclick="prev()"></div>
                        <div class="fa-solid fa-circle-right" onclick="next()"></div>
                    </div>
                    <div class="image">
                        <img src="img/pizza02.png" alt="">
                    </div>
                </div>

                <div class="slide">
                    <div class="content">
                        <h3>Mix Pizza</h3>
                        <h4>Ingredients:</h4>
                        <p>tomato sauce, mozzarella cheese, cocktail, shrimps<br/> salmon, mussels, lemon, parsley</p>
                        <h2>Rs: 1800.00</h2>
                        <button>Go to Menu</button><br/>
                        <div class="fa-solid fa-circle-left" onclick="prev()"></div>
                        <div class="fa-solid fa-circle-right" onclick="next()"></div>
                    </div>
                    <div class="image">
                        <img src="img/pizza03.png" alt="">
                    </div>
                </div>

                <div class="slide">
                    <div class="content">
                        <h3>Mix Pizza</h3>
                        <h4>Ingredients:</h4>
                        <p>tomato sauce, mozzarella cheese, cocktail, shrimps<br/> salmon, mussels, lemon, parsley</p>
                        <h2>Rs: 2500.00</h2>
                        <button>Go to Menu</button><br/>
                        <div class="fa-solid fa-circle-left" onclick="prev()"></div>
                        <div class="fa-solid fa-circle-right" onclick="next()"></div>
                    </div>
                    <div class="image">
                        <img src="img/pizza04.png" alt="">
                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="feature-box-bg">
        <section class="feature-box" id="services">

            <h1>Services</h1>
            <p>Grab the latest promotions and deals to enjoy great savings, only at US Pizza!</p>
            <div class="box-container">

                <div class="box">
                    <img src="img/fresh.svg" alt="">
                    <h2>Fresh & Quality</h2>
                    <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt ut lab.</p>
                </div>

                <div class="box">
                    <img src="img/chef.svg" alt="">
                    <h2>Professional Cooks</h2>
                    <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt ut lab.</p>
                </div>

                <div class="box">
                    <img src="img/delivery.svg" alt="">
                    <h2>Fast Delivery</h2>
                    <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt ut lab.</p>
                </div>

                <div class="box">
                    <img src="img/taste.svg" alt="">
                    <h2>Best Taste</h2>
                    <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt ut lab.</p>
                </div>

             </div>
        </section>
    </div>

    <div class="offer-box-bg">
        <section class="offer-box" id="deals">

            <h1>Pizza Promotions!</h1>
            <p>Grab the latest promotions and deals to enjoy great savings, only at US Pizza!</p>
            <div class="box-container">
                    <img src="img/ads001.png" alt="">
                    <img src="img/ads03.png" alt="">
                    <img src="img/ads02.png" alt="">
            </div>
            <img src="img/ads04.png" alt="">
        </section>
    </div>

    <div>
        <section class="menu-bg" id="menu">
            <h1>Our Menu</h1>
            <p>Grab the latest promotions and deals to enjoy great savings, only at US Pizza!</p>
            <div class="menu">
                <div class="menu-container">
                    <nav class="tab-menu">
                        <a class="tab tab-active" onclick="openFood(event,'pizza')">Pizza</a>
                        <a class="tab" onclick="openFood(event,'pasta')">Pasta</a>
                        <a class="tab" onclick="openFood(event,'dessert')">Dessert</a>
                        <a class="tab" onclick="openFood(event,'beverage')">Beverage</a>
                    </nav>


                    <div id="pizza" class="tab-content">
                        <div class="item-box-one">
                            <div class="box-container">

<?php
$show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productDescription, products.productImage, category.categoryName, coupon.couponId, coupon.couponCode from products INNER JOIN category ON products.categoryId = category.categoryId INNER JOIN coupon ON products.couponId = coupon.couponId WHERE category.categoryName = 'Pizza' ");
$show_products->execute();
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

                                <div class="box">
                                    <img src="uploads/<?=$fetch_products['productImage'];?>" alt=""/>
                                    <h3><?=$fetch_products['productName'];?></h3>
                                    <p><?=$fetch_products['productDescription'];?></p>
                                    <h2>LKR <?=$fetch_products['productPrice'];?></h2>
                                    <form action="" method="post">
                                    <input type="hidden" name="productId" value="<?=$fetch_products['productId'];?>">
                                    <input type="hidden" name="cartitemQty" value="1">
                                    <button id="disbled" type="submit" name="add_to_cart">ADD TO CART</button>
                                    </form>
                                </div>

<?php
}
}
?>
                            </div>
                        </div>
                    </div>


                    <div id="pasta" class="tab-content" >
                        <div class="item-box-two">
                            <div class="box-container">

<?php
$show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productDescription, products.productImage, category.categoryName, coupon.couponId, coupon.couponCode from products INNER JOIN category ON products.categoryId = category.categoryId INNER JOIN coupon ON products.couponId = coupon.couponId WHERE category.categoryName = 'Pasta' ");
$show_products->execute();
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

                                <div class="box">
                                    <img src="uploads/<?=$fetch_products['productImage'];?>"alt=""/>
                                    <h3><?=$fetch_products['productName'];?></h3>
                                    <div class="size">
                                        <div class="price">
                                            <h2 id="s" class="size-price">LKR <?=$fetch_products['productPrice'];?></h2>
                                        </div>
                                    </div>
                                    <form action="" method="post">
                                    <input type="hidden" name="productId" value="<?=$fetch_products['productId'];?>">
                                    <input type="hidden" name="cartitemQty" value="1">
                                    <button type="submit" name="add_to_cart">ADD TO CART</button>
                                    </form>
                                </div>

<?php
}
}
?>
                            </div>
                        </div>
                    </div>

                    <div id="dessert" class="tab-content" >
                        <div class="item-box-three">
                            <div class="box-container">

<?php
$show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productDescription, products.productImage, category.categoryName, coupon.couponId, coupon.couponCode from products INNER JOIN category ON products.categoryId = category.categoryId INNER JOIN coupon ON products.couponId = coupon.couponId WHERE category.categoryName = 'Dessert' ");
$show_products->execute();
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

                                <div class="box">
                                    <img src="uploads/<?=$fetch_products['productImage'];?>"alt=""/>
                                    <h3><?=$fetch_products['productName'];?></h3>
                                    <div class="size">
                                        <div class="price">
                                            <h2 id="s" class="size-price">LKR <?=$fetch_products['productPrice'];?></h2>
                                        </div>
                                    </div>
                                    <form action="" method="post">
                                    <input type="hidden" name="productId" value="<?=$fetch_products['productId'];?>">
                                    <input type="hidden" name="cartitemQty" value="1">
                                    <button type="submit" name="add_to_cart">ADD TO CART</button>
                                    </form>
                                </div>

<?php
}
}
?>
                            </div>
                        </div>
                    </div>

                    <div id="beverage" class="tab-content" >
                        <div class="item-box-four">
                            <div class="box-container">

<?php
$show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productDescription, products.productImage, category.categoryName, coupon.couponId, coupon.couponCode from products INNER JOIN category ON products.categoryId = category.categoryId INNER JOIN coupon ON products.couponId = coupon.couponId WHERE category.categoryName = 'Beverage' ");
$show_products->execute();
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

                                <div class="box">
                                    <img src="uploads/<?=$fetch_products['productImage'];?>"alt=""/>
                                    <h3><?=$fetch_products['productName'];?></h3>
                                    <div class="size">
                                        <div class="price">
                                            <h2 id="s" class="size-price">LKR <?=$fetch_products['productPrice'];?></h2>
                                        </div>
                                    </div>
                                    <form action="" method="post">
                                    <input type="hidden" name="productId" value="<?=$fetch_products['productId'];?>">
                                    <input type="hidden" name="cartitemQty" value="1">
                                    <button type="submit" name="add_to_cart">ADD TO CART</button>
                                    </form>
                                </div>

<?php
}
}
?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>

    <div class="newsletter-box-bg">
        <section class="newsletter-box">
            <div class="newsletter-box-container">

                <img src="img/subimage.jpg" alt="">

            <div class="subscribe">
                <h2>Stay updated with latest the Pizza updates and best deals</h2>
                <p>Subscribe and never miss out on finds & deals delivered to your inbox.</p>
                <div class="form">
                    <input type="email" name="email" id="email" placeholder="Enter your email address" autocomplete="off">
                    <button type="button">Subscribe</button>
                </div>
            </div>

            </div>
        </section>
    </div>

    <?php include 'cart.php'?>

    <footer class="footer">
        <section class="flex" id="contactus">
            <div class="footer-container">
                <div class="footer-box-block">

                    <a href="#home"><img class="logo" src="img/logovertical.png" alt=""></a>
                        <p>Follow us on social</p>

                        <div class="icons-scoial">
                            <a href="facebook.com" class="fa-brands fa-facebook-f"></a>
                            <a href="instagram.com" class="fa-brands fa-instagram"></a>
                            <a href="twitter.com" class="fa-brands fa-twitter"></a>
                            <a href="youtube.com" class="fa-brands fa-youtube"></a>
                            <a href="tiktok.com" class="fa-brands fa-tiktok"></a>
                        </div>

                        <div class="icons-details">
                            <a class="fa-solid fa-phone"></a><label>+94 112768453</label>
                            <a class="fa-solid fa-envelope"></a><label>support@seekerspizza.com</label>
                            <a class="fa-solid fa-location-dot"></a><label>10C, Pittugala Road, Kaduwela</label>
                            <a class="fa-solid fa-calendar-days"></a><label>Monday -  Sunday</label>
                            <a class="fa-solid fa-clock"></a><label>11:00 AM -  11:00 PM</label>
                        </div>

                    <div class="navbar">
                        <a href="#home">Home</a>
                        <a href="#menu">Menu</a>
                        <a href="#about">About</a>
                        <a href="#contact">Contact</a>
                        <a href="#register">Register</a>
                        <a href="#login">Login</a>
                        <a href="#tou">Term of USe</a>
                        <a href="#tou">Privacy policy</a>
                    </div>
                    <p class="footer-copy">Copyright © 2022 Seekers Pizza All Rights Reserved.</p>
                    <p>Made with <i class="fa-solid fa-heart"></i> By Seeker Group.</p>
                </div>
            </div>
        </section>
    </footer>

    <!-- custom js file link  -->
    <script src='js/index.js'></script>

    <script>
    /* Start logo image click functions */

    function imageClicked() {
    window.open("index.php", "_self");
    }

    /* End logo image click functions */

    </script>

</body>

</html>
