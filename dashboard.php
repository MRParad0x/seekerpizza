<?php
include 'conn.php';

session_start();

if (!isset($_SESSION['roleType'])) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dashboard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/dashboard.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/notify.css'>

     <!-- favicon file link  -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- google custom font link  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- jquery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Print component -->
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

    <!-- Export component -->
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.1/chart.min.js"></script>

</head>

<body onload="load();">

<?php

$show_sandr = $conn->prepare("SELECT MONTHNAME(orderitemsDate) as month, SUM(orderitemsQty) as sales, SUM(orderitemsTotal) as revenue from order_items GROUP BY month;");
$show_sandr->execute();
if ($show_sandr->rowCount() > 0) {
    while ($fetch_sandr = $show_sandr->fetch(PDO::FETCH_ASSOC)) {
        $month[] = $fetch_sandr['month'];
        $sales[] = $fetch_sandr['sales'];
        $revenue[] = $fetch_sandr['revenue'];
    }}

$show_most_selling_product_list = $conn->prepare("SELECT p.productName as products, SUM(orderitemsQty) as quantity from order_items as o,products as p where p.productId=o.productId group by p.productName order by SUM(orderitemsQty) DESC LIMIT 5;");
$show_most_selling_product_list->execute();
if ($show_most_selling_product_list->rowCount() > 0) {
    while ($fetch_most_selling_product_list = $show_most_selling_product_list->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $fetch_most_selling_product_list['products'];
        $quantity[] = $fetch_most_selling_product_list['quantity'];
    }}

$show_total_customers = $conn->prepare("SELECT count(*) as customers from role as r, user as u where u.roleId=r.roleId and r.roleId='RO-0004' group by u.roleId;");
$show_total_customers->execute();
if ($show_total_customers->rowCount() > 0) {
    while ($fetch_total_customers = $show_total_customers->fetch(PDO::FETCH_ASSOC)) {
        $customers = $fetch_total_customers['customers'];
    }}

$show_total_subscribers = $conn->prepare("SELECT count(*) as subscribers  from  subscriber where id is not null;");
$show_total_subscribers->execute();
if ($show_total_subscribers->rowCount() > 0) {
    while ($fetch_total_subscribers = $show_total_subscribers->fetch(PDO::FETCH_ASSOC)) {
        $subscribers = $fetch_total_subscribers['subscribers'];
    }}

$show_total_products = $conn->prepare("SELECT count(productId) as products from  products where id is not null;");
$show_total_products->execute();
if ($show_total_products->rowCount() > 0) {
    while ($fetch_total_products = $show_total_products->fetch(PDO::FETCH_ASSOC)) {
        $totalproducts = $fetch_total_products['products'];
    }}

$show_total_feedbacks = $conn->prepare("SELECT count(*) as feedbacks from feedback where feedbackId is not null;");
$show_total_feedbacks->execute();
if ($show_total_feedbacks->rowCount() > 0) {
    while ($fetch_total_feedbacks = $show_total_feedbacks->fetch(PDO::FETCH_ASSOC)) {
        $feedbacks = $fetch_total_feedbacks['feedbacks'];
    }}

$show_total_sales = $conn->prepare("SELECT COUNT(orderId) as sales from  sp_order where orderId is not null;");
$show_total_sales->execute();
if ($show_total_sales->rowCount() > 0) {
    while ($fetch_total_sales = $show_total_sales->fetch(PDO::FETCH_ASSOC)) {
        $totalsales = $fetch_total_sales['sales'];
    }}

$show_total_revenue = $conn->prepare("SELECT SUM(orderitemsTotal) as revenue from order_items where orderitemsTotal is not null;");
$show_total_revenue->execute();
if ($show_total_revenue->rowCount() > 0) {
    while ($fetch_total_revenue = $show_total_revenue->fetch(PDO::FETCH_ASSOC)) {
        $revenue = $fetch_total_revenue['revenue'];
    }}

$show_total_category = $conn->prepare("SELECT c.categoryName as category, SUM(orderitemsQty) as catqty from order_items as o,products as p, category as c where p.productId=o.productId and c.categoryId=p.categoryId group by c.categoryName order by SUM(orderitemsQty) DESC;");
$show_total_category->execute();
if ($show_total_category->rowCount() > 0) {
    while ($fetch_total_category = $show_total_category->fetch(PDO::FETCH_ASSOC)) {
        $category[] = $fetch_total_category['category'];
        $catqty[] = $fetch_total_category['catqty'];
    }}

