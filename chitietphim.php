<?php
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chi tiết phim</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CSS/chitietphim.css">
  <link rel="stylesheet" href="CSS/Home.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>
<body>
<!-- header -->
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
<!-- đường dẫn các trang -->
<div class="breadcrumb">
  <a href="#"></a>
</div>
<!-- chi tiết phim -->
<div class="container">
    <?php
        $sql = "SELECT title, image_url, release_date, genre, director, actor, age_rating, duration, lgs, descript, trailer_url FROM movies LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($phim = mysqli_fetch_assoc($result)) {
    ?>
    <div class="section-title">Nội dung phim</div>
    <div class="movie-info">
        <img src="<?php echo $phim['image_url']; ?>" alt="Poster <?php echo $phim['title']; ?>">
        <div class="movie-detail">
            <h3 style="color: #ffc107;"><?php echo strtoupper($phim['title']); ?></h3>
            <p><strong>Đạo diễn:</strong> <?php echo $phim['director']; ?></p>
            <p><strong>Diễn viên:</strong> <?php echo $phim['actor']; ?></p>
            <p><strong>Thể loại:</strong> <?php echo $phim['genre']; ?></p>
            <p><strong>Khởi chiếu:</strong> <?php echo $phim['release_date']; ?></p>
            <p><strong>Thời lượng:</strong> <?php echo $phim['duration']; ?> phút</p>
            <p><strong>Ngôn ngữ:</strong> <?php echo $phim['lgs']; ?></p>
            <p><strong>Rated:</strong> <?php echo $phim['age_rating']; ?></p>
            <button class="btn-buy">🎟 Mua vé</button>
        </div>
    </div>
  <div class="movie-detail">Giới Thiệu</div>
  <div class="movie-detail">
      <p><?php echo $phim['descript'];?></p>
  </div>
  <!-- Trailer Section - placed outside movie-info but still inside container -->
    <?php if (!empty($phim['trailer_url'])): ?>
      <label>Trailer</label>
    <div class="movie-trailer" style="margin-top: 20px; text-align: center;">
        <iframe 
            width="560" 
            height="315" 
            src="<?php echo $phim['trailer_url']; ?>" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen
            style="border: solid 1px white; width: 100%; max-width: 720px; border-radius: 10px; display: inline-block;">
        </iframe>
    </div>
    <?php endif; ?>

    <?php
            }
        } else {
            echo "<p>Không có dữ liệu phim để hiển thị.</p>";
        }
    ?>
</div>

<!-- footer -->
<footer>
    <div class="f1">
      <h3>CINETIX Việt Nam</h3>
      <ul>
        <li>Giới thiệu</li>
        <li>Tiện ích Online</li>
        <li>Thẻ quà tặng</li>
        <li>Tuyển dụng</li>
        <li>Liên hệ quảng cáo</li>
        <li>Dành cho đối tác</li>
      </ul>
    </div>

    <div class="f2">
      <h3>Điều khoản sử dụng</h3>
      <ul>
        <li>Điều khoản chung</li>
        <li>Điều khoản giao dịch</li>
        <li>Chính sách thanh toán</li>
        <li>Chính sách bảo mật</li>
        <li>Câu hỏi thường gặp</li>
      </ul>
    </div>

    <div class="f3">
      <h3>Kết nối với chúng tôi</h3>
      <ul>
        <li><img src="https://cdn.simpleicons.org/facebook" alt="Facebook" />Facebook</li>
        <li><img src="https://cdn.simpleicons.org/youtube" alt="YouTube" />Youtube</li>
        <li><img src="https://cdn.simpleicons.org/instagram" alt="Instagram" />Instagram</li>
      </ul>
    </div>

    <div class="f4">
      <h3>Chăm sóc khách hàng</h3>
      <ul>
        <li>Hotline: 1900 1357</li>
        <li>Giờ làm việc: 8:00 - 22:00(Tất cả các ngày bao gồm bao gồm cả lễ Tết)</li>
        <li>Email hỗ trợ: hoidap@cinetix.vn</li>
      </ul>
    </div>

    <div class="f5">
      <p class="company-name">CÔNG TY TNHH CINETIX VIỆT NAM</p>
      <img class="company-logo" src="pic/LOGO.png" alt="Logo company" />
    </div>
  </footer>

</body>
</html>
