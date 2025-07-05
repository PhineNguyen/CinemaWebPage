<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_name = $_POST['name'] ?? '';
  $new_phone = $_POST['phone'] ?? '';
  $new_email = $_POST['email'] ?? '';

  // Kiểm tra dữ liệu 
  if (empty($new_name) || empty($new_phone) || empty($new_email)) {
    $_SESSION['update_message'] = "<span style='color:red;'>Vui lòng điền đầy đủ thông tin.</span>";
    header("Location: infor_admin.php");
    exit;
  }

  $sql = "UPDATE users SET user_name = ?, phone_number = ?, email = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $new_name, $new_phone, $new_email, $user_id);

  if ($stmt->execute()) {
    // Cập nhật lại session nếu tên người dùng thay đổi
    $_SESSION['user']['user_name'] = $new_name;
    header("Location: Home.php");
    exit;
  } else {
    $_SESSION['update_message'] = "<span style='color:red;'>Cập nhật thất bại. Vui lòng thử lại.</span>";
    header("Location: infor_admin.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Cập nhật tài khoản</title>
  <link rel="stylesheet" href="CSS/infor_admin.css">
</head>
<body>
<div class="container">
  <h2 class="profile-heading">THÔNG TIN TÀI KHOẢN</h2>
  <!-- Form cập nhật tài khoản ở đây -->
  <form action="update_profile.php" method="POST" class="profile-form">
    <div class="profile-box">
      <div class="profile-left">
        <div class="avatar-wrapper">
          <img src="pic/avatar.png" alt="Avatar" class="avatar">
        </div>
        <p class="username">Xin chào <?php echo htmlspecialchars($_SESSION['user']['user_name']); ?></p>
      </div>
      <div class="profile-right">
        <div class="form-group">
          <label>Tên *</label>
          <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['user_name']); ?>" required>
        </div>
        <div class="form-group">
          <label>Điện thoại *</label>
          <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone_number'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
          <label>Email *</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
        </div>
        <div class="save-password-container">
          <button type="submit" class="save-btn">LƯU LẠI</button>
        </div>
      </div>
    </div>
  </form>
