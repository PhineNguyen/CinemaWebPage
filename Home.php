<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>

  <!-- CSS -->
  <link rel="stylesheet" href="CSS/Home.css" />
</head>

<body>
  <?php include("header.php"); ?>

  <!-- Menu điều hướng -->
  <nav class="nav-item">
    <a href="#" class="active">PHIM</a>
    <a href="#">RẠP CINETIX</a>
    <a href="#">GIÁ VÉ</a>
    <a href="#">LIÊN HỆ</a>
  </nav>

  <?php
  $sql = "SELECT title, image_URL FROM movies";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Banner Slider
    echo '<section class="banner-slider">';
    echo '<div class="slides">';
    foreach ($movies as $movie) {
      $image = htmlspecialchars($movie['image_URL']);
      echo "<img src='$image' alt='Banner phim'>";
    }
    echo '</div>';
    echo '
      <button class="muitentrai" onclick="prevSlide()">&#10094;</button>
      <button class="muitenphai" onclick="nextSlide()">&#10095;</button>
    ';
    echo '</section>';

    // Movie Poster
    echo '<div class="double-line-heading"><span>MOVIE SELECTION</span></div>';
    echo '<div class="movie">';
    foreach ($movies as $movie) {
      $title = htmlspecialchars($movie['title']);
      $image = htmlspecialchars($movie['image_URL']);
      echo <<<HTML
      <div class="movie-item">
        <div class="poster-img">
          <img src="$image" alt="Poster phim $title" />
        </div>
        <div class="button">
          <div><a href="#">XEM CHI TIẾT</a></div>
          <div><a href="#">ĐẶT VÉ</a></div>
        </div>
      </div>
      HTML;
    }
    echo '</div>';
  } else {
    echo "<p style='text-align:center; color:white;'>Không có phim nào để hiển thị.</p>";
  }
  ?>

  <?php include("footer.php"); ?>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="Home.js"></script>
</body>

</html>
