<?php
session_start();
include("connect.php");
include("header.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chi tiết phim</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CSS/chitietphim.css?v=2.1">
</head>
<body>

  <!-- Menu điều hướng dạng tab -->
  <nav class="nav-item">
    <a href="#" id="tab-home" class="active">PHIM</a>
    <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
    <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
    <a href="#" id="lien-he-tab">LIÊN HỆ</a>
  </nav>


  <!-- Main content: Chi tiết phim -->
  <div id="main-content">
    <div class="container">
      <?php
      if (isset($_GET['id'])) {
          $id = (int)$_GET['id'];
          $sql = "SELECT title, image_url, release_date, genre, director, actor, age_rating, duration, lgs, descript, trailer_url FROM movies WHERE id = $id";
          $result = mysqli_query($conn, $sql);
          if ($result && mysqli_num_rows($result) > 0) {
              $phim = mysqli_fetch_assoc($result);
      ?>
      <div class="section-title" style="font-size:30px">Nội dung phim</div>
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
              <a href="chonlichchieu.php?id=<?php echo $id; ?>" class="btn-buy">🎟 Mua vé</a>
          </div>
      </div>
      <div class="mag">
          <div class="section-title" style="font-size:25px; margin-top: 20px;">Giới Thiệu</div>
          <div class="movie-description">
              <p><?php echo $phim['descript']; ?></p>
          </div>
      </div>
      <?php
      $original_url = $phim['trailer_url'];
      $embed_url = preg_replace("/watch\?v=([a-zA-Z0-9_-]+)/", "embed/$1", $original_url);
      ?>
      <?php if (!empty($embed_url)): ?>
      <label style="font-weight:bold; font-size:25px;">Trailer</label>
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
          } else {
              echo "<p style='color:white;'>Không tìm thấy phim.</p>";
          }
      } else {
          echo "<p style='color:white;'>Thiếu ID phim trong URL.</p>";
      }
      ?>
    </div>
  </div>

  <!-- Các vùng nội dung động giống Home -->
  <div id="rap-cinetix-content" style="display:none;"></div>
  <div id="gia-ve-content" style="display:none;"></div>
  <div id="lien-he-content" style="display:none;"></div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="js/Home.js"></script>
  <script src="js/rolltab.js"></script>

</body>
</html>
<?php include('footer.php')?>