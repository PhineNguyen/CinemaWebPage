<?php
session_start();
include('connect.php');
include('header.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    $redirect = "chonlichchieu.php";
    $query = $_SERVER['QUERY_STRING'];
    if ($query) $redirect .= "?" . $query;
    header("Location: Login.php?redirect=" . urlencode($redirect));
    exit;
}

// Danh sách ngày hôm nay + 6 ngày tới
$dates = [];
for ($i = 0; $i < 7; $i++) {
    $day = date('Y-m-d', strtotime("+$i day"));
    $dates[] = [
        'date' => $day,
        'label' => $i === 0 ? 'Hôm nay' : date('l', strtotime($day)),
        'short' => date('d/m', strtotime($day)),
    ];
}

$current_date = $_GET['date'] ?? date('Y-m-d');
$city = $_GET['city'] ?? '';
$cinema_id = $_GET['cinema'] ?? '';
$movie_id = $_GET['id'] ?? ''; // ID phim truyền từ chi tiết phim
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chọn lịch chiếu</title>
  <link rel="stylesheet" href="CSS/chonlichchieu.css?v=2.1">
</head>
<body>
<nav class="nav-item">
  <a href="home.php">PHIM</a>
  <a href="rapCinetix.php">RẠP CINETIX</a>
  <a href="giave.php">GIÁ VÉ</a>
  <a href="lienhe.php">LIÊN HỆ</a>
</nav>

<div class="content">
  <p class="lich">Lịch chiếu</p>

  <!-- Tabs ngày -->
  <div class="date-tabs">
    <?php foreach ($dates as $d): ?>
      <a href="?date=<?= $d['date'] ?><?= $movie_id ? '&id=' . $movie_id : '' ?>" class="date-tab <?= $d['date'] === $current_date ? 'active' : '' ?>">
        <?= $d['label'] ?><br><?= $d['short'] ?>
      </a>
    <?php endforeach; ?>
  </div>

  <!-- Bộ lọc -->
  <div class="filters">
    <form method="GET">
      <input type="hidden" name="date" value="<?= htmlspecialchars($current_date) ?>">
      <?php if ($movie_id): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($movie_id) ?>">
      <?php endif; ?>

      <select name="city" class="filter-select">
        <option value="">Toàn quốc</option>
        <?php
        $city_rs = mysqli_query($conn, "SELECT DISTINCT city FROM cinemas ORDER BY city");
        while ($row = mysqli_fetch_assoc($city_rs)) {
            $selected = ($city === $row['city']) ? 'selected' : '';
            echo "<option value='{$row['city']}' $selected>{$row['city']}</option>";
        }
        ?>
      </select>

      <select name="cinema" class="filter-select">
        <option value="">Tất cả rạp</option>
        <?php
        $cinema_rs = mysqli_query($conn, "SELECT id, ci_name FROM cinemas ORDER BY ci_name");
        while ($row = mysqli_fetch_assoc($cinema_rs)) {
            $selected = ($cinema_id === $row['id']) ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>{$row['ci_name']}</option>";
        }
        ?>
      </select>

      <button type="submit" class="filter-select">Lọc</button>
    </form>
  </div>

  <?php
  // Truy vấn lịch chiếu
  $sql = "
    SELECT 
      s.id AS showtime_id,
      c.ci_name AS cinema_name,
      s.show_time
    FROM showtimes s
    JOIN rooms r ON s.room_id = r.id
    JOIN cinemas c ON r.cinema_id = c.id
    JOIN movies m ON s.movie_id = m.id
    WHERE s.show_date = ?
  ";

  $params = [$current_date];
  $types = "s";

  if (!empty($city)) {
      $sql .= " AND c.city = ?";
      $params[] = $city;
      $types .= "s";
  }

  if (!empty($cinema_id)) {
      $sql .= " AND c.id = ?";
      $params[] = $cinema_id;
      $types .= "s";
  }

  if (!empty($movie_id)) {
      $sql .= " AND m.id = ?";
      $params[] = $movie_id;
      $types .= "s";
  }

  $sql .= " ORDER BY c.ci_name, s.show_time";

  $stmt = $conn->prepare($sql);
  if ($stmt) {
      $stmt->bind_param($types, ...$params);
      $stmt->execute();
      $result = $stmt->get_result();
  } else {
      echo "<p>Lỗi truy vấn lịch chiếu.</p>";
      include('footer.php');
      exit;
  }

  if ($result->num_rows === 0) {
      echo "<p class='no-showtimes'>Không có lịch chiếu cho ngày này.</p>";
  } else {
      $cinemas = [];
      while ($row = mysqli_fetch_assoc($result)) {
          $cinema = $row['cinema_name'];
          $cinemas[$cinema][] = [
              'time' => substr($row['show_time'], 0, 5),
              'showtime_id' => $row['showtime_id']
          ];
      }

      foreach ($cinemas as $cinema_name => $times) {
          echo "<div class='cinema'>";
          echo "<h3>" . htmlspecialchars($cinema_name) . "</h3>";
          echo "<div class='times'>";
          foreach ($times as $t) {
              echo "<a href='chonghe.php?showtime_id=" . $t['showtime_id'] . "' class='time-btn'>" . htmlspecialchars($t['time']) . "</a>";
          }
          echo "</div>";
          echo "</div>";
      }
  }
  ?>
</div>

</body>
</html>
<?php include('footer.php'); ?>
