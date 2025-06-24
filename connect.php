<?php
// // Thông tin cấu hình kết nối
// $servername = "127.0.0.1";
// $username = "root";  // Thay bằng tên người dùng MySQL của bạn
// $password = "";        // Thay bằng mật khẩu của bạn
// $database = "cinemawebpage"; // Thay bằng tên cơ sở dữ liệu của bạn

// // Tạo kết nối
// $conn = new mysqli($servername, $username, $password, $database);

// // Kiểm tra kết nối
// if ($conn->connect_error) {
//     die("Kết nối thất bại: " . $conn->connect_error);
// }
// Thông tin kết nối
$servername = "localhost";  // hoặc 127.0.0.1
$username = "root";         // thường là root nếu dùng XAMPP
$password = "";             // mật khẩu trống nếu chưa đặt
$dbname = "cinemawebpage";   // thay bằng tên database bạn muốn kết nối

$link=@mysqli_connect($servername, $username, $password, $dbname) or die("Kết nối thất bại");
?>
