<?php
include('connect.php');
include('header.php');

// Tạo danh sách ngày (hôm nay + 6 ngày tiếp)
$dates = [];
setlocale(LC_TIME, 'vi_VN'); // Tiếng Việt
for ($i = 0; $i < 7; $i++) {
    $day = date('Y-m-d', strtotime("+$i day"));
    $dates[] = [
        'date' => $day,
        'label' => $i === 0 ? 'Hôm nay' : strftime('%A', strtotime($day)),
        'short' => date('d/m', strtotime($day)),
    ];
}

$current_date = $_GET['date'] ?? date('Y-m-d');
$city = $_GET['city'] ?? '';
$cinema_id = $_GET['cinema'] ?? '';
$movie_id = $_GET['id'] ?? ''; // lấy từ chitietphim.php
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
        <a href="?date=<?php echo $d['date']; ?><?php if ($movie_id) echo '&id=' . $movie_id; ?>" class="date-tab <?php if ($d['date'] === $current_date) echo 'active'; ?>">
          <?php echo $d['label']; ?><br><?php echo $d['short']; ?>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Bộ lọc -->
    <div class="filters">
      <form method="GET">
        <input type="hidden" name="date" value="<?php echo htmlspecialchars($current_date); ?>">
        <?php if ($movie_id): ?>
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($movie_id); ?>">
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
    // Truy vấn dữ liệu suất chiếu
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
    if (!empty($city)) {
        $sql .= " AND c.city = ?";
        $params[] = $city;
    }
    if (!empty($cinema_id)) {
        $sql .= " AND c.id = ?";
        $params[] = $cinema_id;
    }
    if (!empty($movie_id)) {
        $sql .= " AND m.id = ?";
        $params[] = $movie_id;
    }

    $sql .= " ORDER BY c.ci_name, s.show_time";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        echo "<p>Lỗi truy vấn.</p>";
        include('footer.php');
        exit;
    }

    if (!$result || mysqli_num_rows($result) === 0) {
        echo "<p>Không có lịch chiếu cho ngày này.</p>";
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
