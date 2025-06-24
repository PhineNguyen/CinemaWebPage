<?php
  include('connect.php');
  include('header.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chọn lịch chiếu</title>
<<<<<<< HEAD
  <link rel="stylesheet" href="CSS/chonlichchieu.css">
=======
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CSS/chonlichchieu.css" />
>>>>>>> d53afb058e83463d21ca4d3efa8c8e9f721e1798
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
        $city_result = mysqli_query($link, $city_query);
        if (!$city_result) {
          die("Lỗi truy vấn city: " . mysqli_error($link));
        }

        // Lấy danh sách rạp
        $ci_name_query = "SELECT id, ci_name, city FROM cinemas ORDER BY ci_name";
        $ci_name_result = mysqli_query($link, $ci_name_query);
        if (!$ci_name_result) {
          die("Lỗi truy vấn ci_name: " . mysqli_error($link));
        }

        $cinemas_data = [];
        while ($row = mysqli_fetch_assoc($ci_name_result)) {
          $cinemas_data[] = $row;
        }
        ?>

        <select class="filter-select" id="citySelect">
          <option value="">Toàn quốc</option>
          <?php
          while ($row = mysqli_fetch_assoc($city_result)) {
            echo '<option value="' . htmlspecialchars($row['city']) . '">' . htmlspecialchars($row['city']) . '</option>';
          }
          ?>
        </select>

        <select class="filter-select" id="cinemaSelect">
          <option value="">Tất cả rạp</option>
          <?php
          foreach ($cinemas_data as $cinema) {
            echo '<option value="' . htmlspecialchars($cinema['id']) . '" data-city="' . htmlspecialchars($cinema['city']) . '">' . htmlspecialchars($cinema['ci_name']) . '</option>';
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
    if (!$result) {
      die("Lỗi truy vấn showtimes: " . mysqli_error($link));
    }

    if (mysqli_num_rows($result) == 0) {
      echo "<p style='color: white;'>Hiện không có lịch chiếu nào trong hôm nay.</p>";
    } else {
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
                      echo "<button class='time-btn'>" . htmlspecialchars($time) . "</button>";
                  }
                  echo "</div>";
              }
          }

          echo "</div><hr>";
      }
    }
    ?>
  </div>
  <script src="js/chonlichchieu.js"></script>
</body>
<<<<<<< HEAD
<?php include('footer.php'); ?>
=======
</html>
<?php include("footer.php"); ?>
>>>>>>> d53afb058e83463d21ca4d3efa8c8e9f721e1798
