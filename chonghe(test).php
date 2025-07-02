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
  <h2><?= htmlspecialchars($info['title']) ?></h2>
  <p>Rạp: <?= htmlspecialchars($info['cinema_name']) ?> - Phòng: <?= htmlspecialchars($info['room_number']) ?></p>
  <p>Ngày: <?= htmlspecialchars($info['show_date']) ?> - Giờ: <?= htmlspecialchars($info['show_time']) ?></p>
  <img src="<?= htmlspecialchars($info['image_url']) ?>" alt="Poster" style="max-width: 200px;">

  <h3>Sơ đồ ghế</h3>
  <div class="seating-container">
  <?php
    $stmt_seats = mysqli_prepare($conn, "
        SELECT id, seat_row, seat_number, seat_type, seat_status 
        FROM seats 
        WHERE room_id = ? 
        ORDER BY seat_row, seat_number
    ");
    mysqli_stmt_bind_param($stmt_seats, 'i', $room_id);
    mysqli_stmt_execute($stmt_seats);
    $seats_result = mysqli_stmt_get_result($stmt_seats);

    $current_row = '';
    while ($seat = mysqli_fetch_assoc($seats_result)) {
        $seat_row = $seat['seat_row'];
        $seat_number = (int)$seat['seat_number'];
        $seat_type = $seat['seat_type'];
        $seat_status = $seat['seat_status'];

        // Phân loại theo kiểu và trạng thái
        switch ($seat_type) {
            case 'Ghế đôi': $type_class = 'special'; break;
            case 'Ghế VIP': $type_class = 'vip'; break;
            default: $type_class = 'normal';
        }
        $status_class = ($seat_status === 'Ghế đã đặt') ? 'booked' : 'available';

        // Tạo dòng ghế mới
        if ($seat_row !== $current_row) {
            if ($current_row !== '') echo '</div>';
            echo "<div class='seat-row'><span class='row-label'>$seat_row</span>";
            $current_row = $seat_row;
        }

        // Tạo nút ghế
        $seat_code = htmlspecialchars($seat_row . $seat_number);
        $seat_class = "seat seat-$status_class seat-$type_class";
        if ($status_class === 'available') $seat_class .= ' seat-available';
        echo "<button class='$seat_class' data-row='$seat_row' data-number='$seat_number'>$seat_code</button>";
    }
    if ($current_row !== '') echo '</div>'; // đóng dòng cuối cùng
  ?>
  </div>
</div>

</body>
</html>

<?php include("footer.php"); ?>
