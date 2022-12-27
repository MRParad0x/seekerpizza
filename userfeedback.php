<?php

include 'conn.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['send'])) {

    $feedbackFName = $_POST['feedbackFName'];
    $feedbackFName = filter_var($feedbackFName, FILTER_UNSAFE_RAW);
    $feedbackEmail = $_POST['feedbackEmail'];
    $feedbackEmail = filter_var($feedbackEmail, FILTER_UNSAFE_RAW);
    $feedbackMessage = $_POST['feedbackMessage'];
    $feedbackMessage = filter_var($feedbackMessage, FILTER_UNSAFE_RAW);

    $insert_feedback = $conn->prepare("INSERT INTO feedback (feedbackFName, feedbackEmail, feedbackMessage) VALUES(?,?,?)");
    $insert_feedback->execute([$feedbackFName, $feedbackEmail, $feedbackMessage]);
    $message[] = 'Thank you for your excellent feedback! We appreciate the time you took to share your feedback.';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Feedback</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- custom css file link  -->

    <link rel='stylesheet' type='text/css' media='screen' href='css/userfeedback.css'>

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

    <div class="feedback-title">
          <h2>We'd love <i class="fa-solid fa-heart"></i> some feedback</h2>
          <p>We value your feedback and appreciate you taking the time to let us know about your experience with our foods. Please complete the form below to submit your feedback.</p>
    </div>

    <?php if (!isset($_POST['send'])) {
    ?>

    <div class="content">
      <div class="content-container">
      <form action="" method="POST">
        <table class="feedback-table">
        <tr>
          <td><input type="text" class="input-field" name ="feedbackFName" placeholder="Full Name" required></td>
        </tr>
        <tr>
          <td><input type="email" class="input-field" name ="feedbackEmail" placeholder="Email" required></td>
        </tr>
        <tr>
          <td><textarea name="feedbackMessage" rows="8"  placeholder="Your Feedback"></textarea></td>
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

<script>
   function imageClicked() {
    window.open("index.php", "_self");
   	}
</script>

</body>

</html>
