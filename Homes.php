<?php
include("connect.php");
include("header.php");

// PHIM ĐANG CHIẾU - Danh sách chia trang
$limit_poster = 9; // 3x3
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
$movies_active = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Danh sách phim</title>
  <link rel="stylesheet" href="css/phim.css">
  <style>
    body {
  background-color: #111;
  color: #fff;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
}

.phim-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  max-width: 1000px;
  margin: auto;
}

.phim-item {
  background-color: #222;
  border-radius: 10px;
  overflow: hidden;
  text-align: center;
  transition: transform 0.2s;
}

.phim-item:hover {
  transform: scale(1.05);
}

.phim-item img {
  width: 100%;
  height: 300px;
  object-fit: cover;
}

.phim-item h3 {
  padding: 10px;
  font-size: 18px;
  color: #f0f0f0;
}

  </style>
</head>
<body>
  <div class="phim-container">
    <?php if ($movies_active && mysqli_num_rows($movies_active) > 0): ?>
      <?php while ($movie = mysqli_fetch_assoc($movies_active)): ?>
        <div class="phim-item">
          <img src="<?php echo htmlspecialchars($movie['image_URL']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
          <h3><?php echo htmlspecialchars($movie['title']); ?></h3>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="color:white;">Không có phim nào đang chiếu.</p>
    <?php endif; ?>
  </div>

  <!-- Phân trang -->
  <div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <a href="?page_poster=<?php echo $i; ?>" class="<?php echo ($i == $page_poster) ? 'active' : ''; ?>">
        <?php echo $i; ?>
      </a>
    <?php endfor; ?>
  </div>
</body>
</html>
<?php include("footer.php"); ?>
