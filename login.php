<?php

include 'conn.php';

session_start();
if (isset($_SESSION['roleType'])) {
    $ssid = session_id();
    header("Location:product.php");
} else {
    $ssid = session_id();
}

$host = "login.php";
// if (!isset($_SESSION['userNIC'])) {
//     header('location:product.php');
// }
if (isset($_POST['logsubmit'])) {
    $userEmail = $_POST['userEmail'];
    $userEmail = filter_var($userEmail, FILTER_UNSAFE_RAW);
    $userPassword = $_POST['userPassword'];
    $userPassword = filter_var($userPassword, FILTER_UNSAFE_RAW);

    $select_user = $conn->prepare("SELECT user.userNIC, user.userName, user.userFName, user.userLName, user.userEmail, user.userNumber, user.userAddress, user.userEmail, role.roleId, role.roleType from user INNER JOIN role ON user.roleId = role.roleId WHERE (userEmail = ? OR userName = ?) AND userPassword = ? ");
    // $select_user = $conn->prepare("SELECT * FROM user WHERE (userEmail = ? OR userName = ?) AND userPassword = ? ");
    $select_user->execute([$userEmail, $userEmail, $userPassword]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        if ($row['roleType'] == ('Admin')) {
            $_SESSION['roleType'] = $row['roleType'];
            $_SESSION['userNIC'] = $row['userNIC'];
            $_SESSION['userFName'] = $row['userFName'];
            $_SESSION['userLName'] = $row['userLName'];
            if (isset($_SESSION['redirectcheckout'])) {
                header('location: ' . $_SESSION['redirectcheckout']);
                die();
            } else {
                header('location: product.php');
            }
        } elseif ($row['roleType'] == ('Manager')) {
            $_SESSION['roleType'] = $row['roleType'];
            $_SESSION['userNIC'] = $row['userNIC'];
            $_SESSION['userFName'] = $row['userFName'];
            $_SESSION['userLName'] = $row['userLName'];
            if (isset($_SESSION['redirectcheckout'])) {
                header('location: ' . $_SESSION['redirectcheckout']);
            } else {
                header('location: product.php');
            }
        } elseif ($row['roleType'] == ('Cashier')) {
            $_SESSION['roleType'] = $row['roleType'];
            $_SESSION['userNIC'] = $row['userNIC'];
            $_SESSION['userFName'] = $row['userFName'];
            $_SESSION['userLName'] = $row['userLName'];
            if (isset($_SESSION['redirectcheckout'])) {
                header('location: ' . $_SESSION['redirectcheckout']);
            } else {
                header('location: product.php');
            }
        } elseif ($row['roleType'] == ('Customer')) {
            $_SESSION['roleType'] = $row['roleType'];
            $_SESSION['userNIC'] = $row['userNIC'];
            $_SESSION['userFName'] = $row['userFName'];
            $_SESSION['userLName'] = $row['userLName'];
            if (isset($_SESSION['redirectcheckout'])) {
                header('location: ' . $_SESSION['redirectcheckout']);
            } else {
                header('location: product.php');
            }
        }
    } else {
        $error[] = 'incorrect email or password!';
    }
}

