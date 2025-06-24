<?php
  session_start();
  include('connect.php');
  include('header.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chọn lịch chiếu</title>
  <link rel="stylesheet" href="CSS/chonlichchieu.css">
</head>
<body>
  <!-- Menu điều hướng -->
  <nav class="nav-item">
    <a href="#" class="active">PHIM</a>
    <a href="#">RẠP CINETIX</a>
    <a href="#">GIÁ VÉ</a>
    <a href="#">LIÊN HỆ</a>
  </nav>
  
  <div class="content">
    <p class="lich">Lịch chiếu</p>
    <div class="showtime-bar">
      <div class="control-row">
        <button class="scroll-btn" id="prevBtn">&lt;</button>
        <div class="date-tabs-wrapper">
          <div class="date-tabs" id="dateTabs"></div>
        </div>
        <button class="scroll-btn" id="nextBtn">&gt;</button>
        
        <?php
        // Lấy danh sách tỉnh/thành
        $city_query = "SELECT DISTINCT city FROM cinemas ORDER BY city";
        $city_result= mysqli_query($link, $city_query);

        // Lấy danh sách rạp
        $ci_name_query = "SELECT id, ci_name FROM cinemas ORDER BY ci_name";
        $ci_name_result = mysqli_query($link, $ci_name_query);
        ?>

        <select class="filter-select">
          <option>Toàn quốc</option>
          <?php
          if ($city_result->num_rows > 0) {
            while ($row = $city_result->fetch_assoc()) {
              echo '<option value="' . htmlspecialchars($row['city']) . '">' . htmlspecialchars($row['city']) . '</option>';
            }
          }
          ?>
        </select>

        <select class="filter-select">
          <option>Tất cả rạp</option>
          <?php
          if ($ci_name_result->num_rows > 0) {
            while ($row = $ci_name_result->fetch_assoc()) {
              echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['ci_name']) . '</option>';
            }
          }
          ?>
        </select>
      </div>
    </div>

    <script src="js/chonlichchieu.js"></script>

    <p style="font-weight: bold; font-size:20px; color: white;">Danh sách rạp</p>

    <?php
    // Truy vấn dữ liệu từ CSDL
    $sql = "
    SELECT 
        c.ci_name AS cinema_name,
        c.city AS cinema_city,
        r.room_number AS room_name,
        m.title AS movie_title,
        m.genre,
        m.image_url,
        s.show_time,
        s.price
    FROM showtimes s
    JOIN rooms r ON s.room_id = r.id
    JOIN cinemas c ON r.cinema_id = c.id
    JOIN movies m ON s.movie_id = m.id
    WHERE s.show_date = CURDATE()
    ORDER BY c.ci_name, r.room_number, s.show_time";

    $result = mysqli_query($link, $sql);

    $cinemas = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $cinema = $row['cinema_name'];
        $room = $row['room_name'];
        $movie = $row['movie_title'];
        $time = substr($row['show_time'], 0, 5);

        $cinemas[$cinema][$room][$movie][] = $time;
    }

    foreach ($cinemas as $cinema_name => $rooms) {
        echo "<div class='cinema'>";
        echo "<h3>" . htmlspecialchars($cinema_name) . "</h3>";

        foreach ($rooms as $room_name => $movies) {
            echo "<div class='room-title'>" . htmlspecialchars($room_name) . "</div>";

            foreach ($movies as $movie_title => $times) {
                echo "<div class='movie-title'><strong>" . htmlspecialchars($movie_title) . "</strong></div>";
                echo "<div class='times'>";
                foreach ($times as $time) {
                    echo "<button class='time-btn'>" . $time . "</button>";
                }
                echo "</div>";
            }
        }

        echo "</div><hr>";
    }
    ?>

  </div>
</body>
<?php include('footer.php'); ?>