$show_total_gandc = $conn->prepare("SELECT count(*) as gandc from role as r, user as u where u.roleId=r.roleId and r.roleId='RO-0004' group by u.roleId UNION select count(*) as guest from  guest where guestId is not null;");
$show_total_gandc->execute();
if ($show_total_gandc->rowCount() > 0) {
    while ($fetch_total_gandc = $show_total_gandc->fetch(PDO::FETCH_ASSOC)) {
        $gandc[] = $fetch_total_gandc['gandc'];
    }}

?>

<!-- Start Verticle Menu -->

<?php include 'menu.php'?>

<!-- End Verticle Menu -->

<!-- Start Header -->

<div class="box-two">

    <div class="header">
    <section class="flex">

    <div class="header-container">
        <div><h1>Dashboard</h1></div>
        <div style="display: flex;"><?php include 'notify.php';?></div>
    </div>

    </section>
    </div>
</dv>

<!-- End Header -->

<div class="main">

    <div class="main-container">

    <div class="flexbox-one">

        <div class="dashboard-welcome">
            <h1>Hello <?php echo $_SESSION['userFName'] ?>,</h1>
            <p>Welcome Back!</p>
        </div>

        <div class="bar-chart-div">

            <div class="bar-chart-container">
            <h3>Sales & Revenue</h3>
                <div class="bar-chart">
                    <canvas id="barchart"></canvas>
                </div>
            </div>

        </div>

        <div class="Total">
        <div class="Total-box-container">

        <div class="Total-box">
            <div>
                <img src="img/customer.svg" alt="">
            </div>
            <div class="content">
                <p class="orderNo"><?php echo $customers; ?></p>
                <p>Total Customers</p>
            </div>
        </div>

        <div class="Total-box">
            <div>
                <img src="img/subscribe.svg" alt="">
            </div>
            <div class="content">
                <p class="orderNo"><?php echo $subscribers; ?></p>
                <p>Total Subscribers</p>
            </div>
        </div>

        </div>

        <div class="Total-box-container">

            <div class="Total-box" id="Total-box-one">
                <div>
                    <img src="img/products.svg" alt="">
                </div>
                <div class="content">
                    <p class="orderNo"><?php echo $totalproducts; ?></p>
                    <p>Total Foods</p>
                </div>
            </div>

        <div class="Total-box" id="Total-box-two">
            <div>
                <img src="img/feedback.svg" alt="">
            </div>
            <div class="content">
                <p class="orderNo"><?php echo $feedbacks; ?></p>
                <p>Total Feedbacks</p>
            </div>
        </div>
        </div>

</div>

    </div>

    <div class="flexbox-two">

        <div class="Total-box-container">

            <div class="Total-box">
                <div>
                    <img src="img/order.svg" alt="">
                </div>
                <div class="content">
                    <p class="orderNo"><?php echo $totalsales; ?></p>
                    <p>Lifetime Sales</p>
                </div>
            </div>

            <div class="Total-box">
                <div>
                    <img src="img/revenue.svg" alt="">
                </div>
                <div class="content">
                    <p class="orderNo"><?php echo ($revenue / 1000) . " K"; ?></p>
                    <p>Lifetime Revenue</p>
                </div>
            </div>
        </div>

        <div class="bar-chart-div">

            <div class="bar-chart-container">
                    <h3>Top 05 Highest Selling Foods</h3>
                <div class="bar-chart">
                    <canvas id="Hbarchart"></canvas>
                </div>

            </div>
        </div>

        <div class="chart-container">

        <div class="pie-chart-container">
        <h3>Categories</h3>
            <div class="pie-chart">
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <div class="polar-chart-container">
        <h3>Customers</h3>
            <div class="polar-area">
                <canvas id="polararea"></canvas>
            </div>
        </div>

        </div>
</div>

    </div>

    </div>
</div>

    <!-- custom js file link -->
    <!-- <script src='js/chart.js'></script> -->
    <?php include 'chart.php';?>
    <script src='js/notify.js'></script>

</body>

</html>


