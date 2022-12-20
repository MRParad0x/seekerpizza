<?php 

include 'conn.php';

if(!empty($_POST["userName"])) {

    echo '<script>alert("done")</script>';
    $userName = $_POST['userName'];
    $userName = filter_var($userName, FILTER_UNSAFE_RAW);
    $select_users = $conn->prepare("SELECT * FROM user WHERE userName = ?");
    $select_users->execute([$userName]);
    $row = $select_users->fetch(PDO::FETCH_ASSOC);
    if($select_users->rowCount() > 0){
    echo "<span style='color:red'> Sorry User already exists .</span>";
    echo "<script>$('#submit-pass').prop('disabled',true);</script>";
    }else{
    echo "<span style='color:green'> User available for Registration .</span>";
    echo "<script>$('#submit-pass').prop('disabled',false);</script>";
    }
}

?>