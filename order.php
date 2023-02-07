<?php
include 'conn.php';

session_start();

if (!isset($_SESSION['roleType'])) {
    header('location:login.php');
}

if (isset($_POST['update_order'])) {

    $orderId = $_POST['orderId'];
    $orderId = filter_var($orderId, FILTER_UNSAFE_RAW);
    $orderStatus = $_POST['orderStatus'];
    $orderStatus = filter_var($orderStatus, FILTER_UNSAFE_RAW);

    $update_order = $conn->prepare("UPDATE sp_order SET orderStatus = ? WHERE orderId = ?");
    $update_order->execute([$orderStatus, $orderId]);
    $update[] = 'Order status has been successfully updated.';
}

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_order_image = $conn->prepare("SELECT * FROM orders WHERE orderId = ?");
    $delete_order_image->execute([$delete_id]);
    $fetch_delete_image = $delete_order_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploads/' . $fetch_delete_image['image']);
    $delete_order = $conn->prepare("DELETE FROM orders WHERE orderId = ?");
    $delete_order->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM cart WHERE orderId = ?");
    // $delete_cart->execute([$delete_id]);
    header('location:order.php');

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Orders</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/order.css'>
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

</head>

<body onclick="load();">

<!-- Start Verticle Menu -->

<?php
include 'menu.php';
?>

<!-- End Verticle Menu -->

<!-- Start Header -->

<div class="box-two">

    <div class="header">
    <section class="flex">

    <div class="header-container">
        <div><h1>Orders</h1></div>

    <div>
    <?php
if (isset($add)) {
    foreach ($add as $add) {
        echo '<span id="success" class="success-msg">' . $add . '</span>';
    }
    ;
}
;
?>
    <?php
if (isset($update)) {
    foreach ($update as $update) {
        echo '<span id="success" class="success-msg">' . $update . '</span>';
    }
    ;
}
;
?>
    <?php
if (isset($delete)) {
    foreach ($delete as $delete) {
        echo '<span id="delete" class="delete-msg">' . $delete . '</span>';
    }
    ;
}
;
?>
    </div>
        <div style="display: flex;"><?php include 'notify.php';?></div>
    </div>

    </section>
    </div>

<!-- End Header -->

<!-- Start Search Filter Export Functions -->

    <div class="function">
    <section class="flex">

    <div class="function-container">

    <div class="search-form">
        <span class="fa fa-search" aria-hidden="true"></span>
        <input id="search" type="text" placeholder="Search" autofocus required />
    </div>

    <div class="function-button">
    <button id="ordprintbtn"><i class="fa-solid fa-print"></i><span>Print</span></button>
    <button id="exportbtn"><i class="fa-solid fa-file-export"></i><span>Export</span></button>
    </div>

    </div>

    </section>
    </div>

<!-- End Start Search Filter Export Functions -->

<!-- Start order List -->

    <div class="order-list">
    <section class="flex">

    <div class="order-list-container">
			<table id="productlist" class="order-list-table">
				<thead>
					<tr>
						<th>ID<i class="fa-solid fa-sort"></i></th>
                        <th>Date<i class="fa-solid fa-sort"></i></th>
						<th>Customer<i class="fa-solid fa-sort"></i></th>
						<th>Total<i class="fa-solid fa-sort"></i></th>
						<th>Status<i class="fa-solid fa-sort"></i></th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php
