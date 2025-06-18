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
  <style>
    body {
  margin: 0;
  padding: 0;
  background-color: #121212; /* nền đen */
  font-family: 'Segoe UI', sans-serif;
  color: #f0f0f0; /* chữ sáng */
}

.container {
  max-width: 800px;
  margin: 50px auto;
  padding: 30px;
  background-color: #1e1e1e; /* nền trong container */
  border-radius: 12px;
  box-shadow: 0 0 20px rgba(255, 193, 7, 0.2);
}

.profile-header {
  display: flex;
  align-items: center;
  border-bottom: 2px solid #ffc107;
  padding-bottom: 20px;
  margin-bottom: 30px;
}

.profile-header img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #ffc107;
  margin-right: 20px;
}

.profile-header .name {
  font-size: 24px;
  font-weight: bold;
  color: #ffc107;
}

.info-group {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.info-box {
  flex: 1 1 45%;
  background: #2c2c2c;
  padding: 15px 20px;
  border-left: 5px solid #ffc107;
  border-radius: 8px;
}

.info-box label {
  display: block;
  font-weight: bold;
  color: #ffc107;
  margin-bottom: 5px;
}

.info-box span {
  color: #f0f0f0;
}

.action-btn {
  display: block;
  margin-top: 30px;
  text-align: right;
}

.action-btn button {
  background-color: #ffc107;
  color: #000;
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
}

.action-btn button:hover {
  background-color: #e0ac00;
}

  </style>
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
