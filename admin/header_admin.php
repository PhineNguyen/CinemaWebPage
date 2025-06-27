<header class="header-container">
  <div class="logo-item">
    <a href="admin.php">
      <img class="logo active_page" src="../pic/LOGO.png" alt="logo">
    </a>
  </div>

  <?php
    if (isset($_SESSION['user'])) {
      $username = htmlspecialchars($_SESSION['user']['user_name']);
      echo '
        <div class="admin-profile">
            <div class="admin-text">' . $username . '</div>
            <div class="admin-icon"><i class="fa-solid fa-user"></i></div>
            <div class="mucluc">
                <a href="infor_admin.php"><i class="fa-solid fa-circle-user"></i> Tài khoản</a>
                <a href="#"><i class="fa-solid fa-gear"></i> Cài đặt</a>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
            </div>
        </div>';
    } else {
      echo '
        <div class="auth-buttons" style="display: none;"></div>
        <div class="admin-profile" style="display: block;">
            <i class="fa fa-user-shield"></i>
            <div class="logout-btn"></div>
        </div>';
    }
  ?>
</header>