// $show_orders = $conn->prepare("SELECT sp_order.orderId, sp_order.orderDate, sp_order.orderTotal, sp_order.orderStatus, user.userFName, user.userLName FROM sp_order INNER JOIN USER ON sp_order.userNIC = user.userNIC");
$show_orders = $conn->prepare("SELECT sp_order.orderId, sp_order.orderDate, sp_order.orderTotal, sp_order.orderStatus, user.userFName, user.userLName FROM sp_order INNER JOIN USER ON sp_order.userNIC = user.userNIC UNION SELECT sp_order.orderId, sp_order.orderDate, sp_order.orderTotal, sp_order.orderStatus, guest.guestFName, guest.guestLName FROM sp_order INNER JOIN guest ON sp_order.guestNIC = guest.guestNIC");
$show_orders->execute();
if ($show_orders->rowCount() > 0) {
    while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {
        ?>

					<tr>
                        <td><input type="hidden" name="orderId" value="<?=$fetch_orders['orderId'];?>" ><?=$fetch_orders['orderId'];?></td>
                        <td><?=$fetch_orders['orderDate'];?></td>
						<td><?=$fetch_orders['userFName'];?> <?=$fetch_orders['userLName'];?></td>
						<td><?=$fetch_orders['orderTotal'];?></td>
                        <td class="status_color" ><?=$fetch_orders['orderStatus'];?></td>
						<td>
                            <div class="action">
                                <a href="order.php?vieworder=<?=$fetch_orders['orderId'];?>" class="vieworder" ><i class="fa-solid fa-eye"></i></a>
                                <a id="clickMe" href="order.php?update=<?=$fetch_orders['orderId'];?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="order.php?delete=<?=$fetch_orders['orderId'];?>" class="delete" onclick="return confirm('Are you sure you want to delete this order?');" ><i class="fa-solid fa-trash"></i></a>
                            </div>
						</td>
					</tr>
        <?php
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

<!-- End order List -->

<!-- Start Pop-up order Add Box -  -->



<!-- End Pop-up order Add Box -  -->

<!-- Start Pop-up order Update Box -  -->

    <div class="popup-container">
    <div class="popup-box-three" id="popupthree">
    <button class="fa-solid fa-circle-xmark" onclick="closeUpdatePopup()"></button>
    <h2>Update Order</h2>

    <?php
if (isset($_GET['update'])) {
    $update_id = $_GET['update'];
    $show_orders = $conn->prepare("SELECT sp_order.orderId, sp_order.orderDate, sp_order.orderTotal, sp_order.orderStatus, user.userFName, user.userLName FROM sp_order INNER JOIN USER ON sp_order.userNIC = user.userNIC WHERE orderId = ?");
    $show_orders->execute([$update_id]);
    if ($show_orders->rowCount() > 0) {
        while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>

    <form action="order.php" method="post" enctype="multipart/form-data">
        <table class="pro-form">
            <tr>
                <td><input type="hidden" name="orderId" value="<?=$fetch_orders['orderId'];?>" ></td>
            </tr>
            <tr>
                <td>
                <select name="orderStatus" required>
                <option value="" selected hidden><?=$fetch_orders['orderStatus'];?></option>
                <option value="Cancelled">Cancelled</option>
                <option value="Refunded">Refunded</option>
                <option value="Pending">Processing</option>
                <option value="Preparing">Preparing</option>
                <option value="Ready">Ready</option>
                <option value="Completed">Completed</option>
                </select>
                </td>
            <tr>
                <td><input type="submit" name="update_order" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
}
    } else {
        echo '<p class="empty">no orders added yet!</p>';
    }
}
?>
    </div>

<!-- End Pop-up order Update Box -  -->

<!-- Start Pop-up View order Update Box -  -->

    <div class="popup-container">
    <div class="popup-box-four" id="popupfour">
    <button class="fa-solid fa-circle-xmark" onclick="closeViewOrderPopup()"></button>
    <h2>Order Details</h2>

        <table table id="viewordertlistone" class="view-order-list-table">
            <thead class="thead-one">
                	<tr>
                        <th>Order_Id</th>
						<th>Order_Date</th>
                        <th>Status</th>
                        <th>Discount</th>
						<th>Total</th>
                        <th>Name</th>
						<th>Address</th>
					</tr>
            </thead>

    <?php
if (isset($_GET['vieworder'])) {
    $order_id = $_GET['vieworder'];

    $show_guest_orders = $conn->prepare("SELECT sp_order.orderId, sp_order.orderDate, sp_order.orderStatus, sp_order.orderDiscount, sp_order.orderTotal, guest.guestNIC, guest.guestFName, guest.guestLName, guest.guestAddress from sp_order INNER JOIN guest ON sp_order.guestNIC = guest.guestNIC  WHERE orderId = ?;");
    $show_guest_orders->execute([$order_id]);
    if ($show_guest_orders->rowCount() > 0) {
        while ($fetch_guest_orders = $show_guest_orders->fetch(PDO::FETCH_ASSOC)) {
            if ($fetch_guest_orders['guestNIC'] != null) {
                ?>

<tbody class="tbody-one">

<tr>
   <td><?=$fetch_guest_orders['orderId'];?></td>
   <td><?=$fetch_guest_orders['orderDate'];?></td>
   <td><?=$fetch_guest_orders['orderStatus'];?></td>
   <td>- <?=$fetch_guest_orders['orderDiscount'];?></td>
   <td><?=$fetch_guest_orders['orderTotal'];?></td>
   <td><?=$fetch_guest_orders['guestFName'];?> <?=$fetch_guest_orders['guestLName'];?></td>
   <td><?=$fetch_guest_orders['guestAddress'];?></td>
</tr>

</tbody>

<?php }}}
    $show_user_orders = $conn->prepare("SELECT sp_order.orderId, sp_order.orderDate, sp_order.orderStatus, sp_order.orderDiscount, sp_order.orderTotal, user.userNIC, user.userFName, user.userLName, user.userAddress from sp_order INNER JOIN user ON sp_order.userNIC = user.userNIC  WHERE orderId = ?;");
    $show_user_orders->execute([$order_id]);
    if ($show_user_orders->rowCount() > 0) {
        while ($fetch_user_orders = $show_user_orders->fetch(PDO::FETCH_ASSOC)) {
            if ($fetch_user_orders['userNIC'] != null) {
                ?>

<tbody class="tbody-one">

         <tr>
            <td><?=$fetch_user_orders['orderId'];?></td>
            <td><?=$fetch_user_orders['orderDate'];?></td>
            <td><?=$fetch_user_orders['orderStatus'];?></td>
            <td>- <?=$fetch_user_orders['orderDiscount'];?></td>
            <td><?=$fetch_user_orders['orderTotal'];?></td>
            <td><?=$fetch_user_orders['userFName'];?> <?=$fetch_user_orders['userLName'];?></td>
            <td><?=$fetch_user_orders['userAddress'];?></td>
        </tr>

</tbody>


        <?php }}}}?>
</table>

    <div class="view-order-list-container">
        <table table id="viewordertlisttwo" class="view-order-list">
            <thead class="thead-one">
                	<tr>
                        <th>Item</th>
						<th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
						<th>Subtotal</th>
					</tr>
            </thead>

            <tbody class="tbody-one">

    <?php
$show_ordered_items = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, order_items.orderitemsQty, order_items.orderitemsTotal from products INNER JOIN order_items ON products.productId = order_items.productId WHERE orderId = ?");
$show_ordered_items->execute([$order_id]);
if ($show_ordered_items->rowCount() > 0) {
    while ($fetch_ordered_items = $show_ordered_items->fetch(PDO::FETCH_ASSOC)) {
        ?>
                     <tr>
                        <td><?=$fetch_ordered_items['productId'];?></td>
						<td><?=$fetch_ordered_items['productName'];?></td>
                        <td><?=$fetch_ordered_items['productPrice'];?></td>
						<td><?=$fetch_ordered_items['orderitemsQty'];?></td>
						<td><?=$fetch_ordered_items['orderitemsTotal'];?></td>
					</tr>

    <?php
}
} else {
    echo '<p class="empty">no orders added yet!</p>';
}
?>

            </tbody>
        </table>
</div>
</div>

<!-- End Pop-up View order Update Box -  -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/status.js'></script>
    <script src='js/print.js'></script>
    <script src='js/export.js'></script>
    <script src='js/sort.js'></script>

    <script src='js/notify.js'></script>

</body>

</html>


