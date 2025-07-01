<?php
  $role = isset($_SESSION['ro_lo']) ? $_SESSION['ro_lo'] : '';
  $username = '';
  if (isset($_SESSION['user'])) {
      // Kết nối CSDL
      include_once('../connect.php');
      $user_id = $_SESSION['user'];
      $sql = "SELECT user_name FROM users WHERE id = '$user_id' LIMIT 1";
      $result = mysqli_query($conn, $sql);
      if ($row = mysqli_fetch_assoc($result)) {
          $username = htmlspecialchars($row['user_name']);
      }
  }
?>
<header class="header-container">
  <div class="logo-item">
    <?php
      $logo_link = ($role === 'employee') ? 'quanlyphim.php' : 'admin.php';
      echo '
        <a href="' . $logo_link . '">
          <img class="logo active_page" src="../pic/LOGO.png" alt="logo">
        </a>
      ';
    ?>
  </div>
<?php if($username): ?>
  <div class="admin-profile">
    <div class="admin-text"><?= $username ?></div>
    <div class="admin-icon"><i class="fa-solid fa-user"></i></div>
    <div class="mucluc">
      <a href="infor_admin.php"><i class="fa-solid fa-circle-user"></i> Tài khoản</a>
      <a href="logout_admin.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>
  </div>
<?php endif; ?>
</header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Nút toggle nằm ngoài sidebar -->