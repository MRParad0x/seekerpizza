<?php
include 'conn.php';

session_start();

if (!isset($_SESSION['roleType'])) {
    header('location:login.php');
}

if (isset($_POST['update_user'])) {

    $userNIC = $_SESSION['userNIC'];
    $userNIC = filter_var($userNIC, FILTER_UNSAFE_RAW);
    $userName = $_POST['userName'];
    $userName = filter_var($userName, FILTER_UNSAFE_RAW);
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
    $userCity = $_POST['userCity'];
    $userCity = filter_var($userCity, FILTER_UNSAFE_RAW);
    $userPostalCode = $_POST['userPostalCode'];
    $userPostalCode = filter_var($userPostalCode, FILTER_UNSAFE_RAW);

    $update_user = $conn->prepare("UPDATE user SET userName = ?, userFName = ?, userLName = ?, userEmail = ?, userNumber = ?, userAddress = ?, userCity = ?, userPostalCode = ? WHERE userNIC = ?");
    $update_user->execute([$userName, $userFName, $userLName, $userEmail, $userNumber, $userAddress, $userCity, $userPostalCode, $userNIC]);
    $update[] = 'Profile details has been successfully updated.';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Edit Profile</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/profilesetting.css'>
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
        <div><h1>Edit Profile</h1></div>

        <div>
    <?php
if (isset($update)) {
    foreach ($update as $update) {
        echo '<span id="success" class="success-msg">' . $update . '</span>';
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
</dv>

<!-- End Header -->

<div class="main">

    <div class="main-container">

    <div class="flexbox-one">

        <div>
            <img src="img/profile.png" alt="">
        </div>

        <?php
$show_user_address = $conn->prepare("SELECT * FROM user WHERE userNIC = ? ");
$show_user_address->execute([$_SESSION['userNIC']]);

if ($show_user_address->rowCount() > 0) {
    while ($fetch_address = $show_user_address->fetch(PDO::FETCH_ASSOC)) {

        ?>

        <div>
        <form action="" method="post">
        <table class="table-two">
                    <tr>
                        <td colspan="2">
                            <input type="text" name="userNIC" placeholder="NIC" value="<?=$fetch_address['userNIC'];?>" required disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="userName" placeholder="Username" value="<?=$fetch_address['userName'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="userEmail" placeholder="Email" value="<?=$fetch_address['userEmail'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="userFName" placeholder="First Name" value="<?=$fetch_address['userFName'];?>" required>
                        </td>
                        <td>
                            <input type="text" name="userLName" placeholder="Last Name" value="<?=$fetch_address['userLName'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="userAddress" placeholder="Address" value="<?=$fetch_address['userAddress'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="userCity" placeholder="City" value="<?=$fetch_address['userCity'];?>" required>
                        </td>
                        <td>
                            <input type="text" name="userPostalCode" placeholder="Postal Code" value="<?=$fetch_address['userPostalCode'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" name="userNumber" placeholder="User Phone No" value="<?=$fetch_address['userNumber'];?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="update_user" value="Update">
                        </td>
                    </tr>
                </table>
        </form>
        </div>

        <?php
}
}
?>

    </div>

    </div>

</div>

    <!-- custom js file link  -->
    <script src='js/main.js'></script>
    <script src='js/status.js'></script>
    <script src='js/print.js'></script>
    <script src='js/sort.js'></script>
    <script src='js/notify.js'></script>
</body>

</html>


