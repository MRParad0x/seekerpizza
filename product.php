<?php
include 'conn.php';

session_start();

if (!isset($_SESSION['roleType'])) {
    header('location:login.php');
}

if (isset($_POST['add_product'])) {

    $productCategory = $_POST['productCategory'];
    $productCategory = filter_var($productCategory, FILTER_UNSAFE_RAW);
    $productCoupon = $_POST['productCoupon'];
    $productCoupon = filter_var($productCoupon, FILTER_UNSAFE_RAW);
    // $productId = $_POST['productId'];
    // $productId = filter_var($productId, FILTER_UNSAFE_RAW);
    $productName = $_POST['productName'];
    $productName = filter_var($productName, FILTER_UNSAFE_RAW);
    $productPrice = $_POST['productPrice'];
    $productPrice = filter_var($productPrice, FILTER_UNSAFE_RAW);
    $productDescription = $_POST['productDescription'];
    $productDescription = filter_var($productDescription, FILTER_UNSAFE_RAW);

    $filename = $_FILES['image']['name'];
    $filename = filter_var($filename, FILTER_UNSAFE_RAW);
    $tmpname = $_FILES['image']['tmp_name'];
    $dir = 'uploads/' . $filename;

    move_uploaded_file($tmpname, $dir);
    $insert_product = $conn->prepare("INSERT INTO products (productName, categoryId, couponId, productPrice, productDescription, productImage) VALUES(?,?,?,?,?,?)");
    $insert_product->execute([$productName, $productCategory, $productCoupon, $productPrice, $productDescription, $filename]);
    $add[] = 'New Product has been successfully added.';
}

if (isset($_POST['update_product'])) {

    $productCategory = $_POST['productCategory'];
    $productCategory = filter_var($productCategory, FILTER_UNSAFE_RAW);
    $productCoupon = $_POST['productCoupon'];
    $productCoupon = filter_var($productCoupon, FILTER_UNSAFE_RAW);
    $productId = $_POST['productId'];
    $productId = filter_var($productId, FILTER_UNSAFE_RAW);
    $productName = $_POST['productName'];
    $productName = filter_var($productName, FILTER_UNSAFE_RAW);
    $productPrice = $_POST['productPrice'];
    $productPrice = filter_var($productPrice, FILTER_UNSAFE_RAW);
    $productDescription = $_POST['productDescription'];
    $productDescription = filter_var($productDescription, FILTER_UNSAFE_RAW);

    $old_image = $_POST['old_image'];
    $filename = $_FILES['image']['name'];
    $filename = filter_var($filename, FILTER_UNSAFE_RAW);
    $tmpname = $_FILES['image']['tmp_name'];
    $dir = 'uploads/' . $filename;

    if ($filename == null) {
        $update_product = $conn->prepare("UPDATE products SET productName = ?, categoryId = ?, couponId = ?, productPrice = ?, productDescription = ? WHERE productId = ?");
        $update_product->execute([$productName, $productCategory, $productCoupon, $productPrice, $productDescription, $productId]);
        $update[] = 'Product has been successfully updated.';
    } else {
        $update_product = $conn->prepare("UPDATE products SET productName = ?, categoryId = ?, couponId = ?, productPrice = ?, productDescription = ?, productImage = ? WHERE productId = ?");
        $update_product->execute([$productName, $productCategory, $productCoupon, $productPrice, $productDescription, $filename, $productId]);
        move_uploaded_file($tmpname, $dir);
        unlink('uploads/' . $old_image);
        $message[] = 'image updated!';
        $update[] = 'Product has been successfully updated.';
    }
    // $update_product1 = $conn->prepare("UPDATE category SET categoryId = ? WHERE categoryId = ?");
    // $update_product1->execute([$productCategory]);

    // $update_image = $conn->prepare("UPDATE products SET productImage = ? WHERE productId = ?");
    // $update_image->execute([$filename, $productId]);

    // if($select_products->rowCount() > 0){
    //   $message[] = 'product id already exists!';
    // }else{
    //      move_uploaded_file($tmpname, $dir);
    //      $insert_product = $conn->prepare("INSERT INTO products (productId, productName, productCategory, productPrice, productDescription, productImage) VALUES(?,?,?,?,?,?)");
    //      $insert_product->execute([$productId, $productName, $productCategory, $productPrice, $productDescription, $filename]);
    //      $message[] = 'new product added!';
    // }
}

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM products WHERE productId = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploads/' . $fetch_delete_image['image']);
    $delete_product = $conn->prepare("DELETE FROM products WHERE productId = ?");
    $delete_product->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM cart WHERE productId = ?");
    // $delete_cart->execute([$delete_id]);
    $delete[] = 'Product has been successfully deleted.';
    header('location:product.php');

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Product</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/product.css'>
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

