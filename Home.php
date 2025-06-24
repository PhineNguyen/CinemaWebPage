<?php
    session_start();
    include("connect.php");
    include("header.php");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>

  <!-- CSS -->
  <link rel="stylesheet" href="CSS/Home.css" />
</head>

<body>
 

  <!-- Menu điều hướng -->
  <nav class="nav-item">
    <a href="#" class="active">PHIM</a>
    <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
    <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
    <a href="#" id="lien-he-tab">LIÊN HỆ</a>
  </nav>

  <div id="main-content">
    <?php
    $sql = "SELECT title, image_URL, banner_url FROM movies";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

      // Banner Slider
      echo '<section class="banner-slider">';
      echo '<div class="slides">';
      foreach ($movies as $movie) {
        $banner = htmlspecialchars($movie['banner_url']);
        echo "
            <div class='slide-item'>
            <img src='$banner' alt='Banner phim'>
            </div>
        ";
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
  </div>

  <div id="rap-cinetix-content" style="display:none;"></div>
  <div id="gia-ve-content" style="display:none;"></div>
  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="js/Home.js"></script>
  <script src="js/rolltab.js"></script>
</body>

</html>
  <?php include("footer.php"); ?>