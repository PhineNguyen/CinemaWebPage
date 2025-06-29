<?php
  session_start();
  include('connect.php');
  include('header.php');

  if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
  }

  $user_id = $_SESSION['user']['id'];
  
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows !== 1) {
    echo "Không tìm thấy người dùng.";
    exit;
  }

  $user = $result->fetch_assoc();

  $name = htmlspecialchars($user['user_name']);
  $email = htmlspecialchars($user['email']);
  $phone = htmlspecialchars($user['phone_number']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Hồ sơ người dùng</title>
  <link rel="stylesheet" href="CSS/infor_admin.css">
</head>
<body> 
<div class="container">
  <h2 class="profile-heading">THÔNG TIN TÀI KHOẢN</h2>

  <form action="update_profile.php" method="POST" class="profile-form">
    <div class="profile-box">
      <div class="profile-left">
        <div class="avatar-wrapper">
          <img src="pic/avatar.png" alt="Avatar" class="avatar">
          <button type="button" class="change-avatar-btn" onclick="document.getElementById('avatar-upload').click()">Thay đổi</button>
          <input type="file" name="avatar" id="avatar-upload" hidden>
        </div>
        <p class="username">Xin chào <?= $name ?></p>
      </div>

      <div class="profile-right">
        <div class="form-group">
          <label>Tên *</label>
          <input type="text" name="name" value="<?= $name ?>" required>
        </div>

        <div class="form-group">
          <label>Điện thoại *</label>
          <input type="text" name="phone" value="<?= $phone ?>" required>
        </div>

        <div class="form-group">
          <label>Email *</label>
          <input type="email" name="email" value="<?= $email ?>" required>
        </div>

        <div class="save-password-container">
          <button type="submit" class="save-btn">LƯU LẠI</button>
          <a href="#" class="change-password-link" onclick="openModal()">Thay đổi mật khẩu?</a>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modal popup -->
<div id="passwordModal" class="modal">
  <div class="modal-content">
    <span class="modal-close" onclick="closeModal()">&times;</span>
    <?php
  if (isset($_SESSION['password_message'])) {
    echo "<p style='color:red; font-size: 14px;'>" . $_SESSION['password_message'] . "</p>";
    unset($_SESSION['password_message']);
  }
?>
    <form action="change_password.php" method="POST">
      <label>Mật khẩu cũ</label>
      <input type="password" name="current_password" required>
      <label>Mật khẩu mới</label>
      <input type="password" name="new_password" required>
      <button type="submit">Cập nhật mật khẩu</button>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('passwordModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('passwordModal').style.display = 'none';
  }

  window.onload = function() {
  const modal = document.getElementById('passwordModal');
  <?php if (isset($_SESSION['show_password_modal'])): ?>
    modal.style.display = "block";
    <?php unset($_SESSION['show_password_modal']); ?>
  <?php endif; ?>
};


  window.onclick = function(event) {
    const modal = document.getElementById('passwordModal');
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>

</body>
</html>
<?php include('footer.php'); ?>
