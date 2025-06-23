<?php
include("connect.php");
include("header.php");
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
    <a href="#" id="home-tab">PHIM</a>
    <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
    <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
    <a href="#" id="lien-he-tab">LIÊN HỆ</a>
  </nav>

<div class="seat-container">
<?php
$room_id = 1; // hoặc $_GET['room_id']
include("connect.php"); // Đảm bảo kết nối cơ sở dữ liệu

$sql = "SELECT seat_row, seat_number, seat_status 
        FROM seats 
        WHERE room_id = $room_id 
        ORDER BY seat_row, seat_number";
$result = mysqli_query($conn, $sql);

$current_row = '';
echo '<div class="screen">Màn hình</div>';
echo '<div class="seating-container">'; // bọc toàn bộ sơ đồ

while ($row = mysqli_fetch_assoc($result)) {
    $seat_row = $row['seat_row'];
    $seat_number = $row['seat_number'];
    $seat_status = ($row['seat_status'] === 'Ghế đã đặt') ? 'booked' : 'available';

    // Phân loại ghế
    if ($seat_row === 'G') {
        $seat_type = 'special';
    } elseif (in_array($seat_row, ['C', 'D', 'E', 'F']) && in_array($seat_number, [3, 4, 5, 6, 7, 8])) {
        $seat_type = 'vip';
    } else {
        $seat_type = 'normal';
    }

    // Nếu là dòng mới
    if ($seat_row !== $current_row) {
        if ($current_row !== '') {
            echo '</div>'; // kết thúc dòng cũ
        }
        echo '<div class="seat-row">';
        $current_row = $seat_row;
    }

    $seat_code = $seat_row . $seat_number;
    $seat_class = "seat seat-$seat_status seat-$seat_type";
    echo "<button class='$seat_class' data-row='$seat_row' data-number='$seat_number'>$seat_code</button>";
}   
echo '</div>'; // đóng dòng cuối
echo '</div>'; // đóng seating-container
?>

</div>

<!-- Legend -->
<div class="legend">
  <div class="legend-item"><div class="seat seat-booked"></div> Ghế đã đặt</div>
  <div class="legend-item"><div class="seat seat-available-pic seat-normal"></div> Ghế thường</div>
  <div class="legend-item"><div class="seat seat-selected"></div> Ghế bạn chọn</div>
  <div class="legend-item"><div class="seat seat-available-pic seat-special"></div> Ghế đôi</div>
</div>

<!-- Movie info -->
<!-- <div class="info">
  Phim điện ảnh Doraemon: Nobita và cuộc phiêu lưu vào thế giới trong tranh<br>
  07/06 | 17:00 | CINETIX Tân Bình | Rạp số 5 | E08 | Lồng tiếng
</div> -->
<?php

// Lấy dữ liệu vé gần nhất
$sql = "
SELECT 
    m.title, m.image_url,
    s.show_date, s.show_time,
    c.ci_name AS cinema_name,
    r.room_number,
    b.total_amount,
    GROUP_CONCAT(DISTINCT f.namef SEPARATOR ', ') AS food_items,
    SUM(fo.quantity * f.price) AS food_total
FROM bookings b
JOIN showtimes s ON b.showtime_id = s.id
JOIN movies m ON s.movie_id = m.id
JOIN rooms r ON s.room_id = r.id
JOIN cinemas c ON r.cinema_id = c.id
LEFT JOIN food_orders fo ON b.id = fo.booking_id
LEFT JOIN foods f ON fo.food_id = f.id
GROUP BY b.id
ORDER BY b.booking_time DESC
LIMIT 1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="ticket">
  <div class="ticket-poster">
    <img src="<?php echo $row['image_url']; ?>" alt="poster film">
  </div>
  <div class="ticket-info">
    <div class="info-left">
      <div><?php echo $row['title']; ?></div>
      <div>2D</div>
      <div>K</div>
    </div>
    <div class="info-mid">
      <div><span>Rạp</span> <strong><?php echo $row['cinema_name']; ?></strong></div>
      <div><span>Suất chiếu</span> 
        <strong><?php echo date("H:i", strtotime($row['show_time'])) . ", " . date("d/m/Y", strtotime($row['show_date'])); ?></strong>
      </div>
      <div><span>Phòng chiếu</span> <strong><?php echo $row['room_number']; ?></strong></div>
    </div>
    <div class="info-right">
      <div><span>Tên phim</span> <strong>0,00 đ</strong> <i class="icon-info">ⓘ</i></div>
      <div><span>Combo</span> <strong><?php echo number_format($row['food_total'], 2); ?> đ</strong> <i class="icon-info">ⓘ</i></div>
      <div><span>Tổng</span> <strong><?php echo number_format($row['total_amount'], 2); ?> đ</strong></div>
    </div>
  </div>
</div>


<div class="continue-btn">
  <button class="button-continute">Tiếp tục</button>
</div>

<script src="js/chonghe.js"></script>
</body>
</html>
<?php include("footer.php"); ?>
