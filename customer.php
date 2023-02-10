<?php
include 'conn.php';

session_start();

if (!isset($_SESSION['roleType'])) {
    header('location:login.php');
}

if (isset($_POST['add_user'])) {

    $roleId = $_POST['roleId'];
    $roleId = filter_var($roleId, FILTER_UNSAFE_RAW);
    $userNIC = $_POST['userNIC'];
    $userNIC = filter_var($userNIC, FILTER_UNSAFE_RAW);
    $userName = $_POST['userName'];
    $userName = filter_var($userName, FILTER_UNSAFE_RAW);
    $userPassword = $_POST['userPassword'];
    $userPassword = filter_var($userPassword, FILTER_UNSAFE_RAW);
    $userFName = $_POST['userFName'];
    $userFName = filter_var($userFName, FILTER_UNSAFE_RAW);
    $userLName = $_POST['userLName'];
    $userLName = filter_var($userLName, FILTER_UNSAFE_RAW);
    $userEmail = $_POST['userEmail'];
    $userEmail = filter_var($userEmail, FILTER_UNSAFE_RAW);
    $userNumber = $_POST['userNumber'];
    $userNumber = filter_var($userNumber, FILTER_UNSAFE_RAW);
    $userAddress = $_POST['userAddress'];
    $userAddress = filter_var($userAddress, FILTER_UNSAFE_RAW);
    $hashedPassword = md5($userPassword);

    $select_users = $conn->prepare("SELECT * FROM user WHERE userNIC = ?");
    $select_users->execute([$userNIC]);
    $row = $select_users->fetch(PDO::FETCH_ASSOC);

    $select_email = $conn->prepare("SELECT * FROM user WHERE userEmail = ?");
    $select_email->execute([$userEmail]);
    $row2 = $select_email->fetch(PDO::FETCH_ASSOC);

    $select_username = $conn->prepare("SELECT * FROM user WHERE userName = ?");
    $select_username->execute([$userName]);
    $row3 = $select_username->fetch(PDO::FETCH_ASSOC);

    if ($select_users->rowCount() > 0 && $select_email->rowCount() > 0 && $select_username->rowCount() > 0) {
        if ($row['userNIC'] == ($userNIC) && $row2['userEmail'] == ($userEmail) && $row3['userName'] == ($userName)) {
            $regerror[] = 'NIC , Email , Username already exists!';
        }
    } elseif ($select_users->rowCount() > 0) {
        if ($row['userNIC'] == ($userNIC)) {
            $regerror[] = 'NIC already exists!';
        }
    } elseif ($select_email->rowCount() > 0) {
        if ($row2['userEmail'] == ($userEmail)) {
            $regerror[] = 'Email already exists!';
        }
    } elseif ($select_username->rowCount() > 0) {
        if ($row3['userName'] == ($userName)) {
            $regerror[] = 'Username already exists!';
        }
    } else {
        $insert_user = $conn->prepare("INSERT INTO user (userNIC, userName, userPassword, userFName, userLName, userEmail, userNumber, userAddress, roleId) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert_user->execute([$userNIC, $userName, $hashedPassword, $userFName, $userLName, $userEmail, $userNumber, $userAddress, $roleId]);
        $add[] = 'New Customer has been successfully Added.';
    }

    // $select_users = $conn->prepare("SELECT * FROM user WHERE userNIC = ?");
    // $select_users->execute([$userNIC]);
    // $insert_user = $conn->prepare("INSERT INTO user (userNIC, userName, userPassword, userFName, userLName, userEmail, userNumber, userAddress, roleType) VALUES(?,?,?,?,?,?,?,?,?)");
    // $insert_user->execute([$userNIC, $userName, $userPassword, $userFName, $userLName, $userEmail, $userNumber, $userAddress, $roleType]);
    // $add[] = 'New Customer has been successfully added.';
}

if (isset($_POST['update_user'])) {

    $roleId = $_POST['roleId'];
    $roleId = filter_var($roleId, FILTER_UNSAFE_RAW);
    $userNIC = $_POST['userNIC'];
    $userNIC = filter_var($userNIC, FILTER_UNSAFE_RAW);
    $userName = $_POST['userName'];
    $userName = filter_var($userName, FILTER_UNSAFE_RAW);
    $userPassword = $_POST['userPassword'];
    $userPassword = filter_var($userPassword, FILTER_UNSAFE_RAW);
    $userFName = $_POST['userFName'];
    $userFName = filter_var($userFName, FILTER_UNSAFE_RAW);
    $userLName = $_POST['userLName'];
    $userLName = filter_var($userLName, FILTER_UNSAFE_RAW);
    $userEmail = $_POST['userEmail'];
    $userEmail = filter_var($userEmail, FILTER_UNSAFE_RAW);
    $userNumber = $_POST['userNumber'];
    $userNumber = filter_var($userNumber, FILTER_UNSAFE_RAW);
    $userAddress = $_POST['userAddress'];
    $userAddress = filter_var($userAddress, FILTER_UNSAFE_RAW);
    $hashedPassword = md5($userPassword);

    $update_user = $conn->prepare("UPDATE user SET userName = ?, userPassword = ?, userFName = ?, userLName = ?, userEmail = ?, userNumber = ?, userAddress = ?, roleId = ? WHERE userNIC = ?");
    $update_user->execute([$userName, $hashedPassword, $userFName, $userLName, $userEmail, $userNumber, $userAddress, $roleId, $userNIC]);
    $update[] = 'Customer has been successfully updated.';
}

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM user WHERE userNIC = ?");
    $delete_user->execute([$delete_id]);
    // $delete_cart = $conn->prepare("DELETE FROM cart WHERE userNIC = ?");
    // $delete_cart->execute([$delete_id]);
    header('location:customer.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Customer</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' media='screen' href='css/user.css'>
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
        <div><h1>Customer</h1></div>

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
        <?php
if (isset($regerror)) {
    foreach ($regerror as $regerror) {
        echo '<span id="error" class="error-msg">' . $regerror . '</span>';
    }
    ;
}
;
?>
        </div>

        <div style="display: flex;"><button id="addbtn" onclick="openPopup()"> + Add Customer</button><?php include 'notify.php';?></div>
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
    <button id="useprintbtn"><i class="fa-solid fa-print"></i><span>Print</span></button>
    <button style="padding: 10px 46px 10px 46px;" id="exportbtn"><i class="fa-solid fa-file-export"></i><span>Export</span></button>
    </div>

    </div>

    </section>
    </div>

<!-- End Start Search Filter Export Functions -->

<!-- Start user List -->

    <div class="user-list">
    <section class="flex">

    <div class="user-list-container">
			<table id="productlist" class="user-list-table">
				<thead>
					<tr>
						<th>NIC<i class="fa-solid fa-sort"></i></th>
						<th>Username<i class="fa-solid fa-sort"></i></th>
						<th>FullName<i class="fa-solid fa-sort"></i></th>
						<th>Email<i class="fa-solid fa-sort"></i></th>
						<th>Number<i class="fa-solid fa-sort"></i></th>
                        <th>Address<i class="fa-solid fa-sort"></i></th>
                        <th>Role<i class="fa-solid fa-sort"></i></th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="pltable">
    <?php
$show_users = $conn->prepare("SELECT user.userNIC, user.userName, user.userFName, user.userLName, user.userEmail, user.userNumber, user.userAddress, user.userEmail, role.roleId, role.roleType from user INNER JOIN role ON user.roleId = role.roleId WHERE roleType IN ('Customer')");
// $show_users = $conn->prepare("SELECT * FROM user WHERE roleId IN ('RO-0004') ");
$show_users->execute();
if ($show_users->rowCount() > 0) {
    while ($fetch_users = $show_users->fetch(PDO::FETCH_ASSOC)) {
        ?>

					<tr>
                        <td><input type="hidden" name="userNIC" value="<?=$fetch_users['userNIC'];?>" ><?=$fetch_users['userNIC'];?></td>
                        <td><?=$fetch_users['userName'];?></td>
						<td><?=$fetch_users['userFName'];?>&nbsp;<?=$fetch_users['userLName'];?></td>
						<td><?=$fetch_users['userEmail'];?></td>
                        <td><?=$fetch_users['userNumber'];?></td>
                        <td><?=$fetch_users['userAddress'];?></td>
                        <td><?=$fetch_users['roleType'];?></td>
						<td>
                            <div class="action">
                                <a id="clickMe" href="customer.php?update=<?=$fetch_users['userNIC'];?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="customer.php?delete=<?=$fetch_users['userNIC'];?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?');" ><i class="fa-solid fa-trash"></i></a>
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

<!-- End user List -->

<!-- Start Pop-up user Add Box -  -->

    <div class="popup-container">
    <div class="popup-box-one" id="popupone">
    <button class="fa-solid fa-circle-xmark" onclick="closePopup()"></button>
    <h2>+ Add New Customer</h2>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="submitPopup()">
        <table class="pro-form">
            <tr>
    <?php
$show_role = $conn->prepare("SELECT * FROM role WHERE roleType IN ('Customer')");
// $show_role = $conn->prepare("SELECT * FROM category");
$show_role->execute();
if ($show_role->rowCount() > 0) {
    while ($fetch_role = $show_role->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <td><input type="Hidden" name="roleId" value="<?=$fetch_role['roleId'];?>" ></td>
    <?php
}
}
?>
            <tr>
                <td><input id="pId" type="text" name="userNIC" placeholder="User NIC" id="checkNIC" pattern="[\d{9}]+V$" required></td>
            </tr>
            <tr>
                <td><input type="text" name="userName" placeholder="Username" required></td>
            </tr>
            <tr>
                <td><input type="email" name="userEmail" placeholder="User Email" required></td>
            </tr>
            <tr>
                <td><input type="password" name="userPassword" placeholder="User Password" id="password" minlength="8" required></td>
            </tr>
            <tr>
                <td><input type="password" name="userConPassword" placeholder="Confirm Password" id="confirm_password" minlength="8" required></td>
            </tr>
            <tr>
                <td><input type="text" name="userFName" placeholder="User First Name" required></td>
            </tr>
            <tr>
                <td><input type="text" name="userLName" placeholder="User Last Name" required></td>
            </tr>
            <tr>
                <td><input type="tel" name="userNumber" placeholder="User Phone No" id="checkNumber" pattern="\d{10}" required></td>
            </tr>
            <tr>
                <td><input type="text" name="userAddress" placeholder="User Address" required></td>
            </tr>
            <tr>
                <td><input id="submit-pass" type="submit" name="add_user" value="Add" ></td>
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
    <p>The user has been successfully added.</p>
    <button onclick="okay();">Okay</button>
    </div> -->

<!-- End Pop-up user Add Box -  -->

<!-- Start Pop-up user Update Box -  -->

    <div class="popup-container">
    <div class="popup-box-three" id="popupthree">
    <button class="fa-solid fa-circle-xmark" onclick="closeUpdatePopup()"></button>
    <h2>Update Customer</h2>

    <?php
if (isset($_GET['update'])) {
    $update_id = $_GET['update'];
    $show_user = $conn->prepare("SELECT user.userNIC, user.userName, user.userFName, user.userLName, user.userEmail, user.userPassword, user.userNumber, user.userAddress, user.userEmail, role.roleId, role.roleType from user INNER JOIN role ON user.roleId = role.roleId WHERE userNIC = ?");
    $show_user->execute([$update_id]);
    if ($show_user->rowCount() > 0) {
        while ($fetch_user = $show_user->fetch(PDO::FETCH_ASSOC)) {
            ?>

    <form action="customer.php" method="post" enctype="multipart/form-data">
        <table class="pro-form">
            <tr>
    <?php
$show_role = $conn->prepare("SELECT * FROM role WHERE roleType IN ('Customer')");
            // $show_role = $conn->prepare("SELECT * FROM category");
            $show_role->execute();
            if ($show_role->rowCount() > 0) {
                while ($fetch_role = $show_role->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                <td><input type="hidden" name="roleId" value="<?=$fetch_role['roleId'];?>" ></td>
    <?php
}
            }
            ?>
            </tr>
            <tr>
                <td><input id="pId" type="text" name="userNIC" placeholder="User NIC" value="<?=$fetch_user['userNIC'];?>" id="checkNIC" pattern="[\d{9}]+V$" ></td>
            </tr>
            </tr>
            <tr>
                <td><input type="text" name="userName" placeholder="Username" value="<?=$fetch_user['userName'];?>" ></td>
            </tr>
            <tr>
                <td><input type="email" name="userEmail" placeholder="User Email" value="<?=$fetch_user['userEmail'];?>" ></td>
            </tr>
            <tr>
                <td><input type="password" name="userPassword" placeholder="User Password" value="<?=$fetch_user['userPassword'];?>" id="password" minlength="8" ></td>
            </tr>
            <tr>
                <td><input type="password" name="userConPassword" placeholder="Confirm Password" value="<?=$fetch_user['userPassword'];?>" id="confirm_password" minlength="8" ></td>
            </tr>
            <tr>
                <td><input type="text" name="userFName" placeholder="User First Name" value="<?=$fetch_user['userFName'];?>" ></td>
            </tr>
            <tr>
                <td><input type="text" name="userLName" placeholder="User Last Name" value="<?=$fetch_user['userLName'];?>" ></td>
            </tr>
            <tr>
                <td><input type="text" name="userNumber" placeholder="User Phone No" value="<?=$fetch_user['userNumber'];?>" id="checkNumber" pattern="\d{10}" ></td>
            </tr>
            <tr>
                <td><input type="text" name="userAddress" placeholder="User Address" value="<?=$fetch_user['userAddress'];?>" ></td>
            </tr>
            <tr>
            <tr>
                <td><input type="submit" name="update_user" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
}
    } else {
        echo '<p class="empty">no users added yet!</p>';
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
    <p>The user has been successfully updated.</p>
    <button onclick="okay();">Okay</button>
    </div>
    </div> -->

<!-- End Pop-up user Update Box -  -->

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/validation.js'></script>
    <script src='js/print.js'></script>
    <script src='js/export.js'></script>
    <script src='js/sort.js'></script>
    <script src='js/notify.js'></script>

</body>

</html>


