<?php
session_start();
include('header.php');
include('connect.php');

// Nhận dữ liệu từ POST & SESSION
$seats = $_POST['seats'] ?? '';
$showtime_id = $_POST['showtime_id'] ?? '';
$total_price = $_POST['total_price'] ?? 0;
$total_price = (int)$total_price;
$foods = $_SESSION['foods'] ?? [];

// Chuẩn hóa mảng combo
if (is_string($foods)) {
    $foods = json_decode($foods, true);
}

// Lấy thông tin suất chiếu
$showtimeInfo = [];
if ($showtime_id) {
    $sql = "SELECT 
                st.show_time, 
                st.show_date, 
                mv.title AS ten_phim, 
                mv.image_url AS poster, 
                mv.lgs AS dinh_dang, 
                rm.room_number AS phong_chieu, 
                ci.ci_name AS rap
            FROM showtimes st
            JOIN movies mv ON st.movie_id = mv.id
            JOIN rooms rm ON st.room_id = rm.id
            JOIN cinemas ci ON rm.cinema_id = ci.id
            WHERE st.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $showtime_id);
    $stmt->execute();
    $resultShow = $stmt->get_result();
    if ($resultShow && $resultShow->num_rows > 0) {
        $showtimeInfo = $resultShow->fetch_assoc();
    }
}

// Tính mã vé và số vé
$ma_ve = 'V' . strtoupper(bin2hex(random_bytes(4)));

// Chuẩn hóa số ghế
if (is_string($seats)) {
    $seats = array_filter(array_map('trim', explode(',', $seats)));
} elseif (!is_array($seats)) {
    $seats = [];
}
$so_ghe = implode(', ', $seats);
$so_ve = count($seats);

// Sinh QR code
$qr_data = urlencode("Mã vé: $ma_ve\nPhim: " . $showtimeInfo['ten_phim'] . "\nGhế: $so_ghe\nThời gian: " . $showtimeInfo['show_time']);
$qr_url = "https://api.qrserver.com/v1/create-qr-code/?data=$qr_data&size=150x150";

// Ghi thông tin vé vào CSDL
$checkSql = "SELECT id FROM showtimes WHERE id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("s", $showtime_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult && $checkResult->num_rows > 0) {
    // Ghi thông tin vé vào bảng tickets
    $sqlInsert = "INSERT INTO tickets (ticket_code, showtime_id, seats, quantity, total_price, issue_time) 
                  VALUES (?, ?, ?, ?, ?, NOW())";
    $stmtInsert = $conn->prepare($sqlInsert);

    if ($stmtInsert) {
        $stmtInsert->bind_param("sssii", $ma_ve, $showtime_id, $so_ghe, $so_ve, $total_price);
        if (!$stmtInsert->execute()) {
            echo "❌ Lỗi khi ghi vé vào CSDL: " . $stmtInsert->error;
        }
        $stmtInsert->close();
    } else {
        echo "❌ Lỗi prepare INSERT tickets: " . $conn->error;
    }
} else {
    echo "❌ Không tìm thấy suất chiếu với ID: $showtime_id";
}
$checkStmt->close();

// Ghi combo đồ ăn vào bảng food_order
if (!empty($foods)) {
    foreach ($foods as $food) {
        $food_id = $food['id'] ?? null;
        $quantity = $food['quantity'] ?? 0;

        if ($food_id && $quantity > 0) {
            $sqlFood = "INSERT INTO food_order (booking_id, food_id, quantity) VALUES (?, ?, ?)";
            $stmtFood = $conn->prepare($sqlFood);
            if ($stmtFood) {
                $stmtFood->bind_param("sii", $ma_ve, $food_id, $quantity);
                if (!$stmtFood->execute()) {
                    echo "❌ Lỗi khi ghi combo vào food_order: " . $stmtFood->error;
                }
                $stmtFood->close();
            } else {
                echo "❌ Lỗi prepare INSERT food_order: " . $conn->error;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thanh toán thành công</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CSS/thongTinVe.css?v=2.1">
</head>
<body>

<nav class="nav-item">
  <a href="home.php">PHIM</a>
  <a href="rapCinetix.php">RẠP CINETIX</a>
  <a href="giave.php">GIÁ VÉ</a>
  <a href="lienhe.php">LIÊN HỆ</a>
</nav>

<div class="success-container">
  <h1><i class="fa-solid fa-circle-check" style="color: #00cc66;"></i></h1>
  <h1>THANH TOÁN THÀNH CÔNG!</h1>
  <p class="description">Bạn đã đặt vé online thành công. CINETIX Cinema xin chân thành cảm ơn bạn.</p>

  <div class="ticket-card">
    <div class="ticket-header-full">
      <div class="ticket-header-content">
        <div class="header-left">
          <img src="pic/Logo_cinetix.png" alt="Logo" class="logo">
          <div class="header-info">
            <h3><?= htmlspecialchars($showtimeInfo['rap'] ?? 'Tên rạp') ?></h3>
            <p class="movie-title"><?= htmlspecialchars($showtimeInfo['ten_phim'] ?? 'Tên phim') ?></p>
          </div>
        </div>
        <div class="ticket-actions">
          <i class="fa-solid fa-share-from-square"></i>
          <i class="fa-solid fa-download" onclick="window.print()"></i>
        </div>
      </div>
    </div>

    <div class="ticket-body">
      <img src="<?= htmlspecialchars($showtimeInfo['poster'] ?? 'pic/default-poster.jpg') ?>" class="poster" alt="Poster phim">

      <div class="ticket-details">
        <p><strong>Mã đặt vé:</strong> <?= $ma_ve ?></p>
        <p><strong>Thời gian:</strong> <?= htmlspecialchars($showtimeInfo['show_time'] ?? '') ?></p>
        <p><strong>Ngày:</strong> <?= htmlspecialchars($showtimeInfo['show_date'] ?? '') ?></p>
        <p><strong>Phòng chiếu:</strong> <?= htmlspecialchars($showtimeInfo['phong_chieu'] ?? '') ?></p>
        <p><strong>Số ghế:</strong> <?= htmlspecialchars($so_ghe) ?></p>
        <p><strong>Số vé:</strong> <?= $so_ve ?></p>
        <p><strong>Giá vé:</strong> <span class="price"><?= number_format($total_price, 0, ',', '.') ?>đ</span></p>
        <p class="note">Đưa mã này cho nhân viên soát vé để nhận vé vào rạp</p>
      </div>

      <div class="qr-section">
        <img src="<?= $qr_url ?>" alt="QR code" class="qr-code">
      </div>
    </div>
  </div>
</div>

</body>
</html>

<?php include('footer.php'); ?>
