<?php
include 'conn.php';

session_start();

if(!isset($_SESSION['roleType'])){
   header('location:login.php');
}

if(isset($_POST['add_role'])){

    $roleType = $_POST['roleType'];
    $roleType = filter_var($roleType, FILTER_UNSAFE_RAW);

    $insert_role = $conn->prepare("INSERT INTO role (roleType) VALUES(?)");
    $insert_role->execute([$roleType]);
    $add[] = 'New Role has been successfully added.';
}

if(isset($_POST['update_role'])){

    $roleId = $_POST['roleId'];
    $roleId = filter_var($roleId, FILTER_UNSAFE_RAW);
    $roleType = $_POST['roleType'];
    $roleType = filter_var($roleType, FILTER_UNSAFE_RAW);

    $update_role = $conn->prepare("UPDATE role SET roleType = ? WHERE roleId = ?");
    $update_role->execute([$roleType, $roleId]);
    $update[] = 'Role has been successfully updated.';
}
    
    if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_role = $conn->prepare("DELETE FROM role WHERE roleId = ?");
    $delete_role->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM cart WHERE roleId = ?");
    // $delete_cart->execute([$delete_id]);
    header('location:role.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Role</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/role.css'>

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
        <div><h1>Role</h1></div>

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

        <div><i class="fa-solid fa-bell"></i><button id="addbtn" onclick="openPopup()"> + Add Role</button></div>
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
    <button id="rolprintbtn"><i class="fa-solid fa-print"></i><span>Print</span></button>
    <button id="exportbtn"><i class="fa-solid fa-file-export"></i><span>Export</span></button>
    </div>

    </div>

    </section>
    </div>

<!-- End Start Search Filter Export Functions -->

<!-- Start role List -->

    <div class="role-list">
    <section class="flex">

    <div class="role-list-container">
			<table id="productlist" class="role-list-table">
				<thead>
					<tr>
						<th>ID<i class="fa-solid fa-sort"></i></th>
						<th>Type<i class="fa-solid fa-sort"></i></th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php
    $show_role = $conn->prepare("SELECT * FROM role");
    $show_role->execute();
    if($show_role->rowCount() > 0){
    while($fetch_role = $show_role->fetch(PDO::FETCH_ASSOC)){
    ?>

					<tr>
                        <td><?= $fetch_role['roleId']; ?></td>
                        <td><?= $fetch_role['roleType']; ?></td>
						<td>
                            <div class="action">
                                <a id="clickMe" href="role.php?update=<?= $fetch_role['roleId']; ?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="role.php?delete=<?= $fetch_role['roleId']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this role?');" ><i class="fa-solid fa-trash"></i></a>
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

<!-- End role List -->

<!-- Start Pop-up role Add Box -  -->

    <div class="popup-container">
    <div class="popup-box-one" id="popupone">
    <button class="fa-solid fa-circle-xmark" onclick="closePopup()"></button>
    <h2>Add Role</h2>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="submitPopup()">
        <table class="pro-form">
            <tr>
                <td><input type="text" name="roleType" placeholder="role Name" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="add_role" value="Add" ></td>
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
    <p>The role has been successfully added.</p>
    <button onclick="okay();">Okay</button>
    </div> -->

<!-- End Pop-up role Add Box -  -->

<!-- Start Pop-up role Update Box -  -->

    <div class="popup-container">
    <div class="popup-box-three" id="popupthree">
    <button class="fa-solid fa-circle-xmark" onclick="closeUpdatePopup()"></button>
    <h2>Update role</h2>

    <?php
    if(isset($_GET['update'])){
    $update_id = $_GET['update'];
    $show_role = $conn->prepare("SELECT * FROM role WHERE roleId = ?");
    $show_role->execute([$update_id]);
    if($show_role->rowCount() > 0){
    while($fetch_role = $show_role->fetch(PDO::FETCH_ASSOC)){  
    ?>

    <form action="role.php" method="post" enctype="multipart/form-data">
        <table class="pro-form">
            <tr>
                <td><input type="hidden" name="roleId" value="<?= $fetch_role['roleId']; ?>" ></td>
            </tr>
            <tr>
                <td><input type="text" name="roleType" placeholder="Role Type" value="<?= $fetch_role['roleType']; ?>" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="update_role" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
         }
    }else{
    echo '<p class="empty">no role added yet!</p>';
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
    <p>The role has been successfully updated.</p>
    <button onclick="okay();">Okay</button>
    </div>
    </div> -->

<!-- End Pop-up role Update Box -  -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/print.js'></script>
    <script src='js/export.js'></script>
    <script src='js/sort.js'></script>
    
</body>

</html>
    

