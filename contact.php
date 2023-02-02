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

    $contactFName = $_POST['contactFName'];
    $contactFName = filter_var($contactFName, FILTER_UNSAFE_RAW);
    $contactSubject = $_POST['contactSubject'];
    $contactSubject = filter_var($contactSubject, FILTER_UNSAFE_RAW);
    $contactEmail = $_POST['contactEmail'];
    $contactEmail = filter_var($contactEmail, FILTER_UNSAFE_RAW);
    $contactMessage = $_POST['contactMessage'];
    $contactMessage = filter_var($contactMessage, FILTER_UNSAFE_RAW);

    $insert_contact = $conn->prepare("INSERT INTO contact (contactFName, contactSubject, contactEmail, contactMessage) VALUES(?,?,?,?)");
    $insert_contact->execute([$contactFName, $contactSubject, $contactEmail, $contactMessage]);
    $message[] = 'Thanks for getting in touch with us! <br/> We\'ll get back to you as soon as we can.';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Contact</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/contact.css'>

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

<body onload="load()">

<!-- Start header -->

<?php include 'header.php'?>

<!-- End header -->

<div class="form">
    <div class="form-container">

<div class="contact-title">
          <h2>How Can we help?</h2>
          <p>Have any questions? We'd love to hear from you.</p>
    </div>

    <?php if (!isset($_POST['send'])) {
    ?>

    <div class="content">
      <div class="content-container">
      <form action="" method="POST">
        <table class="contact-table">
        <tr>
          <td><input type="text" class="input-field" name ="contactFName" placeholder="Full Name" required></td>
        </tr>
        <tr>
          <td><input type="text" class="input-field" name ="contactSubject" placeholder="Subject" required></td>
        </tr>
        <tr>
          <td><input type="email" class="input-field" name ="contactEmail" placeholder="Email" required></td>
        </tr>
        <tr>
          <td><textarea name="contactMessage" rows="8"  placeholder="Your Message" required></textarea></td>
        </tr>
        <tr>
          <td><input type="submit" name="send" Value="Send"></td>
        </tr>
        </table>
      </form>
      </div>
    </div>

<?php } else {?>

</section>
</div>

<div>
    <?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<span id="success" class="success-msg">' . $message . '</span>';
    }
    ;
}
    ;
    echo "<button class=\"feedback-go-back-button\" onclick=\"location.href='/index.php';\"><i class=\"fa-solid fa-circle-chevron-left\"></i>&nbsp;&nbsp;Go Home</button>";
}
?>
    </div>

    </div>
    </div>

    <?php include 'footer.php'?>

    <!-- custom js file link  -->
    <script src='js/index.js'></script>

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
