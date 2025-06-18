<?php
    include("connect.php");
    include("header.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>CINETIX | Doraemon Movie</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CSS/chitietphim.css">
</head>
<body>
<!-- header -->
<!-- đường dẫn các trang -->
  <nav class="nav-item">
    <a href="#" class="active">PHIM</a>
    <a href="#">RẠP CINETIX</a>
    <a href="#">GIÁ VÉ</a>
    <a href="#">LIÊN HỆ</a>
  </nav>

<!-- chi tiết phim -->
<div class="container">
    <?php
        $sql = "SELECT title, image_url, release_date, genre, director, actor, age_rating, duration, lgs, descript, trailer_url FROM movies LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($phim = mysqli_fetch_assoc($result)) {
    ?>
    <div class="section-title" style="font-size:30px">Nội dung phim</div>
    <div class="movie-info">
        <img src="<?php echo $phim['image_url']; ?>" alt="Poster <?php echo $phim['title']; ?>">
        <div class="movie-detail">
            <h2><?php echo strtoupper($phim['title']); ?></h2>
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
  <div class="movie-detail h2" style="font-weight:bold; font-size:25px;">Giới Thiệu</div>
  <div class="movie-detail">
      <p><?php echo $phim['descript'];?></p>
  </div>
   <?php
// Lấy URL gốc
$original_url = $phim['trailer_url'];

// Chuyển đổi sang dạng nhúng
$embed_url = preg_replace(
    "/watch\?v=([a-zA-Z0-9_-]+)/",
    "embed/$1",
    $original_url
);
?>

<?php if (!empty($embed_url)): ?>
    <label style="font-weight:bold; font-size:20px;">Trailer</label>
    <div class="movie-trailer" style="margin-top: 20px; text-align: center;">
        <iframe 
            width="560" 
            height="315" 
            src="<?php echo $embed_url; ?>" 
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
</body>
</html>
<?php

    include("footer.php");

?>