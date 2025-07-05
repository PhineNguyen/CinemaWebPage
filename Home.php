<?php
session_start();
include("connect.php");
include("header.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>
  <link rel="stylesheet" href="CSS/Home.css" />
</head>
<body>

<!-- Menu điều hướng -->
<nav class="nav-item">
  <a href="#" id="tab-home" class="active">PHIM</a>
  <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
  <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
  <a href="#" id="lien-he-tab">LIÊN HỆ</a>
</nav>

<div id="main-content">
<?php
// PHIM ĐANG CHIẾU - Danh sách chia trang
$limit_poster = 6;
$page_poster = isset($_GET['page_poster']) ? (int)$_GET['page_poster'] : 1;
if ($page_poster < 1) $page_poster = 1;
$offset_poster = ($page_poster - 1) * $limit_poster;

// Đếm tổng số phim đang chiếu để phân trang
$total_active = mysqli_query($conn, "SELECT COUNT(*) AS total FROM movies WHERE status ='Đang chiếu'");
$total_row = mysqli_fetch_assoc($total_active);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit_poster);
if ($page_poster > $total_pages && $total_pages > 0) $page_poster = $total_pages;

// Lấy danh sách phim đang chiếu
$sql = "SELECT id, title, image_URL, banner_url FROM movies WHERE status ='Đang chiếu' LIMIT $offset_poster, $limit_poster";
$movies_act = mysqli_query($conn, $sql);

if ($movies_act && mysqli_num_rows($movies_act) > 0) {
  $movies_active = mysqli_fetch_all($movies_act, MYSQLI_ASSOC);

  // Banner Slider (chỉ lấy banner của phim đang chiếsu trang này)
  echo '<section class="banner-slider">';
  echo '<div class="slides">';
  foreach ($movies_active as $movie_act) {
    $id = $movie_act['id'];
    $banner = htmlspecialchars($movie_act['banner_url']);
    echo "
      <div class='slide-item'>
        <a href='chitietphim.php?id=$id'>
          <img src='$banner' alt='Banner phim'>
        </a>
      </div>
    ";
  }
  echo '</div>';
  echo '
    <button class="muitentrai" onclick="prevSlide()">&#10094;</button>
    <button class="muitenphai" onclick="nextSlide()">&#10095;</button>
  ';
  echo '</section>';

  // Movie Poster dạng lưới 3 cột
  echo '<div class="double-line-heading"><span>MOVIE SELECTION</span></div>';
  echo '<div class="movie-active">';
  foreach ($movies_active as $movie) {
    $id = $movie['id'];
    $title = htmlspecialchars($movie['title']);
    $image = htmlspecialchars($movie['image_URL']);
    echo <<<HTML
    <div class="movie-item">
      <div class="poster-img">
        <a href="chitietphim.php?id=$id">
          <img src="$image" alt="Poster phim $title">
        </a>
      </div>
      <div class="button">
        <a href="chitietphim.php?id=$id">XEM CHI TIẾT</a>
        <a href="chonlichchieu.php?id=$id">ĐẶT VÉ</a>
      </div>
    </div>
    HTML;
  }
  echo '</div>';

  // PHÂN TRANG
  if ($total_pages > 1) {
    echo '<div class="pagination">';
    if ($page_poster > 1) {
      echo '<a href="?page_poster=' . ($page_poster - 1) . '"><<</a>';
    }
    $max_links = 4;
    $start = max(1, $page_poster - floor($max_links / 2));
    $end = min($total_pages, $start + $max_links - 1);

    if ($start > 1) {
      echo '<a href="?page_poster=1">1</a>';
      if ($start > 2) echo '<span>...</span>';
    }
    for ($i = $start; $i <= $end; $i++) {
      if ($i == $page_poster) {
        echo '<strong>' . $i . '</strong>';
      } else {
        echo '<a href="?page_poster=' . $i . '">' . $i . '</a>';
      }
    }
    if ($end < $total_pages) {
      if ($end < $total_pages - 1) echo '<span>...</span>';
      echo '<a href="?page_poster=' . $total_pages . '">' . $total_pages . '</a>';
    }
    if ($page_poster < $total_pages) {
      echo '<a href="?page_poster=' . ($page_poster + 1) . '">>></a>';
    }
    echo '</div>';
  }
} else {
  echo "<p style='text-align:center; color:white;'>Không có phim nào để hiển thị.</p>";
}
// PHIM SẮP CHIẾU - Slide giữ nguyên
$sql = "SELECT id, title, image_URL, banner_url FROM movies WHERE status = 'Sắp chiếu' ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

  echo '<div class="double-line-heading"><span>COMMING SOON</span></div>';
  // Movie Poster
  echo '<div class="movie">';
  foreach ($movies as $movie) {
    $id = $movie['id'];
    $title = htmlspecialchars($movie['title']);
    $image = htmlspecialchars($movie['image_URL']);
    echo <<<HTML
    <div class="movie-item">
      <div class="poster-img">
        <img src="$image" alt="Poster phim $title" />
      </div>
      <div class="button">
        <div><a href="chitietphim.php?id=$id">XEM CHI TIẾT</a></div>

      </div>
    </div>
    HTML;
  }
  echo '</div>';
} else {
  echo "<p style='text-align:center; color:white;'>Không có phim sắp chiếu để hiển thị.</p>";
}
?>
</div>

<!-- Các vùng nội dung động -->
<div id="rap-cinetix-content" style="display:none;"></div>
<div id="gia-ve-content" style="display:none;"></div>
<div id="lien-he-content" style="display:none;"></div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/Home.js"></script>
<script src="js/rolltab.js"></script>
</body>
</html>
<?php include("footer.php"); ?>