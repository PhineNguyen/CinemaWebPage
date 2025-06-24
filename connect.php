<?php
// Thông tin cấu hình kết nối
$servername = "127.0.0.1";
$username = "root";  // Thay bằng tên người dùng MySQL của bạn
$password = "";        // Thay bằng mật khẩu của bạn
$database = "cinemawebpage"; // Thay bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
