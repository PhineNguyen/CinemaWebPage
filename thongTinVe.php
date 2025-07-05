<?php session_start();
//$_SESSION['paid_success'] = true; //Gán biến xác nhận thanh toán thành công
include('header.php');
include('connect.php');


$seats = $_POST['seats'] ?? '';
$showtime_id = $_POST['showtime_id'] ?? '';
$total_price = $_POST['total_price'] ?? 0;
$foods = $_SESSION['foods'] ?? [];  // nếu muốn lưu lại
 if(is_string($foods)){
  $foods = json_decode($foods, true);
 }echo '<pre>';
print_r($_POST);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <?php
        $sql = "SELECT 
                  ci.ci_name AS rap,
                  mv.title AS ten_phim,
                  mv.image_url AS poster,
                  mv.lgs AS dinh_dang,
                  t.ticket_code AS ma_ve,
                  DATE_FORMAT(st.show_time, '%H:%i') AS gio_bat_dau,
                  DATE_FORMAT(st.show_date, '%d/%m/%Y') AS ngay_chieu,
                  rm.room_number AS phong_chieu,
                  s.id AS so_ghe
                FROM tickets t
                JOIN booking_details bd ON t.booking_detail_id = bd.id
                JOIN seats s ON bd.seat_id = s.id
                JOIN bookings b ON bd.booking_id = b.id
                JOIN showtimes st ON b.showtime_id = st.id
                JOIN movies mv ON st.movie_id = mv.id
                JOIN rooms rm ON st.room_id = rm.id
                JOIN cinemas ci ON rm.cinema_id = ci.id
                LIMIT 1";

        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
      ?>
      <div class="ticket-header">
        <div class="cinema-info">
          <!--<img src="pic/Doraemon_Movie_2025_Poster.jpg" alt="Logo Cinetix" class="cinema-logo">-->
          <div>
            <h3><?php echo htmlspecialchars($row['rap']); ?></h3>
            <p class="movie-title"><?php echo htmlspecialchars($row['ten_phim']); ?></p>
            <small><?php echo htmlspecialchars($row['dinh_dang']); ?></small>
          </div>
        </div>
        <div class="ticket-actions">
          <i class="fa-solid fa-download"></i>
          <i class="fa-solid fa-share-from-square"></i>
        </div>
      </div>

      <div class="ticket-body">
        <img src="<?php echo htmlspecialchars($row['poster']); ?>" alt="Poster phim" class="poster">

        <div class="ticket-details">
          <p><strong>Mã đặt vé:</strong> <span class="code"><?php echo $row['ma_ve']; ?></span></p>
          <p><strong>Thời gian:</strong> <span class="time"><?php echo $row['gio_bat_dau']; ?></span></p>
          <p><?php echo $row['ngay_chieu']; ?></p>
          <p><strong>Phòng chiếu:</strong> <?php echo htmlspecialchars($row['phong_chieu']); ?></p>
          <p><strong>Số ghế:</strong> <?php echo htmlspecialchars($row['so_ghe']); ?></p>
          <p><strong>Số vé:</strong> 01</p>
          <p><strong>Giá vé:</strong> <span class="price"><?php echo number_format($total_price, 0, ',', '.'); ?>đ</span></p>
          <small class="note">Đưa mã này cho nhân viên soát vé để nhận vé vào rạp</small>
        </div>

        <div class="qr-section">
          <img src="pic/qrcode-default.png" alt="QR code" class="qr-code">
        </div>
      </div>
      <?php
          }
        } else {
          echo "<p>Không có vé nào được tìm thấy.</p>";
        }
      ?>
    </div>
  </div>
</body>
<script>
  const TOTAL = "<?= htmlspecialchars($total_price) ?>";
  const SEATS = "<?= htmlspecialchars($seats) ?>";
  const SHOWTIME_ID = "<?= htmlspecialchars($showtime_id) ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/thongTinVe.js"></script>
</html>
<?php include('footer.php') ?>
