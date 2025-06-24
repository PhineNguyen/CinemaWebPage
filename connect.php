<?php

$servername = "127.0.0.1";  // hoặc 127.0.0.1
$username = "root";         // thường là root nếu dùng XAMPP
$password = "";             // mật khẩu trống nếu chưa đặt
$dbname = "cinemawebpage";   // thay bằng tên database bạn muốn kết nối

$link=@mysqli_connect($servername, $username, $password, $dbname) or die("Kết nối thất bại");
?>

