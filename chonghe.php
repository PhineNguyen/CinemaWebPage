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

<div class="screen">Màn hình</div>

<div class="seat-container">
  <?php
    $room_id = 1; // bạn có thể thay bằng $_GET['room_id'] nếu muốn linh động

    $sql = "SELECT seat_row, seat_number, seat_status, seat_type 
            FROM seats 
            WHERE room_id = $room_id 
            ORDER BY seat_row, seat_number";
    $result = mysqli_query($conn, $sql);

    $current_row = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $seat_row = $row['seat_row'];
        $seat_number = $row['seat_number'];
        $seat_status = ($row['seat_status'] === 'Ghế đã đặt') ? 'booked' : 'available';
        // Tự phân loại ghế VIP và Ghế đôi
        if ($seat_row === 'G') {
            $seat_type = 'special'; // Ghế đôi
        } elseif (in_array($seat_row, ['C', 'D', 'E']) && in_array($seat_number, [4, 5, 6, 7])) {
            $seat_type = 'vip'; // Ghế VIP
        } else {
            $seat_type = 'normal'; // Ghế thường
        }


        if ($seat_row !== $current_row) {
            if ($current_row !== '') {
                echo '</div>';
            }
            echo '<div class="seat-row">';
            $current_row = $seat_row;
        }

        $seat_code = $seat_row . $seat_number;
        $seat_class = "seat seat-$seat_status seat-$seat_type";

        echo "<button class='$seat_class'>$seat_code</button>";
    }
    echo '</div>';
  ?>
</div>

<!-- Legend -->
<div class="legend">
  <div class="legend-item"><div class="seat seat-booked"></div> Ghế đã đặt</div>
  <div class="legend-item"><div class="seat seat-available seat-normal"></div> Ghế thường</div>
  <div class="legend-item"><div class="seat seat-selected"></div> Ghế bạn chọn</div>
  <div class="legend-item"><div class="seat seat-available seat-special"></div> Ghế đôi</div>
</div>

<!-- Movie info -->
<!-- <div class="info">
  Phim điện ảnh Doraemon: Nobita và cuộc phiêu lưu vào thế giới trong tranh<br>
  07/06 | 17:00 | CINETIX Tân Bình | Rạp số 5 | E08 | Lồng tiếng
</div> -->
<div class="Bill">
    
</div>
<button class="continue-btn">Tiếp tục</button>

</body>
</html>
<?php include("footer.php"); ?>