<body>

<!-- Start Verticle Menu -->

<?php include 'menu.php'?>

<!-- End Verticle Menu -->

<!-- Start Header -->

<div class="box-two">

    <div class="header">
    <section class="flex">

    <div class="header-container">
        <div><h1>Product</h1></div>

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
        <div style="display: flex;"><button id="addbtn" onclick="openPopup()"> + Add Product</button><?php include 'notify.php';?></div>
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
    <button id="proprintbtn"><i class="fa-solid fa-print"></i><span>Print</span></button>
    <button id="exportbtn"><i class="fa-solid fa-file-export"></i><span>Export</span></button>
    </div>

    </div>

    </section>
    </div>

<!-- End Start Search Filter Export Functions -->

<!-- Start Product List -->

    <div class="product-list">
    <section class="flex">

    <div class="product-list-container">
			<table id="productlist" class="product-list-table">
				<thead>
					<tr>
                        <th></th>
						<th>ID<i class="fa-solid fa-sort"></i></th>
						<th>Name<i class="fa-solid fa-sort"></i></th>
						<th>Category<i class="fa-solid fa-sort"></i></th>
                        <th>Coupon<i class="fa-solid fa-sort"></i></th>
						<th>Price<i class="fa-solid fa-sort"></i></th>
						<!-- <th>Description<i class="fa-solid fa-sort"></i></th> -->
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php
$show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productDescription, products.productImage, category.categoryName, coupon.couponId, coupon.couponCode from products INNER JOIN category ON products.categoryId = category.categoryId INNER JOIN coupon ON products.couponId = coupon.couponId");
$show_products->execute();
if ($show_products->rowCount() > 0) {
    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

					<tr>
                    <td>
                        <div class="product-info-img">
                                <img src="uploads/<?=$fetch_products['productImage'];?>" alt="">
						</div>
						</td>
                        <td><input type="hidden" name="productId" value="<?=$fetch_products['productId'];?>" ><?=$fetch_products['productId'];?></td>
                        <td><?=$fetch_products['productName'];?></td>
						<td><?=$fetch_products['categoryName'];?></td>
                        <td><?=$fetch_products['couponCode'];?></td>
						<td><?=$fetch_products['productPrice'];?></td>
                        <!-- <td><?=$fetch_products['productDescription'];?></td> -->
						<td>
                            <div class="action">
                                <a id="clickMe" href="product.php?update=<?=$fetch_products['productId'];?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="product.php?delete=<?=$fetch_products['productId'];?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?');" ><i class="fa-solid fa-trash"></i></a>
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

<!-- End Product List -->

<!-- Start Pop-up Product Add Box -  -->

    <div class="popup-container">
    <div class="popup-box-one" id="popupone">
    <button class="fa-solid fa-circle-xmark" onclick="closePopup()"></button>
    <h2>+ Add New Product</h2>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="submitPopup()">
        <table class="pro-form">
            <tr>
            <td>
                <img id="add-file-preview" alt=""></td>
            </tr>
            <tr>
            <td>
            <label for="add-file-upload">Upload Image</label>
            <input type="file" name="image" id="add-file-upload" accept="image/*" onchange="showPreview(event);" required>
            </td>
            </tr>
            <tr>
                <td>
                <select name="productCategory" required>
            <option value="" disabled selected hidden>Select Category<i class="fa-solid fa-caret-down"></i></option>
    <?php
$show_category = $conn->prepare("SELECT * FROM category");
$show_category->execute();
if ($show_category->rowCount() > 0) {
    while ($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)) {
        ?>
                    <option value="<?=$fetch_category['categoryId'];?>"><?=$fetch_category['categoryName'];?></option>
    <?php
}
}
?>
                </select>
                </td>

            </tr>
            <tr>
                <td>
                <select name="productCoupon" required>
            <option value="" disabled selected hidden>Select Coupon<i class="fa-solid fa-caret-down"></i></option>
    <?php
