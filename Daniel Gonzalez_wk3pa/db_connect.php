<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "sdc310_wk3pa";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
