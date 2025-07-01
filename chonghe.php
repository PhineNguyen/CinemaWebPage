<?php
include("connect.php");
include("header.php");

$showtime_id = $_GET['showtime_id'] ?? '';
if (!$showtime_id) {
    echo "<p style='color: white;'>Thiếu thông tin suất chiếu.</p>";
    include("footer.php");
    exit;
}

// Lấy room_id từ showtime
$room_sql = "SELECT r.id AS room_id FROM showtimes s
             JOIN rooms r ON s.room_id = r.id
             WHERE s.id = ?";
$stmt_room = mysqli_prepare($conn, $room_sql);
mysqli_stmt_bind_param($stmt_room, 's', $showtime_id);
mysqli_stmt_execute($stmt_room);
$room_result = mysqli_stmt_get_result($stmt_room);

if ($room_result && mysqli_num_rows($room_result) > 0) {
    $room_data = mysqli_fetch_assoc($room_result);
    $room_id = $room_data['room_id'];
} else {
    echo "<p style='color: white;'>Không tìm thấy thông tin phòng chiếu.</p>";
    include("footer.php");
    exit;
}

// Lấy thông tin suất chiếu
$info_sql = "
SELECT 
    m.title, m.image_url,
    s.show_date, s.show_time,
    c.ci_name AS cinema_name,
    r.room_number
FROM showtimes s
JOIN movies m ON s.movie_id = m.id
JOIN rooms r ON s.room_id = r.id
JOIN cinemas c ON r.cinema_id = c.id
WHERE s.id = ?";
$stmt_info = mysqli_prepare($conn, $info_sql);
mysqli_stmt_bind_param($stmt_info, 's', $showtime_id);
mysqli_stmt_execute($stmt_info);
$info_result = mysqli_stmt_get_result($stmt_info);
$info = mysqli_fetch_assoc($info_result);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đặt vé xem phim</title>
  <link rel="stylesheet" href="CSS/chonghe.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<nav class="nav-item">
  <a href="home.php">PHIM</a>
  <a href="rapCinetix.php">RẠP CINETIX</a>
  <a href="giave.php">GIÁ VÉ</a>
  <a href="lienhe.php">LIÊN HỆ</a>
</nav>

<div class="seat-container">
<?php
$sql = "SELECT seat_row, seat_number, seat_status 
        FROM seats 
        WHERE room_id = ? 
        ORDER BY seat_row, seat_number";
$stmt_seats = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt_seats, 's', $room_id);
mysqli_stmt_execute($stmt_seats);
$seats_result = mysqli_stmt_get_result($stmt_seats);

$current_row = '';
echo '<div class="screen">Màn hình</div>';
echo '<div class="seating-container">';

while ($row = mysqli_fetch_assoc($seats_result)) {
    $seat_row = $row['seat_row'];
    $seat_number = $row['seat_number'];
    $seat_status = ($row['seat_status'] === 'Ghế đã đặt') ? 'booked' : 'available';

    if ($seat_row === 'G') {
        $seat_type = 'special';
    } elseif (in_array($seat_row, ['C', 'D', 'E', 'F']) && in_array($seat_number, [3,4,5,6,7,8])) {
        $seat_type = 'vip';
    } else {
        $seat_type = 'normal';
    }

    if ($seat_row !== $current_row) {
        if ($current_row !== '') echo '</div>';
        echo '<div class="seat-row">';
        $current_row = $seat_row;
    }

    $seat_code = $seat_row . $seat_number;
    $seat_class = "seat seat-$seat_status seat-$seat_type";
    if ($seat_status === 'available') {
        $seat_class .= ' seat-available';
    }
    echo "<button class='$seat_class' data-row='$seat_row' data-number='$seat_number'>$seat_code</button>";
}
echo '</div>'; // hàng cuối
echo '</div>'; // sơ đồ
?>
</div>

<div class="legend">
  <div class="legend-item"><div class="seat seat-booked"></div> Ghế đã đặt</div>
  <div class="legend-item"><div class="seat seat-available-pic seat-normal"></div> Ghế thường</div>
  <div class="legend-item"><div class="seat seat-selected"></div> Ghế bạn chọn</div>
  <div class="legend-item"><div class="seat seat-available-pic seat-special"></div> Ghế đôi</div>
</div>

<div class="ticket">
  <div class="ticket-poster">
    <img src="<?php echo $info['image_url']; ?>" alt="poster film">
  </div>
  <div class="ticket-info">
    <div class="info-left">
      <div><?php echo $info['title']; ?></div>
    </div>
    <div class="info-mid">
      <div><span>Rạp</span> <strong><?php echo $info['cinema_name']; ?></strong></div>
      <div><span>Suất chiếu</span> 
        <strong><?php echo date("H:i", strtotime($info['show_time'])) . ", " . date("d/m/Y", strtotime($info['show_date'])); ?></strong>
      </div>
          <div>
        <span>Ghế bạn chọn:</span> <strong id="selected-seats-list">Không có</strong>
      </div>
      <div><span>Phòng chiếu</span> <strong><?php echo $info['room_number']; ?></strong></div>
    </div>

    <div class="info-right">
      <div><span>Giá vé</span> <strong id="ticket-price">0,00 đ</strong> <i class="icon-info">ⓘ</i></div>
      <div><span>Combo</span> <strong>0,00 đ</strong> <i class="icon-info">ⓘ</i></div>
      <div><span>Tổng</span> <strong id="ticket-total">0,00 đ</strong></div>
    </div>
  </div>
</div>

<div class="continue-btn">
  <button class="button-continute">Tiếp tục</button>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  const SHOWTIME_ID = "<?php echo $showtime_id; ?>";
</script>

<script src="js/chonghe.js"></script>
</body>
</html>
<?php include("footer.php"); ?>
