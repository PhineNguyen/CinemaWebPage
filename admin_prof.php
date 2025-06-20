<?php
include("connect.php");
?>
<?php
session_start(); // Bắt đầu session

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng về trang đăng nhập
if (!isset($_SESSION["user_name"])) {
    header("Location: login_admin.php");
    exit();
}

$_SESSION["last_login"] = date("d/m/Y - H:i");

// Gán biến từ session (bạn phải chắc rằng các session này đã được gán sau khi đăng nhập)
$user_name = $_SESSION["user_name"];
$email = $_SESSION["email"];
$phone_number = $_SESSION["phone_number"];
$ro_lo = $_SESSION['ro_lo']; 
$last_login = $_SESSION["last_login"];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thông tin tài khoản Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CSS/admin_prof.css">
</head>
<body>

<div class="container">
  <div class="profile-header">
    <img src="pic/avatar_default.png" alt="Avatar Admin">
    <div class="name"><?= htmlspecialchars($user_name) ?></div>
  </div>

  <div class="info-group">
    <div class="info-box">
      <label><i class="fa-solid fa-user"></i> Tên đăng nhập:</label>
      <span><?= htmlspecialchars($user_name) ?></span>
    </div>
    <div class="info-box">
      <label><i class="fa-solid fa-envelope"></i> Email:</label>
      <span><?= htmlspecialchars($email) ?></span>
    </div>
    <div class="info-box">
      <label><i class="fa-solid fa-phone"></i> Số điện thoại:</label>
      <span><?= htmlspecialchars($phone_number) ?></span>
    </div>
    <div class="info-box">
      <label><i class="fa-solid fa-user-shield"></i> Vai trò:</label>
      <span><?= htmlspecialchars($ro_lo) ?></span>
    </div>
    <div class="info-box">
      <label><i class="fa-solid fa-toggle-on"></i> Trạng thái:</label>
      <span>Hoạt động</span>
    </div>
    <div class="info-box">
      <label><i class="fa-solid fa-clock-rotate-left"></i> Đăng nhập gần nhất:</label>
      <span><?= htmlspecialchars($last_login) ?></span>
    </div>
  </div>

  <div class="action-btn">
    <button><i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa thông tin</button>
  </div>
</div>

</body>
</html>
