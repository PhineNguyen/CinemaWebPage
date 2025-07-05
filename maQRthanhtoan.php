<?php
session_start();
include('header.php');
include('connect.php');

// Nhận dữ liệu từ POST

$ticket_infor = $_POST['ticket_infor'] ?? '';
$seats = $_POST['seats'] ?? '';
$showtime_id = $_POST['showtime_id'] ?? '';
$total_price = $_POST['total_price'] ?? 0;
$foods = $_SESSION['foods'] ?? [];  // nếu muốn lưu lại
 if(is_string($foods)){
  $foods = json_decode($foods, true);
 }
echo '<pre>';
print_r($_POST);
print_r($_SESSION);
echo '</pre>';

// Gán session để xác nhận đã thanh toán
$_SESSION['paid_success'] = true;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>QR Thanh Toán</title>
  <link rel="stylesheet" href="CSS/maQRthanhtoan.css">
</head>
<body>
  <nav class="nav-item">
    <a href="home.php">PHIM</a>
    <a href="rapCinetix.php">RẠP CINETIX</a>
    <a href="giave.php">GIÁ VÉ</a>
    <a href="lienhe.php">LIÊN HỆ</a>
  </nav>

  <div>

    <h2>Quét mã QR để thanh toán</h2>
    <!-- <img src="pic/qrcode-default.png" alt="Mã QR" style="max-width: 300px;"> -->
    <?php 
    if (!empty($foods)) {
            foreach ($foods as $item) {
                echo '<div class="combo-box">';
                if (!empty($item['name'])) {
                    echo '<strong>' . htmlspecialchars($item['name']) . '</strong> ';
                }
                if (!empty($item['qty'])) {
                    echo 'x' . intval($item['qty']);
                }
                if (!empty($item['flavor'])) {
                    echo ' - Vị: ' . htmlspecialchars($item['flavor']);
                }
                if (!empty($item['size']) && is_array($item['size']) && count($item['size']) > 0) {
                    echo ' - Size: ' . implode(', ', array_map('htmlspecialchars', $item['size']));
                }
                echo '</div>';
            }
          } else {
              echo "<p>Không có combo/bắp/nước nào được chọn.</p>";
          }
?>
    <p class="timer" style="font-size: 20px; color: red;">0:05</p>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script  src="js/maQRthanhtoan.js"></script> 
</body>
</html>
<?php include('footer.php'); ?>
