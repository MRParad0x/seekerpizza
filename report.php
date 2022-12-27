<?php
include 'conn.php';

session_start();

if (!isset($_SESSION['roleType'])) {
    header('location:login.php');
}

$dateone = "2013-01-08";
$datetwo = "2022-12-25";
$_SESSION['dateone'] = $dateone;
$_SESSION['datetwo'] = $datetwo;
$_SESSION['reportType'] = "Total Earnings";

if (isset($_POST['datesubmit'])) {

    $reportType = $_POST['reportType'];
    $reportType = filter_var($reportType, FILTER_UNSAFE_RAW);
    $_SESSION['reportType'] = $reportType;
    $dateone = $_POST['dateone'];
    $dateone = filter_var($dateone, FILTER_UNSAFE_RAW);
    $_SESSION['dateone'] = $dateone;
    $dateone = $_SESSION['dateone'];
    $datetwo = $_POST['datetwo'];
    $datetwo = filter_var($datetwo, FILTER_UNSAFE_RAW);
    $_SESSION['datetwo'] = $datetwo;
    $datetwo = $_SESSION['datetwo'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Report</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/report.css'>

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
        <div><h1>Report</h1></div>
        <div><i class="fa-solid fa-bell"></i><a class="menubtn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></div>
    </div>

    </section>
    </div>
</dv>

<!-- End Header -->

<!-- Start Search Filter Export Functions -->

<div class="function">
    <section class="flex">

    <form action="" method="post">
    <div class="function-container">

    <div class="date-form">
        <p class="date-form-label">From</p>
        <input id="search" name="dateone" type="date" value="2013-01-08" required />
        <p class="date-form-label">To</p>
        <input id="search" name="datetwo" type="date" value="2022-12-25" required />
        <select name="reportType">
            <option>Total Earnings</option>
            <option>Most Selling Products</option>
            <option>Least Selling Products</option>
        </select>
    </div>

    <div class="function-button">
        <button name="datesubmit" id="repviewbtn"><i class="fa-solid fa-eye"></i><span>View</span></button>
        <button id="ordprintbtn"><i class="fa-solid fa-print"></i><span>Print</span></button>
        <button id="exportbtn"><i class="fa-solid fa-file-export"></i><span>Export</span></button>
    </div>
    </div>
    </form>

    </section>
    </div>

<!-- End Start Search Filter Export Functions -->
    <div class="filter-title">
        <h2><?php echo $_SESSION['reportType']; ?></h2>
        <P><?php echo $_SESSION['dateone'] . " To " . $_SESSION['datetwo']; ?></P>
    </div>

<!-- Start view List -->

<div class="order-list">
    <section class="flex">

    <?php
if (isset($_SESSION['reportType']) && ($_SESSION['reportType'] !== "Total Earnings")) {

    $show_orders = $conn->prepare("select SUM(orderitemsQty) as total_qunatity,SUM(orderitemsTotal) as total_revenue from order_items where orderitemsDate between '$dateone' and '$datetwo';");
    $show_orders->execute();
    while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {?>


    <div class="order-list-container">
            <table class="grand-total-table">
                <tr>
                    <td>Grand Total</td>
                    <td></td>
                    <td><?=$fetch_orders['total_qunatity'];?></td>
                    <td><?=$fetch_orders['total_revenue'];?></td>
                </tr>
            </table>
    <?php }?>

			<table id="productlist" class="order-list-table">
				<thead>
					<tr>
						<th>ID<i class="fa-solid fa-sort"></i></th>
                        <th>Product<i class="fa-solid fa-sort"></i></th>
						<th>QTY<i class="fa-solid fa-sort"></i></th>
                        <th>Total Price<i class="fa-solid fa-sort"></i></th>
					</tr>
				</thead>
				<tbody id="pltable">

<?php } else {

    $show_orders = $conn->prepare("select SUM(orderitemsTotal) as revenue from order_items where orderitemsTotal between '2022-12-19' and '2023-01-23' is not null;");
    $show_orders->execute();
    while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {?>

    <div>
        <p class="revenue">LKR <?=$fetch_orders['revenue'];?></p>
    </div>

<?php }}?>

    <?php
if (isset($_SESSION['reportType']) && ($_SESSION['reportType'] == "Most Selling Products")) {
    $show_orders = $conn->prepare("select o.productId, p.productName, SUM(o.orderitemsQty) as QTY, SUM(o.orderitemsQty*p.productPrice) as Total_Price from order_items as o, products as p where p.productId = o.productId and o.orderitemsDate between '$dateone' and '$datetwo' group by p.productName order by SUM(orderitemsQty) DESC");
    $show_orders->execute();
    if ($show_orders->rowCount() > 0) {
        while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>

					<tr>
                        <td><?=$fetch_orders['productId'];?></td>
						<td><?=$fetch_orders['productName'];?></td>
						<td><?=$fetch_orders['QTY'];?></td>
                        <td><?=$fetch_orders['Total_Price'];?></td>
					</tr>
        <?php
}
    }
} else if (isset($_SESSION['reportType']) && ($_SESSION['reportType'] == "Least Selling Products")) {
    $show_orders = $conn->prepare("select o.productId, p.productName, SUM(o.orderitemsQty) as QTY, SUM(o.orderitemsQty*p.productPrice) as Total_Price from order_items as o, products as p where p.productId = o.productId and o.orderitemsDate between '$dateone' and '$datetwo' group by p.productName order by SUM(orderitemsQty) ASC");
    $show_orders->execute();
    if ($show_orders->rowCount() > 0) {
        while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>

					<tr>
                        <td><?=$fetch_orders['productId'];?></td>
						<td><?=$fetch_orders['productName'];?></td>
						<td><?=$fetch_orders['QTY'];?></td>
                        <td><?=$fetch_orders['Total_Price'];?></td>
					</tr>
<?php
}
    }
}
?>
				</tbody>
			</table>
        </div>
</div>
</section>
    </div>
</div>
</div>

<!-- End view List -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/print.js'></script>
    <script src='js/export.js'></script>
    <script src='js/sort.js'></script>
</body>

</html>


