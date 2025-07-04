<?php
include("connect.php");
include("header.php");

$showtime_id = $_GET['showtime_id'] ?? '';
if (!$showtime_id) {
    echo "<p style='color: white;'>Thiếu thông tin suất chiếu.</p>";
    include("footer.php");
    exit;
}

// Lấy room_id
$room_id = null;
$stmt_room = mysqli_prepare($conn, "
    SELECT r.id AS room_id 
    FROM showtimes s
    JOIN rooms r ON s.room_id = r.id
    WHERE s.id = ?
");
mysqli_stmt_bind_param($stmt_room, 's', $showtime_id);
mysqli_stmt_execute($stmt_room);
$room_result = mysqli_stmt_get_result($stmt_room);
if ($row = mysqli_fetch_assoc($room_result)) {
    $room_id = $row['room_id'];
} else {
    echo "<p style='color: white;'>Không tìm thấy thông tin phòng chiếu.</p>";
    include("footer.php");
    exit;
}

// Lấy thông tin suất chiếu
$stmt_info = mysqli_prepare($conn, "
    SELECT 
        m.title, m.image_url,
        s.show_date, s.show_time,
        c.ci_name AS cinema_name,
        r.room_number
    FROM showtimes s
    JOIN movies m ON s.movie_id = m.id
    JOIN rooms r ON s.room_id = r.id
    JOIN cinemas c ON r.cinema_id = c.id
    WHERE s.id = ?
");
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
echo '<div class="screen">Màn hình</div><div class="seating-container">';
echo "<!-- room_id: $room_id -->";
$stmt_seats = mysqli_prepare($conn, "
    SELECT seat_row, seat_number, seat_type, seat_status 
    FROM seats 
    WHERE room_id = ?
    ORDER BY seat_row, seat_number
");
mysqli_stmt_bind_param($stmt_seats, 'i', $room_id);
mysqli_stmt_execute($stmt_seats);
$seats_result = mysqli_stmt_get_result($stmt_seats);
if (mysqli_num_rows($seats_result) === 0) {
    echo "<p style='color:red;'>Không có ghế nào cho phòng này.</p>";
}

$current_row = '';
while ($seat = mysqli_fetch_assoc($seats_result)) {
    $seat_row = $seat['seat_row'];
    $seat_number = (int)$seat['seat_number'];
    $seat_type = $seat['seat_type']; // 'Ghế thường', 'Ghế VIP', 'Ghế đôi'
    $seat_status = $seat['seat_status']; // 'Ghế đã đặt', 'Ghế trống'

    // Xác định class cho loại ghế
    switch ($seat_type) {
        case 'Ghế đôi':
            $type_class = 'special';
            break;
        case 'Ghế VIP':
            $type_class = 'vip';
            break;
        default:
            $type_class = 'normal';
    }

    // Xác định class cho trạng thái ghế
    $status_class = ($seat_status === 'Ghế đã đặt') ? 'booked' : 'available';

    if ($seat_row !== $current_row) {
        if ($current_row !== '') echo '</div>'; // kết thúc hàng cũ
        echo '<div class="seat-row">';
        $current_row = $seat_row;
    }

    $seat_code = htmlspecialchars($seat_row . $seat_number);
    $seat_class = "seat seat-$status_class seat-$type_class";
    if ($status_class === 'available') {
        $seat_class .= ' seat-available';
    }

    echo "<button class='$seat_class' data-row='$seat_row' data-number='$seat_number'>$seat_code</button>";
}
if ($current_row !== '') echo '</div>';
echo '</div>'; // Kết thúc sơ đồ
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
      <div><span>Giá vé</span> <strong id="ticket-price">0,00 đ</strong> <i class="icon-info">ⓘ</i></div>
      <div><span>Combo</span> <strong>0,00 đ</strong> <i class="icon-info">ⓘ</i></div>
      <div><span>Tổng</span> <strong id="ticket-total">0,00 đ</strong></div>
    </div>
  </div>
</div>

<div class="continue-btn">
  <button class="button-continute">Tiếp tục</button>
</div>
<script> const SHOWTIME_ID = "<?= htmlspecialchars($showtime_id) ?>";</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/chonghe.js"></script>
</body>
</html>
<?php include("footer.php"); ?>
