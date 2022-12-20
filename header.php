<header class="header">

<section class="flex">

    <!-- <a href="#home" class="logo">The Pizza</a> -->
    <img onclick="imageClicked()" src="img/logovertical.png" alt="">
        <nav id="mySidenav" class="navbar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a onclick="clickMenu(event)" class='target' href="/#home">Home</a>
            <a onclick="clickMenu(event)" class='target' href="/#menu">Menu</a>
            <a onclick="clickMenu(event)" class='target' href="/#deals">Deals</a>
            <a onclick="clickMenu(event)" class='target' href="/#services">Services</a>
            <a onclick="clickMenu(event)" class='target' href="/#contactus">Contact</a>
        </nav>

<?php
$count_cart_items = $conn->prepare("SELECT * from cart_item INNER JOIN shopping_session ON cart_item.sessionId = shopping_session.ssId WHERE ssId = ?");
// $count_cart_items = $conn->prepare("SELECT * FROM cart_item WHERE cartitemId = ?");
$count_cart_items->execute([$ssid]);
$total_cart_items = $count_cart_items->rowCount();
?>
    <div class="icons">
        <div id="menu-btn" class="fa-solid fa-bars" onclick="openNav()"></div>

<?php
if ($host == 'index.php') {
    ?>
        <div id="cart-btn" class="fa-solid fa-bag-shopping"></div><span class="cart-qty" ><?=$total_cart_items;?></span>
<?php }?>

<?php
if (isset($_SESSION['roleType'])) {
    echo "<div id=\"user-btn\" class=\"fa-solid fa-user\"><span class=\"user-name\">Hi ";
    echo $_SESSION['userFName'];
    echo ",</span></div>";
}
?>
        </div>

</section>

</header>