<?php
include 'conn.php';

session_start();

if(!isset($_SESSION['roleType'])){
   header('location:login.php');
}

if(isset($_POST['add_subscriber'])){

    $subscriberName = $_POST['subscriberName'];
    $subscriberName = filter_var($subscriberName, FILTER_UNSAFE_RAW);
    $subscriberEmail = $_POST['subscriberEmail'];
    $subscriberEmail = filter_var($subscriberEmail, FILTER_UNSAFE_RAW);

    $insert_subscriber = $conn->prepare("INSERT INTO subscriber (subscriberName, subscriberEmail) VALUES(?,?)");
    $insert_subscriber->execute([$subscriberName, $subscriberEmail]);
    $add[] = 'New Subscriber has been successfully added.';
}

if(isset($_POST['update_subscriber'])){

    $subscriberId= $_POST['subscriberId'];
    $subscriberId = filter_var($subscriberId, FILTER_UNSAFE_RAW);
    $subscriberName = $_POST['subscriberName'];
    $subscriberName = filter_var($subscriberName, FILTER_UNSAFE_RAW);
    $subscriberEmail = $_POST['subscriberEmail'];
    $subscriberEmail = filter_var($subscriberEmail, FILTER_UNSAFE_RAW);

    $update_subscriber = $conn->prepare("UPDATE subscriber SET subscriberName = ?, subscriberEmail = ? WHERE subscriberId = ?");
    $update_subscriber->execute([$subscriberName, $subscriberEmail, $subscriberId]);
    $update[] = 'Subscriber has been successfully updated.';
}
    
    if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_subscriber = $conn->prepare("DELETE FROM subscriber WHERE subscriberId = ?");
    $delete_subscriber->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM cart WHERE subscriberId = ?");
    // $delete_cart->execute([$delete_id]);
    header('location:subscriber.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>subscriber</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/subscriber.css'>

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
        <div><h1>Subscriber</h1></div>

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

        <div><i class="fa-solid fa-bell"></i><button id="addbtn" onclick="openPopup()"> + Add subscriber</button></div>
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
    <button id="subprintbtn"><i class="fa-solid fa-print"></i><span>Print</span></button>
    <button id="exportbtn"><i class="fa-solid fa-file-export"></i><span>Export</span></button>
    </div>

    </div>

    </section>
    </div>

<!-- End Start Search Filter Export Functions -->

<!-- Start subscriber List -->

    <div class="subscriber-list">
    <section class="flex">

    <div class="subscriber-list-container">
			<table id="productlist" class="subscriber-list-table">
				<thead>
					<tr>
						<th>ID<i class="fa-solid fa-sort"></i></th>
						<th>Name<i class="fa-solid fa-sort"></i></th>
                        <th>Email<i class="fa-solid fa-sort"></i></th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php
    $show_subscriber = $conn->prepare("SELECT * FROM subscriber");
    $show_subscriber->execute();
    if($show_subscriber->rowCount() > 0){
    while($fetch_subscriber = $show_subscriber->fetch(PDO::FETCH_ASSOC)){
    ?>

					<tr>
                        <td><?= $fetch_subscriber['subscriberId']; ?></td>
                        <td><?= $fetch_subscriber['subscriberName']; ?></td>
                        <td><?= $fetch_subscriber['subscriberEmail']; ?></td>
						<td>
                            <div class="action">
                                <a id="clickMe" href="subscriber.php?update=<?= $fetch_subscriber['subscriberId']; ?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="subscriber.php?delete=<?= $fetch_subscriber['subscriberId']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this subscriber?');" ><i class="fa-solid fa-trash"></i></a>
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

<!-- End subscriber List -->

<!-- Start Pop-up subscriber Add Box -  -->

    <div class="popup-container">
    <div class="popup-box-one" id="popupone">
    <button class="fa-solid fa-circle-xmark" onclick="closePopup()"></button>
    <h2>Add subscriber</h2>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="submitPopup()">
        <table class="pro-form">
            <tr>
                <td><input type="text" name="subscriberName" placeholder="Subscriber Name" required></td>
            </tr>
            <tr>
                <td><input type="email" name="subscriberEmail" placeholder="Subscriber Email" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="add_subscriber" value="Add" ></td>
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
    <p>The subscriber has been successfully added.</p>
    <button onclick="okay();">Okay</button>
    </div> -->

<!-- End Pop-up subscriber Add Box -  -->

<!-- Start Pop-up subscriber Update Box -  -->

    <div class="popup-container">
    <div class="popup-box-three" id="popupthree">
    <button class="fa-solid fa-circle-xmark" onclick="closeUpdatePopup()"></button>
    <h2>Update Subscriber</h2>

    <?php
    if(isset($_GET['update'])){
    $update_id = $_GET['update'];
    $show_subscriber = $conn->prepare("SELECT * FROM subscriber WHERE subscriberId = ?");
    $show_subscriber->execute([$update_id]);
    if($show_subscriber->rowCount() > 0){
    while($fetch_subscriber = $show_subscriber->fetch(PDO::FETCH_ASSOC)){  
    ?>

    <form action="subscriber.php" method="post" enctype="multipart/form-data">
        <table class="pro-form">
            <tr>
                <td><input type="hidden" name="subscriberId" value="<?= $fetch_subscriber['subscriberId']; ?>" ></td>
            </tr>
            <tr>
                <td><input type="text" name="subscriberName" placeholder="Subscriber Name" value="<?= $fetch_subscriber['subscriberName']; ?>" ></td>
            </tr>
            <tr>
                <td><input type="email" name="subscriberEmail" placeholder="Subscriber Email" value="<?= $fetch_subscriber['subscriberEmail']; ?>" ></td>
            </tr>
            <tr>
                <td><input type="submit" name="update_subscriber" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
         }
    }else{
    echo '<p class="empty">no subscriber added yet!</p>';
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
    <p>The subscriber has been successfully updated.</p>
    <button onclick="okay();">Okay</button>
    </div>
    </div> -->

<!-- End Pop-up subscriber Update Box -  -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/print.js'></script>
    <script src='js/export.js'></script>
    <script src='js/sort.js'></script>
    
</body>

</html>
    