$show_coupon = $conn->prepare("SELECT * FROM coupon");
$show_coupon->execute();
if ($show_coupon->rowCount() > 0) {
    while ($fetch_coupon = $show_coupon->fetch(PDO::FETCH_ASSOC)) {
        ?>
                    <option value="<?=$fetch_coupon['couponId'];?>"><?=$fetch_coupon['couponCode'];?></option>
    <?php
}
}
?>
                </select>
                </td>

            </tr>
            <tr>
                <td><input type="text" name="productName" placeholder="Product Name" required></td>
            </tr>
            <tr>
                <td><input type="number" name="productPrice" placeholder="Product Price" required></td>
            </tr>
            <tr>
                <td>
                  <textarea name="productDescription" rows="4" cols="50" placeholder="Product Description" required></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="add_product" value="Add" ></td>
            </tr>
        </table>
    </form>
    </div>

    <!-- <div class="popup-box-two" id="popuptwo">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
    </svg>
    <h2>Done!</h2>
    <p>The product has been successfully added.</p>
    <button onclick="okay();">Okay</button>
    </div> -->

<!-- End Pop-up Product Add Box -  -->

<!-- Start Pop-up Product Update Box -  -->

    <div class="popup-container">
    <div class="popup-box-three" id="popupthree">
    <button class="fa-solid fa-circle-xmark" onclick="closeUpdatePopup()"></button>
    <h2>Update Product</h2>

    <?php
if (isset($_GET['update'])) {
    $update_id = $_GET['update'];
    $show_products = $conn->prepare("SELECT products.productId, products.productName, products.productPrice, products.productDescription, products.productImage, category.categoryId, category.categoryName, coupon.couponId, coupon.couponCode from products INNER JOIN category ON products.categoryId = category.categoryId INNER JOIN coupon ON products.couponId = coupon.couponId WHERE productId = ?");
    $show_products->execute([$update_id]);
    if ($show_products->rowCount() > 0) {
        while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>

    <form action="product.php" method="post" enctype="multipart/form-data">
        <table class="pro-form">
            <tr>
            <td>
                <input type="hidden" name="old_image" value="<?=$fetch_products['productImage'];?>">
                <img src="uploads/<?=$fetch_products['productImage'];?>" id="update-file-preview"></td>
            </tr>
            <tr>
            <td>
            <label for="update-file-upload">Upload Image</label>
            <input type="file" name="image" value="<?=$fetch_products['productImage'];?>" id="update-file-upload" accept="image/*" onchange="updateShowPreview(event);">
            </td>
            </tr>
            <tr>
                <td><input type="hidden" name="productId" value="<?=$fetch_products['productId'];?>" ></td>
            </tr>
            <tr>
                <td>

                <select name="productCategory" required>
                <option value="<?=$fetch_products['categoryId'];?>" selected hidden><?=$fetch_products['categoryName'];?></option>
    <?php
$show_category1 = $conn->prepare("SELECT * FROM category");
            $show_category1->execute();
            if ($show_category1->rowCount() > 0) {
                while ($fetch_category1 = $show_category1->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                <option value="<?=$fetch_category1['categoryId'];?>"><?=$fetch_category1['categoryName'];?></option>
    <?php
}
            }
            ?>
                </select>
                </td>
            </tr>
            <tr>
                <td>

                <select name="productCoupon" required>
                <option value="<?=$fetch_products['couponId'];?>" selected hidden><?=$fetch_products['couponCode'];?></option>
    <?php
$show_coupon1 = $conn->prepare("SELECT * FROM coupon");
            $show_coupon1->execute();
            if ($show_coupon1->rowCount() > 0) {
                while ($fetch_coupon1 = $show_coupon1->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                <option value="<?=$fetch_coupon1['couponId'];?>"><?=$fetch_coupon1['couponCode'];?></option>
    <?php
}
            }
            ?>
                </select>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="productName" placeholder="Product Name" value="<?=$fetch_products['productName'];?>" ></td>
            </tr>
            <tr>
                <td><input type="number" name="productPrice" placeholder="Product Price" value="<?=$fetch_products['productPrice'];?>" ></td>
            </tr>
            <tr>
                <td>
                  <textarea name="productDescription" rows="4" cols="50" placeholder="Product Description"><?=$fetch_products['productDescription'];?></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="update_product" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
}
    } else {
        echo '<p class="empty">no products added yet!</p>';
    }
}
?>
    </div>

    <!-- <div class="popup-box-four" id="popupfour">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
    </svg>
    <h2>Done!</h2>
    <p>The product has been successfully updated.</p>
    <button onclick="okay();">Okay</button>
    </div>
    </div> -->

<!-- End Pop-up Product Update Box -  -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/print.js'></script>
    <script src='js/export.js'></script>
    <script src='js/sort.js'></script>
    <script src='js/notify.js'></script>

</body>

</html>


