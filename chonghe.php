<?php
include("connect.php");
include("header.php");

// 👉 Xử lý đặt ghế khi gửi POST từ JavaScript
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'book_seats') {
    $seats_raw = $_POST['seats'] ?? '[]';
    $seats = json_decode($seats_raw, true);
    $showtime_id = $_POST['showtime_id'] ?? '';

    if (!$showtime_id || empty($seats)) {
        http_response_code(400);
        echo 'Thiếu dữ liệu!';
        exit;
    }

    // Lấy room_id từ showtime
    $stmt_room = $conn->prepare("SELECT room_id FROM showtimes WHERE id = ?");
    $stmt_room->bind_param("s", $showtime_id);
    $stmt_room->execute();
    $room_result = $stmt_room->get_result();
    $room = $room_result->fetch_assoc();
    $room_id = $room['room_id'] ?? null;

    if (!$room_id) {
        http_response_code(404);
        echo "Không tìm thấy phòng chiếu.";
        exit;
    }

    // Cập nhật trạng thái ghế
    $stmt = $conn->prepare("UPDATE seats SET seat_status = 'Ghế đã đặt' WHERE seat_row = ? AND seat_number = ? AND room_id = ?");
    foreach ($seats as $seat) {
        $row = $seat['row'];
        $number = $seat['number'];
        $stmt->bind_param("sii", $row, $number, $room_id);
        $stmt->execute();
    }

    echo "Đặt ghế thành công!";
    exit;
}

$showtime_id = $_GET['showtime_id'] ?? '';
if (!$showtime_id) {
    echo "<p style='color: white;'>Thiếu thông tin suất chiếu.</p>";
    include("footer.php");
    exit;
}

// Lấy room_id
$stmt_room = $conn->prepare("SELECT r.id AS room_id FROM showtimes s JOIN rooms r ON s.room_id = r.id WHERE s.id = ?");
$stmt_room->bind_param('s', $showtime_id);
$stmt_room->execute();
$room_result = $stmt_room->get_result();
$room_row = $room_result->fetch_assoc();
$room_id = $room_row['room_id'] ?? null;

if (!$room_id) {
    echo "<p style='color: white;'>Không tìm thấy phòng chiếu.</p>";
    include("footer.php");
    exit;
}

// Thông tin phim, suất chiếu
$stmt_info = $conn->prepare("SELECT m.title, m.image_url, m.ticket_price, s.show_date, s.show_time, c.ci_name AS cinema_name, r.room_number FROM showtimes s JOIN movies m ON s.movie_id = m.id JOIN rooms r ON s.room_id = r.id JOIN cinemas c ON r.cinema_id = c.id WHERE s.id = ?");
$stmt_info->bind_param('s', $showtime_id);
$stmt_info->execute();
$info_result = $stmt_info->get_result();
$info = $info_result->fetch_assoc();
$ticket_price = $info['ticket_price'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đặt vé xem phim</title>
  <link rel="stylesheet" href="CSS/chonghe.css">
</head>
<body>
  <!-- Menu điều hướng dạng tab -->
  <nav class="nav-item">
    <a href="#" id="tab-home" class="active">CHỌN GHẾ</a>
    <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
    <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
    <a href="#" id="lien-he-tab">LIÊN HỆ</a>
  </nav>

  <div id="main-content">
    <div class="seat-container">
      <div class="screen">Màn hình</div>
      <div class="seating-container">
      <?php
      $stmt_seats = $conn->prepare("SELECT seat_row, seat_number, seat_type, seat_status, price_seat_type FROM seats WHERE room_id = ? ORDER BY seat_row, seat_number");
      $stmt_seats->bind_param('i', $room_id);
      $stmt_seats->execute();
      $seats_result = $stmt_seats->get_result();

      $current_row = '';
      while ($seat = $seats_result->fetch_assoc()) {
          $seat_row = $seat['seat_row'];
          $seat_number = (int)$seat['seat_number'];
          $seat_type = $seat['seat_type'];
          $seat_status = $seat['seat_status'];
          $seat_price_type = (int)$seat['price_seat_type'];

          $type_class = match($seat_type) {
              'Ghế đôi' => 'special',
              'Ghế VIP' => 'vip',
              default => 'normal'
          };
          $status_class = ($seat_status === 'Ghế đã đặt') ? 'booked' : 'available';

          if ($seat_row !== $current_row) {
              if ($current_row !== '') echo '</div>';
              echo '<div class="seat-row">';
              $current_row = $seat_row;
          }

          $seat_code = htmlspecialchars($seat_row . $seat_number);
          $seat_class = "seat seat-$status_class seat-$type_class";
          if ($status_class === 'available') $seat_class .= ' seat-available';

          echo "<button class='$seat_class' 
              data-row='$seat_row' 
              data-number='$seat_number' 
              data-price='$seat_price_type'
              title='Phụ phí: " . number_format($seat_price_type, 0, ',', '.') . " đ'>$seat_code</button>";
      }
      if ($current_row !== '') echo '</div>';
      ?>
      </div>
    </div>

    <div class="legend">
      <div class="legend-item"><div class="seat seat-booked"></div> Ghế đã đặt</div>
      <div class="legend-item"><div class="seat seat-available-pic seat-normal"></div> Ghế thường</div>
      <div class="legend-item"><div class="seat seat-available-pic seat-vip"></div> Ghế VIP</div>
      <div class="legend-item"><div class="seat seat-selected"></div> Ghế bạn chọn</div>
      <div class="legend-item"><div class="seat seat-available-pic seat-special"></div> Ghế đôi</div>
    </div>

    <div class="ticket">
      <div class="ticket-poster">
        <img src="<?= htmlspecialchars($info['image_url']) ?>" alt="poster film">
      </div>
      <div class="ticket-info">
        <div class="info-left"><div><?= htmlspecialchars($info['title']) ?></div></div>
        <div class="info-mid">
          <div><span>Rạp</span> <strong><?= htmlspecialchars($info['cinema_name']) ?></strong></div>
          <div><span>Suất chiếu</span> 
            <strong><?= date("H:i", strtotime($info['show_time'])) . ", " . date("d/m/Y", strtotime($info['show_date'])) ?></strong>
          </div>
          <div><span>Ghế bạn chọn:</span> <strong id="selected-seats-list">Không có</strong></div>
          <div><span>Phòng chiếu</span> <strong><?= htmlspecialchars($info['room_number']) ?></strong></div>
        </div>
        <div class="info-right">
          <div><span>Giá vé</span> 
          <strong id="ticket-price"><?= number_format($ticket_price, 0, ',', '.') ?> đ</strong> 
          <i class="icon-info" title="Chưa bao gồm phụ phí ghế">ⓘ</i>
        </div>
          <div><span>Tổng</span> <strong id="ticket-total">0,00 đ</strong></div>
        </div>
      </div>
    </div>

    <div class="continue-btn">
      <button class="button-continute">Tiếp tục</button>
    </div>

    <script> const BASE_TICKET_PRICE = <?= (int)$ticket_price ?>; </script>
    <script> const SHOWTIME_ID = "<?= htmlspecialchars($showtime_id) ?>"; </script>
  </div>

  <!-- Các vùng nội dung động giống Home -->
  <div id="rap-cinetix-content" style="display:none;"></div>
  <div id="gia-ve-content" style="display:none;"></div>
  <div id="lien-he-content" style="display:none;"></div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="js/chonghe.js"></script>
  <script src="js/Home.js"></script>
  <script src="js/rolltab.js"></script>
</body>
</html>
<?php include("footer.php"); ?>