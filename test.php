<?php
// Thông tin kết nối
$servername = "localhost";  // hoặc 127.0.0.1
$username = "root";         // thường là root nếu dùng XAMPP
$password = "Sh3rl0ck*";             // mật khẩu trống nếu chưa đặt
$dbname = "cinemawebpage";   // thay bằng tên database bạn muốn kết nối

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
echo "Kết nối thành công!";
?>

