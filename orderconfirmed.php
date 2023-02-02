<?php

include 'conn.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Order Confirmation</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/orderconfirmed.css'>

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

<div class="body-layout">
<section class="flex">

    <!-- header -->

    <header class="header">

        <div class="site-logo">
        <img onclick="imageClicked()" src="img/logovertical.png" alt="">
        </div>

    </header>

    <div class="content">
        <div class="content-container">
            <div class="content-box">
                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_rXwz8k6MJO.json"  background="rgba(255, 255, 255, 0)"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                <h1>Your Order Has Been Received !<br/>Working on it now...</h1>
                <p>Thank you for your purchase !</p>
                <p>Your Order No : <?php echo $_SESSION['uuid']; ?></php></p>
                <p>Your will receive an order confirmation email with details of your order.</p>
                <button onclick="location.href='/dashboard.php';">Go to My Account</button>
                <button onclick="location.href='/index.php';">Continue Shopping</button>
            </div>
        </div>
    </div>

</section>
</div>

    <!-- custom js file link  -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
   function imageClicked() {
    window.open("index.php", "_self");
   	}
</script>

</body>

</html>
