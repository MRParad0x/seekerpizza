
<div class="flexbox" id="blur">
<div class="box-one">

    <div class="logo">
    <img onclick="imageClicked()" src="img/logovertical.png" alt="">
    </div>

    <?php
if ($_SESSION['roleType'] == 'Admin'): ?>
    <div class="navbar" id="navid">
        <a class="menubtn" href="dashboard.php"><i id="icon" class="fa-solid fa-gauge"></i>Dashboard</a>
        <a class="menubtn" href="order.php"><i id="icon" class="fa-solid fa-chart-line"></i>Orders</a>
        <a class="menubtn" href="category.php"><i id="icon" class="fa-solid fa-layer-group"></i>Category</a>
        <a class="menubtn" href="product.php"><i id="icon" class="fa-solid fa-pizza-slice"></i>Product</a>
        <a class="menubtn" href="customer.php"><i id="icon" class="fa-solid fa-user-group"></i></i>Customer</a>
        <a class="menubtn" href="coupon.php"><i id="icon" class="fa-solid fa-percent"></i>Coupon</a>
        <a class="menubtn" href="subscriber.php"><i id="icon" class="fa-solid fa-envelope"></i>Subscriber</a>
        <a class="menubtn" href="feedback.php"><i id="icon" class="fa-solid fa-comments"></i>Feedback</a>
        <a class="menubtn" href="user.php"><i id="icon" class="fa-solid fa-user-plus"></i>User</a>
        <a class="menubtn" href="role.php"><i id="icon" class="fa-solid fa-user-gear"></i></i>Role</a>
        <a class="menubtn" href="report.php"><i id="icon" class="fa-solid fa-table"></i>Report</a>
    </div>
    <?php endif;?>

    <?php
if ($_SESSION['roleType'] == 'Manager'): ?>
    <div class="navbar" id="navid">
        <a class="menubtn" href="dashboard.php"><i id="icon" class="fa-solid fa-gauge"></i>Dashboard</a>
        <a class="menubtn" href="feedback.php"><i id="icon" class="fa-solid fa-comments"></i>Feedback</a>
        <a class="menubtn" href="report.php"><i id="icon" class="fa-solid fa-table"></i>Report</a>
    </div>
    <?php endif;?>

    <?php
if ($_SESSION['roleType'] == 'Cashier'): ?>
    <div class="navbar" id="navid">
        <a class="menubtn" href="order.php"><i id="icon" class="fa-solid fa-chart-line"></i>Orders</a>
        <a class="menubtn" href="product.php"><i id="icon" class="fa-solid fa-pizza-slice"></i>Product</a>
        <a class="menubtn" href="category.php"><i id="icon" class="fa-solid fa-layer-group"></i>Category</a>
    </div>
    <?php endif;?>

    <?php
if ($_SESSION['roleType'] == 'Customer'): ?>
    <div class="navbar" id="navid">
        <a class="menubtn" href="userdashboard.php"><i id="icon" class="fa-solid fa-gauge"></i>Dashboard</a>
        <a class="menubtn" href="userorder.php"><i id="icon" class="fa-solid fa-chart-line"></i>Orders</a>
    </div>
    <?php endif;?>

    <div class="profile-box">
    <div class="profile-logo">
    <img src="img/profile.png" alt="">
    <h4><?php echo $_SESSION['userFName'] . '&nbsp;' . $_SESSION['userLName'] ?></h4>
    </div>

    <div class="profile-setting">
    <a class="menubtn" href="profilesetting.php"><i class="fa-solid fa-gear"></i></a>
    <a class="menubtn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
    </div>

</div>

<script>
    /* Start logo image click functions */

    function imageClicked() {
    window.open("index.php", '_blank').focus();
    }

    /* End logo image click functions */

</script>