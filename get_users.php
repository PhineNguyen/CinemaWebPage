<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";  // đổi thành mật khẩu của bạn
$db   = "cinemawebpage"; // đổi thành tên database của bạn

$conn = new mysqli($host, $user, $pass, $db);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công đến database '$db'";
}

$conn->close();
?>
