<div class="order-list">
    <section class="flex">

    <div class="order-list-container">
			<table id="productlist" class="order-list-table">
				<thead>
					<tr>
						<th>ID<i class="fa-solid fa-sort"></i></th>
                        <th>Product Name<i class="fa-solid fa-sort"></i></th>
						<th>Total Qty<i class="fa-solid fa-sort"></i></th>
						<th>Total Revenue<i class="fa-solid fa-sort"></i></th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php
$show_orders = $conn->prepare("SELECT sp_order.orderId, sp_order.orderDate, sp_order.orderTotal, sp_order.orderStatus, user.userFName, user.userLName FROM sp_order INNER JOIN USER ON sp_order.userNIC = user.userNIC");
$show_orders->execute();
if ($show_orders->rowCount() > 0) {
    while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {
        ?>

					<tr>
                        <td><input type="hidden" name="orderId" value="<?=$fetch_orders['orderId'];?>" ><?=$fetch_orders['orderId'];?></td>
                        <td><?=$fetch_orders['orderDate'];?></td>
						<td><?=$fetch_orders['userFName'];?> <?=$fetch_orders['userLName'];?></td>
						<td><?=$fetch_orders['orderTotal'];?></td>
                        <td id="status_color"><?=$fetch_orders['orderStatus'];?></td>
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