<?php

include 'conn.php';

session_start();
if (isset($_SESSION['roleType'])) {
    $ssid = session_id();
} else {
    $ssid = session_id();
}

$host = "login.php";

if (isset($_POST['send'])) {

    $userNIC = $_POST['userNIC'];
    $userNIC = filter_var($userNIC, FILTER_UNSAFE_RAW);
    $userEmail = $_POST['userEmail'];
    $userEmail = filter_var($userEmail, FILTER_UNSAFE_RAW);
    $userName = $_POST['userName'];
    $userName = filter_var($userName, FILTER_UNSAFE_RAW);

    $select_user = $conn->prepare("SELECT userNIC, userName, userEmail from user WHERE userEmail = ? AND userName = ? AND userNIC = ? ");
    $select_user->execute([$userEmail, $userName, $userNIC]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        if ($row['userNIC'] == $userNIC && $row['userEmail'] == $userEmail && $row['userName'] == $userName) {
            header('location: new_password.php');
            $_SESSION['userNIC'] = $row['userNIC'];
        }
    } else {
        $regerror[] = 'incorrect NIC, Username or Email!';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Reset Password</title>
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
          <h2>Forgot Your Password?</h2>
          <p>Please enter your NIC, Email & Username to reset your password.</p>
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

    <div class="content">
      <div class="content-container">
      <form action="" method="POST">
        <table class="contact-table">
        <tr>
          <td><input type="text" class="input-field" name ="userNIC" placeholder="User NIC" required></td>
        </tr>
        <tr>
          <td><input type="email" class="input-field" name ="userEmail" placeholder="userEmail" required></td>
        </tr>
        <tr>
          <td><input type="text" class="input-field" name ="userName" placeholder="userName" required></td>
        </tr>
        <tr>
          <td><input type="submit" name="send" Value="Send"></td>
        </tr>
        </table>
      </form>
      </div>
    </div>

  </div>
</div>

    <?php include 'footer.php'?>

    <!-- custom js file link  -->

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
