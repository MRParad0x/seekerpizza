<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=spizza", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!-- // $dbservername = "localhost";
// $dbusername = "root";
// $dbpassword = "";
// $dbname = "spizza";

// $connn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname) -->
