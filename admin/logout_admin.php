
<?php
session_start();
session_unset(); // Xóa tất cả biến phiên
session_destroy(); // Hủy phiên
header("Location: admin_login.php");
exit();
