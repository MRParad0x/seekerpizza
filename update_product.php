<?php
include 'conn.php';

if(isset($_POST['add_product'])){

    $productCategory = $_POST['productCategory'];
    $productCategory = filter_var($productCategory, FILTER_UNSAFE_RAW);
    $productId = $_POST['productId'];
    $productId = filter_var($productId, FILTER_UNSAFE_RAW);
    $productName = $_POST['productName'];
    $productName = filter_var($productName, FILTER_UNSAFE_RAW);
    $productPrice = $_POST['productPrice'];
    $productPrice = filter_var($productPrice, FILTER_UNSAFE_RAW);
    $productDescription = $_POST['productDescription'];
    $productDescription = filter_var($productDescription, FILTER_UNSAFE_RAW);

    $filename = $_FILES['image']['name'];
    $filename = filter_var($filename, FILTER_UNSAFE_RAW);
    $tmpname = $_FILES['image']['tmp_name'];
    $dir = 'uploads/'.$filename;

    $select_products = $conn->prepare("SELECT * FROM products WHERE productId = ?");
    $select_products->execute([$productId]);

    if($select_products->rowCount() > 0){
      $message[] = 'product id already exists!';
    }else{
         move_uploaded_file($tmpname, $dir);
         $insert_product = $conn->prepare("INSERT INTO products (productId, productName, productCategory, productPrice, productDescription, productImage) VALUES(?,?,?,?,?,?)");
         $insert_product->execute([$productId, $productName, $productCategory, $productPrice, $productDescription, $filename]);
         $message[] = 'new product added!';
    }

    if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM products WHERE productId = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploads/'.$fetch_delete_image['image']);
    $delete_product = $conn->prepare("DELETE FROM products WHERE productid = ?");
    $delete_product->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM cart WHERE productId = ?");
    // $delete_cart->execute([$delete_id]);
    header('location:products.php');
}
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/product.css'>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- google custom font link  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- google poppins font link  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Start Pop-up Box -  -->

    <div class="popup-container">
    <div class="popup-box-one" id="popupone">
    <button class="fa-solid fa-circle-xmark" onclick="closePopup()"></button>
    <h2>Update Product</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <table class="pro-form">
            <tr>
            <td>
                <img id="file-preview"></td>
            </tr>
            <tr>
            <td>
            <label for="file-upload">Upload Image</label>
            <input type="file" name="image" id="file-upload" accept="image/*" onchange="showPreview(event);">
            </td>
            </tr>
            <tr>
                <td>
                <select name="productCategory">
                    <option value="" disabled selected>Select</option>
                    <option value="pizza">Pizza</option>
                    <option value="pasta">Pasta</option>
                    <option value="dessert">Dessert</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="productId" placeholder="Product ID" ></td>
            </tr>
            <tr>
                <td><input type="text" name="productName" placeholder="Product Name" ></td>
            </tr>
            <tr>
                <td><input type="text" name="productPrice" placeholder="Product Price" ></td>
            </tr>
            <tr>
                <td>
                  <textarea name="productDescription" rows="4" cols="50" placeholder="Product Description"></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="add_product" value="Update" onclick="submitPopup()"></td>
            </tr>
        </table>
    </form>
    </div>

    <div class="popup-box-two" id="popuptwo">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
    </svg>
    <h2>Done!</h2>
    <p>The product has been successfully updated.</p>
    <button onclick="okay();">Okay</button>
    </div>
    </div>

    <!-- End Pop-up Box -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
</body>

</html>
    

