<?php
include 'conn.php';

session_start();

if(!isset($_SESSION['roleType'])){
   header('location:login.php');
}

if(isset($_POST['add_category'])){

    $categoryName = $_POST['categoryName'];
    $categoryName = filter_var($categoryName, FILTER_UNSAFE_RAW);

    $insert_category = $conn->prepare("INSERT INTO category (categoryName) VALUES(?)");
    $insert_category->execute([$categoryName]);
    $add[] = 'New Category has been successfully added.';
}

if(isset($_POST['update_category'])){

    $categoryId = $_POST['categoryId'];
    $categoryId = filter_var($categoryId, FILTER_UNSAFE_RAW);
    $categoryName = $_POST['categoryName'];
    $categoryName = filter_var($categoryName, FILTER_UNSAFE_RAW);

    $update_category = $conn->prepare("UPDATE category SET categoryName = ? WHERE categoryId = ?");
    $update_category->execute([$categoryName, $categoryId]);
    $update[] = 'Category has been successfully updated.';
}
    
    if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_category = $conn->prepare("DELETE FROM category WHERE categoryId = ?");
    $delete_category->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM cart WHERE categoryId = ?");
    // $delete_cart->execute([$delete_id]);
    header('location:category.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Category</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/category.css'>

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

<div class="flexbox" id="blur">
<div class="box-one">

    <div class="logo">
    <img src="img/logovertical.png" alt="">
    </div>

    <?php include 'menu.php' ?>
    
    <div class="profile-box">
    <div class="profile-logo">
    <img src="img/profile.png" alt="">
    <h4>Lahiru Chinthana</h4>
    </div>

    <div class="profile-setting">
    <i class="fa-solid fa-gear"></i>
    <a class="menubtn" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
    </div>

</div>

<!-- End Verticle Menu -->

<!-- Start Header -->

<div class="box-two">

    <div class="header">
    <section class="flex">

    <div class="header-container">
        <div><h1>Category</h1></div>
        <div>
        <?php
        if(isset($add)){
        foreach($add as $add){
        echo '<span id="success" class="success-msg">'.$add.'</span>';
        };
        };
        ?>
        <?php
        if(isset($update)){
        foreach($update as $update){
        echo '<span id="success" class="success-msg">'.$update.'</span>';
        };
        };
        ?>
        <?php
        if(isset($delete)){
        foreach($delete as $delete){
        echo '<span id="delete" class="delete-msg">'.$delete.'</span>';
        };
        };
        ?>
        </div>
        <div><i class="fa-solid fa-bell"></i><button id="addbtn" onclick="openPopup()"> + Add Category</button></div>
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
    <button id="catprintbtn"><i class="fa-solid fa-print"></i><span>Print</span></button>
    <button id="exportbtn"><i class="fa-solid fa-file-export"></i><span>Export</span></button>
    </div>

    </div>

    </section>
    </div>

<!-- End Start Search Filter Export Functions -->

<!-- Start category List -->

    <div class="category-list">
    <section class="flex">

    <div class="category-list-container">
			<table id="productlist" class="category-list-table">
				<thead>
					<tr>
						<th>ID<i class="fa-solid fa-sort"></i></th>
						<th>Name<i class="fa-solid fa-sort"></i></th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php
    $show_category = $conn->prepare("SELECT * FROM category");
    $show_category->execute();
    if($show_category->rowCount() > 0){
    while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){
    ?>

					<tr>
                        <td><?= $fetch_category['categoryId']; ?></td>
                        <td><?= $fetch_category['categoryName']; ?></td>
						<td>
                            <div class="action">
                                <a id="clickMe" href="category.php?update=<?= $fetch_category['categoryId']; ?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="category.php?delete=<?= $fetch_category['categoryId']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this category?');" ><i class="fa-solid fa-trash"></i></a>
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

<!-- End category List -->

<!-- Start Pop-up category Add Box -  -->

    <div class="popup-container">
    <div class="popup-box-one" id="popupone">
    <button class="fa-solid fa-circle-xmark" onclick="closePopup()"></button>
    <h2>+ Add New Category</h2>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="submitPopup()">
        <table class="pro-form">
            <tr>
                <td><input type="text" name="categoryName" placeholder="category Name" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="add_category" value="Add" ></td>
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
    <p>The category has been successfully added.</p>
    <button onclick="okay();">Okay</button>
    </div> -->

<!-- End Pop-up category Add Box -  -->

<!-- Start Pop-up category Update Box -  -->

    <div class="popup-container">
    <div class="popup-box-three" id="popupthree">
    <button class="fa-solid fa-circle-xmark" onclick="closeUpdatePopup()"></button>
    <h2>Update Category</h2>

    <?php
    if(isset($_GET['update'])){
    $update_id = $_GET['update'];
    $show_category = $conn->prepare("SELECT * FROM category WHERE categoryId = ?");
    $show_category->execute([$update_id]);
    if($show_category->rowCount() > 0){
    while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){  
    ?>

    <form action="category.php" method="post" enctype="multipart/form-data">
        <table class="pro-form">
            <tr>
                <td><input type="hidden" name="categoryId" value="<?= $fetch_category['categoryId']; ?>" ></td>
            </tr>
            <tr>
                <td><input type="text" name="categoryName" placeholder="Category Name" value="<?= $fetch_category['categoryName']; ?>" ></td>
            </tr>
            <tr>
                <td><input type="submit" name="update_category" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
         }
    }else{
    echo '<p class="empty">no category added yet!</p>';
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
    <p>The category has been successfully updated.</p>
    <button onclick="okay();">Okay</button>
    </div>
    </div> -->

<!-- End Pop-up category Update Box -  -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/print.js'></script>
    <script src='js/export.js'></script>
    <script src='js/sort.js'></script>
    
</body>

</html>
    

