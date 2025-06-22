<?php
  include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trang chủ</title>
  <link rel="stylesheet" href="CSS/style.css" />

</head>
<body> 
  <header>
    <div class="logo-item">
      <img class="logo" src="pic/LOGO.png" alt="logo">
    </div>

    <div class="header-item">
      <a href="#">Login/Sign up</a>
    </div>
  </header>

  <nav class="nav-item">
    <a href="#">PHIM</a>
    <a href="#">RẠP CINETIX</a>
    <a href="#">GIÁ VÉ</a>
    <a href="#">LIÊN HỆ</a>
  </nav>

  <?php
$sql = "SELECT image_URL FROM movies";
$result = mysqli_query($conn, $sql);

if ($result && $result->num_rows > 0) {
  echo '<section>';
  echo '<div class="slider">';

  while ($row = mysqli_fetch_assoc($result)) {
    echo '<div><img src="' . $row['image_URL'] . '" alt="Banner phim" /></div>';
  }

  echo '</div>';
  echo '
    <div class="muitentrai">&#10094;</div>
    <div class="muitenphai">&#10095;</div>
  ';
  echo '</section>';
}
?>


  <h2>MOVIE SELECTION</h2>

  <?php
  $sql = "SELECT title_vi, image_URL FROM movies LIMIT 3";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo '<div class="movie">';
    while ($row = $result->fetch_assoc()) {
      echo <<<HTML
      <div class="movie-item">
        <img src="{$row['image_URL']}" alt="poster film {$row['title_vi']}" />
        <div class="button">
          <div><a href="#">XEM CHI TIẾT</a></div>
          <div><a href="#">ĐẶT VÉ</a></div>
        </div>
      </div>
      HTML;
    }
    echo '</div>';
  } else {
    echo "Không có phim nào.";
  }
  ?>

  <footer>
    <div class="f1">
      <h3>Skibidi Việt Nam</h3>
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
        <li>Giờ làm việc: 8:00 - 22:00</li>
        <li>Email hỗ trợ: hoidap@skibidi.vn</li>
      </ul>
    </div>

    <div class="f5">
      <p style="font-size: large;">CÔNG TY TNHH SKIBIDI VIỆT NAM</p>
      <img src="pic/LOGO.png" alt="Logo công ty" />
    </div>
  </footer>

   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</body>
</html>
