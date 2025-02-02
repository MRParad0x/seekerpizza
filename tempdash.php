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
    <link rel='stylesheet' type='text/css' media='screen' href='css/tempdash.css'>

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

<body>

<!-- Start Verticle Menu -->

<?php include 'menu.php'?>

<!-- End Verticle Menu -->

<!-- Start Header -->

<div class="box-two">

    <div class="header">
    <section class="flex">

    <div class="header-container">
        <div><h1>Dashboard</h1></div>
        <div><i class="fa-solid fa-bell"></i></div>
        <!-- <button id="addbtn" onclick="openPopup()"> + Create Order</button> -->
    </div>

    </section>
    </div>
</dv>

<!-- End Header -->

<div class="main">

    <div class="block-box-one">

        <div class="dashboard-welcome">
            <h1>Hello <?php echo $_SESSION['userFName'] ?>,</h1>
            <p>Welcome Back!</p>
        </div>

        <div class="dashboard-monthly">

        <canvas id="myChart"></canvas>

            <!-- <div class="monthly-container">
            <div class="monthly-box-one">
                <p class="title">Revenue</p>
                <h2>LKR 100,000</h2>
                <img src="img/revenue.svg">
            </div>

            <div class="monthly-box-two">
                <p class="title">Orders</p>
                <h2>10K</h2>
                <img src="img/order.svg">
            </div>
            </div> -->

        </div>

        <div class="dashboard-monthly">

        <canvas id="pieChart"></canvas>

        </div>

        <div class="dashboard-today">

            <div class="today-container-one">
                <div class="today-box-one">
                <h1>1000+</h1>
                <p>Revenue</p>
                <h2>Today</h2>
                </div>

                <div class="today-box-two">
                <h1>LKR 10000</h1>
                <p>Orders</p>
                <h2>Today</h2>
                </div>
            </div>

            <div class="today-container-two">
                <div class="today-box-one">
                <h1>100+</h1>
                <p>Subscribers</p>
                <h2>Today</h2>
                </div>

                <div class="today-box-two">
                <h1>100+</h1>
                <p>Customers</p>
                <h2>Today</h2>
                </div>
            </div>

        </div>

    </div>

    <div class="block-box-two">

    <h1>Lifetime Summary</h1>

    <div class="block-box-two-container">

        <div class="lifetime-box-one-row">

            <div class="lifetime-box-one">
                <img src="img/order.svg" alt="">
                <div class="content">
                <h1>87K</h1>
                <p>Orders</p>
                </div>
            </div>

            <div class="lifetime-box-one">
                <img src="img/category.svg" alt="">
                <div class="content">
                <h1>10</h1>
                <p>Category</p>
                </div>
            </div>

        </div>

        <div class="lifetime-box-one-row">

            <div class="lifetime-box-one">
                <img src="img/products.svg" alt="">
                <div class="content">
                <h1>10</h1>
                <p>Products</p>
                </div>
            </div>

            <div class="lifetime-box-one">
                <img src="img/customer.svg" alt="">
                <div class="content">
                <h1>100</h1>
                <p>Customers</p>
                </div>
            </div>

        </div>

        <div class="lifetime-box-one-row">

            <div class="lifetime-box-one">
                <img src="img/coupon.svg" alt="">
                <div class="content">
                <h1>20</h1>
                <p>Coupons</p>
                </div>
            </div>

            <div class="lifetime-box-one">
                <img src="img/subscribe.svg" alt="">
                <div class="content">
                <h1>1000</h1>
                <p>Subscribers</p>
                </div>
            </div>

        </div>

        <div class="lifetime-box-one-row">

            <div class="lifetime-box-one">
                <img src="img/feedback.svg" alt="">
                <div class="content">
                <h1>4</h1>
                <p>Feedbacks</p>
                </div>
            </div>

            <div class="lifetime-box-one">
                <img src="img/users.svg" alt="">
                <div class="content">
                <h1>1100</h1>
                <p>Users</p>
                </div>
            </div>

        </div>

    </div>

</div>

    <!-- custom js file link  -->
    <script src='js/chart.js'></script>


</body>

</html>


