<header class="header">

<div class="notify-msg">

<?php 
    if (isset($message)) {
    foreach ($message as $message) {
        echo '<span id="message" class="success-msg">' . $message . '</span>';
    }
    ;
}
;
?>

</div>

<section class="flex">

    <!-- <a href="#home" class="logo">The Pizza</a> -->
    <img onclick="imageClicked()" src="img/logovertical.png" alt="">
        <nav id="mySidenav" class="navbar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a id="activehome" onload="load()" onclick="clickMenu(event)" class='target' href="/#home">Home</a>
            <a onclick="clickMenu(event)" class='target' href="/#menu">Menu</a>
            <a onclick="clickMenu(event)" class='target' href="/#deals">Deals</a>
            <a onclick="clickMenu(event)" class='target' href="/#services">Services</a>
            <a id="activecontact" onclick="clickMenu(event)" class='target' href="/contact.php">Contact</a>
            <?php
                if (!isset($_SESSION['roleType'])) { ?>
            <a id="activelogin" onclick="clickMenu(event)" class='target' href="/login.php">Login</a>
            <?php } ?>
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


<div class="dropdown">

<?php
if (isset($_SESSION['roleType'])) {
    echo "<div id=\"user-btn\" class=\"fa-solid fa-user\"><span class=\"user-name\">Hi ";
    echo $_SESSION['userFName'];
    echo ",</span></div>";
}
?>

  <div class="dropdown-menu">
    <a href="/userdashboard.php"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a>
    <a href="/userorder.php"><i class="fa-solid fa-pizza-slice"></i>&nbsp;Orders</a>
    <a href="/profilesetting.php"><i class="fa-solid fa-gear"></i>&nbsp;Profile</a>
    <a href="/logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
  </div>

</div>
<?php }?>
        </div>

</section>

</header>