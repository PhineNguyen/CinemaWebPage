<!DOCTYPE html>
<html lang="vi">
    
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--CSS-->
  <link rel="stylesheet" href="CSS/header.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>

  <header class="header-container">
    <div class="logo-item">
      <a href="Home.php">
      <img class="logo active_page" src="pic/LOGO.png" alt="logo">
      </a>
    </div>
 
   <?php
    if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
      $username = htmlspecialchars($_SESSION['user']['user_name']);
      echo '
        <div class="admin-profile">
            <div class="admin-text">' . $username . '</div>
            <div class="admin-icon"><i class="fa-solid fa-user"></i></div>
            <div class="mucluc">
                <a href="infor_admin.php"><i class="fa-solid fa-circle-user"></i> Tài khoản</a>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
            </div>
        </div>';
    } else {
      echo '
        <div class="button-group" id="auth-buttons">
            <a href="login.php">Đăng nhập</a>
            <a href="register.php">Đăng ký</a>
        </div>';
    }
 
  ?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="js/header.js"></script>
  </header>

  <div class="separator-line"></div>