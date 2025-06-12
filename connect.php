<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "cinemawebpage";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");  // Đảm bảo tiếng Việt

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
