    <?php 
    if($_SESSION['roleType'] == 'Admin'): ?>
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
    <?php endif; ?>

    <?php 
    if($_SESSION['roleType'] == 'Manager'): ?>
    <div class="navbar" id="navid">
        <a class="menubtn" href="dashboard.php"><i id="icon" class="fa-solid fa-gauge"></i>Dashboard</a>
        <a class="menubtn" href="order.php"><i id="icon" class="fa-solid fa-chart-line"></i>Orders</a>
        <a class="menubtn" href="product.php"><i id="icon" class="fa-solid fa-pizza-slice"></i>Product</a>
        <a class="menubtn" href="feedback.php"><i id="icon" class="fa-solid fa-comments"></i>Feedback</a>
        <a class="menubtn" href="report.php"><i id="icon" class="fa-solid fa-table"></i>Report</a>
    </div>
    <?php endif; ?>

    <?php 
    if($_SESSION['roleType'] == 'Cashier'): ?>
    <div class="navbar" id="navid">
        <a class="menubtn" href="dashboard.php"><i id="icon" class="fa-solid fa-gauge"></i>Dashboard</a>
        <a class="menubtn" href="order.php"><i id="icon" class="fa-solid fa-chart-line"></i>Orders</a>
        <a class="menubtn" href="product.php"><i id="icon" class="fa-solid fa-pizza-slice"></i>Product</a>
        <a class="menubtn" href="category.php"><i id="icon" class="fa-solid fa-layer-group"></i>Category</a>
        <a class="menubtn" href="feedback.php"><i id="icon" class="fa-solid fa-comments"></i>Feedback</a>
    </div>
    <?php endif; ?>

    <?php 
    if($_SESSION['roleType'] == 'Customer'): ?>
    <div class="navbar" id="navid">
        <a class="menubtn" href="dashboard.php"><i id="icon" class="fa-solid fa-gauge"></i>Dashboard</a>
        <a class="menubtn" href="order.php"><i id="icon" class="fa-solid fa-chart-line"></i>Orders</a>
        <a class="menubtn" href="product.php"><i id="icon" class="fa-solid fa-pizza-slice"></i>Product</a>
    </div>
    <?php endif; ?>