<?php

include 'conn.php';

session_start();
if (isset($_SESSION['roleType'])) {
    $ssid = session_id();
    echo $_SESSION['userNIC'];
} else {
    $ssid = session_id();
    echo $_SESSION['userNIC'];
}

$host = "login.php";

if (isset($_POST['send'])) {

    $userNIC = $_SESSION['userNIC'];
    $userPassword = $_POST['userPassword'];
    $userPassword = filter_var($userPassword, FILTER_UNSAFE_RAW);
    $hashedPassword = md5($userPassword);

    $update_product = $conn->prepare("UPDATE user SET userPassword = ? WHERE userNIC = ?");
    $update_product->execute([$hashedPassword, $userNIC]);
    $changepass[] = 'Great! <br> Your password has been successfully changed.';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Change Password</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/reset_password.css'>

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

<div class="form">
    <div class="form-container">

    <div class="contact-title">
          <h2>Change Your Password</h2>
    </div>

    <?php
if (isset($regerror)) {
    foreach ($regerror as $regerror) {
        echo '<span id="error" class="error-msg">' . $regerror . '</span>';
    }
    ;
}
;
?>
    <?php if (!isset($_POST['send'])) {?>
    <div class="content">
    <div class="content-container">
      <form action="" method="POST">
        <table class="contact-table">
        <tr>
            <td><input type="password"  class="input-field" name ="userPassword" placeholder="Password" id="password" minlength="8" required></td>
        </tr>
        <tr>
            <td><input type="password" class="input-field" name ="confirmPass" placeholder="Confirm Password" id="confirm_password" minlength="8" required></td>
        </tr>
        <tr>
          <td><input type="submit" name="send" Value="Submit"></td>
        </tr>
        </table>
      </form>
      </div>
    </div>
    <?php } else {

    if (isset($changepass)) {
        foreach ($changepass as $changepass) {
            echo '<span id="success" class="success-msg">' . $changepass . '</span>';
        }
        echo "<button class=\"log-again-button\" onclick=\"location.href='/login.php';\"><i class=\"fa-solid fa-circle-chevron-right\"></i>&nbsp;&nbsp;Login</button>";
    }

}?>

  </div>
</div>

    <?php include 'footer.php'?>

    <!-- custom js file link  -->
    <script src='js/validation.js'></script>
    <script>
    /* Start logo image click functions */

    let url = "contact.php";

    function imageClicked() {
    window.open("index.php", "_self");
    }

    /* End logo image click functions */

    </script>


</body>

</html>
