<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>
<!--CSS-->
  <link rel="stylesheet" href="CSS/Home.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>
  <header class="header-container">
    <div class="logo-item">
      <img class="logo" src="pic/LOGO.png" alt="logo">
    </div>

    <?php
    if (isset($_SESSION['user'])) {
      echo '
          <div class="admin-profile">
              <div class="admin-text">' . $_SESSION['user'] . '</div>
              <div class="admin-icon"><i class="fa-solid fa-user"></i></div>
              <div class="mucluc">
                  <a href="infor_admin.php"><i class="fa-solid fa-circle-user"></i> Tài khoản</a>
                  <a href="#"><i class="fa-solid fa-gear"></i> Cài đặt</a>
                  <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
              </div>
          </div>';
    } else {
      echo '
          <div class="button-group">
              <a href="login.php">Đăng nhập</a>
              <a href="register.php">Đăng ký</a>
          </div>';
    }
    ?>
  </header>

