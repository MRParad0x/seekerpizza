<?php

if (isset($_POST['clearnotify'])) {

    $void = $_POST['void'];
    $void = filter_var($void, FILTER_UNSAFE_RAW);

    $delete_notification = $conn->prepare("DELETE FROM notification WHERE orderId = ?");
    $delete_notification->execute([$void]);
}

?>
<?php if ($_SESSION['roleType'] == 'Admin' || $_SESSION['roleType'] == 'Cashier') {?>
<div class="dropdown">
<i id="notifyicon" class="fa-solid fa-bell"></i>
  <div class="dropdown-menu">
    <h3>Notifcations</h3>
    <div class="notify-container">

<?php
$show_orderid = $conn->prepare("SELECT orderId from notification");
    $show_orderid->execute([]);
    if ($show_orderid->rowCount() > 0) {
        while ($fetch_orderid = $show_orderid->fetch(PDO::FETCH_ASSOC)) {?>
    <form action="order.php?vieworder=<?=$fetch_orderid['orderId'];?>" method="post">
    <div class="notifymsg">
      <input type="hidden" name="void" value="<?=$fetch_orderid['orderId'];?>">
        <p id="notifymsg"><span class="fa-solid fa-gift"></span>You have received a new order<span class="neworder">#<?=$fetch_orderid['orderId'];?></span><input type="submit" name="clearnotify" value="View Order" class="notify-vieworder"></p>
    </div>
    </form>
    <?php }} else {?>
        <p class="nonotify">No New notfifications</p>
        <?php }?>
  </div>
  </div>
</div>
<?php }?>
<div>
<a class="menubtn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</div>