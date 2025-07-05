<?php
session_start();
include('header.php');
include('connect.php');

$seats = $_POST['seats'] ?? '';
$showtime_id = $_POST['showtime_id'] ?? '';
$total_price = $_POST['total_price'] ?? 0;
$foods = $_SESSION['foods'] ?? [];

if (is_string($foods)) {
    $foods = json_decode($foods, true);
}

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

// Tạo mã vé và số ghế hiển thị
$ma_ve = strtoupper(uniqid('V'));
$so_ghe = is_array($seats) ? implode(', ', $seats) : $seats;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thanh toán thành công</title>
  <link rel="stylesheet" href="CSS/thongTinVe.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    <p class="description">Bạn đã đặt vé online thành công. CINETIX Cinema xin chân thành cảm ơn bạn. Thông tin vé của bạn ở bên dưới:</p>

    <div class="ticket-card">
      <div class="ticket-header">
        <div class="cinema-info">
          <div>
            <h3><?= htmlspecialchars($showtimeInfo['rap'] ?? 'Tên rạp') ?></h3>
            <p class="movie-title"><?= htmlspecialchars($showtimeInfo['ten_phim'] ?? 'Tên phim') ?></p>
            <small><?= htmlspecialchars($showtimeInfo['dinh_dang'] ?? '') ?></small>
          </div>
        </div>
        <div class="ticket-actions">
          <i class="fa-solid fa-download"></i>
          <i class="fa-solid fa-share-from-square"></i>
        </div>
      </div>

      <div class="ticket-body">
        <img src="<?= htmlspecialchars($showtimeInfo['poster'] ?? 'pic/default-poster.jpg') ?>" alt="Poster phim" class="poster">

        <div class="ticket-details">
          <p><strong>Mã đặt vé:</strong> <span class="code"><?= $ma_ve ?></span></p>
          <p><strong>Thời gian:</strong> <span class="time"><?= htmlspecialchars($showtimeInfo['show_time'] ?? '') ?></span></p>
          <p><?= htmlspecialchars($showtimeInfo['show_date'] ?? '') ?></p>
          <p><strong>Phòng chiếu:</strong> <?= htmlspecialchars($showtimeInfo['phong_chieu'] ?? '') ?></p>
          <p><strong>Số ghế:</strong> <?= htmlspecialchars($so_ghe) ?></p>
          <p><strong>Số vé:</strong> <?= is_array($seats) ? count($seats) : 1 ?></p>
          <p><strong>Giá vé:</strong> <span class="price"><?= number_format($total_price, 0, ',', '.') ?>đ</span></p>
          <small class="note">Đưa mã này cho nhân viên soát vé để nhận vé vào rạp</small>
        </div>

        <div class="qr-section">
          <img src="pic/qrcode-default.png" alt="QR code" class="qr-code">
        </div>
      </div>
    </div>
  </div>

<script>
  const TOTAL = "<?= htmlspecialchars($total_price) ?>";
  const SEATS = "<?= htmlspecialchars(is_array($seats) ? implode(',', $seats) : $seats) ?>";
  const SHOWTIME_ID = "<?= htmlspecialchars($showtime_id) ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/thongTinVe.js"></script>
</body>
</html>
<?php include('footer.php') ?>
