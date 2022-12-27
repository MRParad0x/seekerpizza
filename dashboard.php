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
        <div><i class="fa-solid fa-bell"></i><a class="menubtn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></div>
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

        <div class="Total-box-container">

        <div class="Total-box">
            <div>
                <img src="img/customer.svg" alt="">
            </div>
            <div class="content">
                <p class="orderNo">1000</p>
                <p>Total Customers</p>
            </div>
        </div>

        <div class="Total-box">
            <div>
                <img src="img/subscribe.svg" alt="">
            </div>
            <div class="content">
                <p class="orderNo">1000</p>
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
                    <p class="orderNo">1000</p>
                    <p>Total Products</p>
                </div>
            </div>

        <div class="Total-box" id="Total-box-two">
            <div>
                <img src="img/feedback.svg" alt="">
            </div>
            <div class="content">
                <p class="orderNo">1000</p>
                <p>Total Feedbacks</p>
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
                    <p class="orderNo">1000</p>
                    <p>Lifetime Sales</p>
                </div>
            </div>

            <div class="Total-box">
                <div>
                    <img src="img/revenue.svg" alt="">
                </div>
                <div class="content">
                    <p class="orderNo">1000</p>
                    <p>Lifetime Revenue</p>
                </div>
            </div>
        </div>

        <div class="chart-container">

        <div class="pie-chart-container">
        <h3>Highest Selling Categories</h3>
            <div class="pie-chart">
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <div class="polar-chart-container">
        <h3>Users</h3>
            <div class="polar-area">
                <canvas id="polararea"></canvas>
            </div>
        </div>

        </div>

        <div class="bar-chart-div">

            <div class="bar-chart-container">
                    <h3>Highest Selling Foods</h3>
                <div class="bar-chart">
                    <canvas id="Hbarchart"></canvas>
                </div>

            </div>
        </div>
</div>

    </div>

    </div>
</div>

    <!-- custom js file link  -->
    <script src='js/chart.js'></script>


</body>

</html>