if (isset($_POST['regsubmit'])) {

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

    $select_users = $conn->prepare("SELECT * FROM user WHERE userNIC = ?");
    $select_users->execute([$userNIC]);
    $row = $select_users->fetch(PDO::FETCH_ASSOC);

    if ($select_users->rowCount() > 0) {
        if ($row['userNIC'] == ($userNIC) && $row['userEmail'] == ($userEmail) && $row['userName'] == ($userName)) {
            $regerror[] = 'NIC already exists!';
            $regerror[] = 'Email already exists!';
            $regerror[] = 'Username already exists!';
        }
    } elseif ($select_users->rowCount() > 0) {
        if ($row['userNIC'] == ($userNIC)) {
            $regerror[] = 'NIC already exists!';
        }
    } elseif ($select_email->rowCount() > 0) {
        if ($row['userEmail'] == ($userEmail)) {
            $regerror[] = 'Email already exists!';
        }
    } elseif ($select_username->rowCount() > 0) {
        if ($row['userName'] == ($userName)) {
            $regerror[] = 'Username already exists!';
        }
    } else {
        $insert_user = $conn->prepare("INSERT INTO user (userNIC, userName, userPassword, userFName, userLName, userEmail, userNumber, userAddress, roleId) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert_user->execute([$userNIC, $userName, $userPassword, $userFName, $userLName, $userEmail, $userNumber, $userAddress, $roleId]);
        $regcreate[] = 'Great! <br> Your account has been successfully created.';
    }

    // $select_users = $conn->prepare("SELECT * FROM user WHERE userNIC = ?");
    // $select_users->execute([$userNIC]);
    // $row = $select_users->fetch(PDO::FETCH_ASSOC);

    // $select_email = $conn->prepare("SELECT * FROM user WHERE userEmail = ?");
    // $select_email->execute([$userEmail]);
    // $row2 = $select_email->fetch(PDO::FETCH_ASSOC);

    // $select_username = $conn->prepare("SELECT * FROM user WHERE userName = ?");
    // $select_username->execute([$userName]);
    // $row3 = $select_username->fetch(PDO::FETCH_ASSOC);

    // if ($select_users->rowCount() > 0 && $select_email->rowCount() > 0 && $select_username->rowCount() > 0) {
    //     if ($row['userNIC'] == ($userNIC) && $row2['userEmail'] == ($userEmail) && $row3['userName'] == ($userName)) {
    //         $regerror[] = 'NIC already exists!';
    //         $regerror[] = 'Email already exists!';
    //         $regerror[] = 'Username already exists!';
    //     }
    // } elseif ($select_users->rowCount() > 0) {
    //     if ($row['userNIC'] == ($userNIC)) {
    //         $regerror[] = 'NIC already exists!';
    //     }
    // } elseif ($select_email->rowCount() > 0) {
    //     if ($row2['userEmail'] == ($userEmail)) {
    //         $regerror[] = 'Email already exists!';
    //     }
    // } elseif ($select_username->rowCount() > 0) {
    //     if ($row3['userName'] == ($userName)) {
    //         $regerror[] = 'Username already exists!';
    //     }
    // } else {
    //     $insert_user = $conn->prepare("INSERT INTO user (userNIC, userName, userPassword, userFName, userLName, userEmail, userNumber, userAddress, roleId) VALUES(?,?,?,?,?,?,?,?,?)");
    //     $insert_user->execute([$userNIC, $userName, $userPassword, $userFName, $userLName, $userEmail, $userNumber, $userAddress, $roleId]);
    //     $regcreate[] = 'Great! <br> Your account has been successfully created.';
    // }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/login.css'>

    <!-- favicon file link  -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

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

<!-- Start header -->

<?php include 'header.php'?>

<!-- End header -->

    <main>
    <div class=login-form>
    <section class="flex">
    <div class="form">
        <h1>My Account</h1>
                    <?php
if (isset($regerror)) {
    foreach ($regerror as $regerror) {
        echo '<span id="error" class="error-msg">' . $regerror . '</span>';
    }
    ;
}
;
?>
                    <?php
if (isset($regcreate)) {
    foreach ($regcreate as $regcreate) {
        echo '<span id="success" class="success-msg">' . $regcreate . '</span>';
    }
    ;
}
;
?>
        	<div id="formid" class="form-container">
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn" onclick="login()">Login</button>
				<button type="button" class="toggle-btn" onclick="register()">Register</button>
			</div>

		    	<form id="login" class="input-group" action="" method="POST">
                    <table>
                    <?php
if (isset($error)) {
    foreach ($error as $error) {
        echo '<span class="error-msg">' . $error . '</span>';
    }
    ;
}
;
?>
                    <tr>
                        <td><input type="text" v-bind:class="{'error-boarder' : $v.age.$invalid}" name="userEmail" class="input-field" placeholder="Email" required></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="userPassword" class="input-field" placeholder="Password" required></td>
                    </tr>
                    <tr>
                        <td class="forgot">Forgot password?</td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="logsubmit" class="submit-btn">Login</button></td>
                    </tr>
                    </table>
		    	</form>

		    	<form id="register" class="input-group" action="" method="POST" >
                    <table>
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
                    </tr>
                    <tr>
                        <td><input type="text" class="input-field" name ="userNIC" placeholder="NIC" id="checkNIC" pattern="[\d{9}]+V$" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="input-field" name ="userName" placeholder="Username" required></td>
                    </tr>
                    <tr>
                        <td><input type="email" class="input-field" name ="userEmail" placeholder="Email" required></td>
                    </tr>
                    <tr>
                        <td><input type="password"  class="input-field" name ="userPassword" placeholder="Password" id="password" minlength="8" required></td>
                    </tr>
                    <tr>
                        <td><input type="password" class="input-field" name ="confirmPass" placeholder="Confirm Password" id="confirm_password" minlength="8" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="input-field" name ="userFName" placeholder="First Name" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="input-field" name ="userLName" placeholder="Last Name" required></td>
                    </tr>
                    <tr>
                        <td><input type="tel" class="input-field" name ="userNumber" placeholder="Phone Number" id="checkNumber" pattern="\d{10}" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="input-field" name ="userAddress" placeholder="Address" required></td>
                    </tr>
                    <tr>
                        <td><button id="submit-pass" type="submit" name="regsubmit" class="submit-btn">Register</button></td>
                    </tr>
                    </table>
		    	</form>
		    </div>
    </div>
    </section>
    </div>
    </main>

    <div class="popup-box-two" id="popuptwo">
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
    </svg>
    <h2>Congratulations!</h2>
    <p>Your account has been sucessfully created.</p>
    <button onclick="okay();">Okay</button>
    </div>

    <footer class="footer">
        <section class="flex">
            <div class="footer-container">
                <div class="footer-box-block">

                    <a href="#home"><img class="logo" src="img/logovertical.png" alt=""></a>
                        <p>Follow us on social</p>

                        <div class="icons-scoial">
                            <a href="facebook.com" class="fa-brands fa-facebook-f"></a>
                            <a href="instagram.com" class="fa-brands fa-instagram"></a>
                            <a href="twitter.com" class="fa-brands fa-twitter"></a>
                            <a href="youtube.com" class="fa-brands fa-youtube"></a>
                            <a href="tiktok.com" class="fa-brands fa-tiktok"></a>
                        </div>

                        <div class="icons-details">
                            <a class="fa-solid fa-phone"></a><label>+94 112768453</label>
                            <a class="fa-solid fa-envelope"></a><label>support@seekerspizza.com</label>
                            <a class="fa-solid fa-location-dot"></a><label>10C, Pittugala Road, Kaduwela</label>
                            <a class="fa-solid fa-calendar-days"></a><label>Monday -  Sunday</label>
                            <a class="fa-solid fa-clock"></a><label>11:00 AM -  11:00 PM</label>
                        </div>

                    <div class="navbar">
                        <a href="#home">Home</a>
                        <a href="#menu">Menu</a>
                        <a href="#about">About</a>
                        <a href="#contact">Contact</a>
                        <a href="/login.php">Register</a>
                        <a href="/login.php">Login</a>
                        <a href="#tou">Term of USe</a>
                        <a href="#tou">Privacy policy</a>
                    </div>
                    <p class="footer-copy">Copyright © 2022 Seekers Pizza All Rights Reserved.</p>
                    <p>Made with <i class="fa-solid fa-heart"></i> By Seeker Group.</p>
                </div>
            </div>
        </section>
    </footer>

    <!-- custom js file link  -->
    <script src='js/index.js'></script>
    <script src='js/validation.js'></script>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register() {
        x.style.left = "-400px";
        y.style.left = "120px";
        z.style.left = "110px";
        document.getElementById('formid').style.height = "740px"
        }
        function login() {
        x.style.left = "120px";
        y.style.left = "550px";
        z.style.left = "0px";
        document.getElementById('formid').style.height = "380px"
        }
    </script>

    <script>
    /* Start logo image click functions */

    function imageClicked() {
    window.open("index.php", "_self");
    }

    /* End logo image click functions */

    </script>


</body>

</html>
