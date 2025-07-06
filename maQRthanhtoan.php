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


// Gán session để xác nhận đã thanh toán
$_SESSION['paid_success'] = true;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>QR Thanh Toán</title>
  <link rel="stylesheet" href="CSS/maQRthanhtoan.css?v=2">
</head>
<body>
  <!-- Menu điều hướng dạng tab -->
  <nav class="nav-item">
    <a href="#" id="tab-home" class="active">THANH TOÁN</a>
    <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
    <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
    <a href="#" id="lien-he-tab">LIÊN HỆ</a>
  </nav>

  <div id="main-content">
    <div class="qr-container">
    <h2>Quét mã QR để thanh toán</h2>
    <img src="pic/qrcode-default.png" alt="Mã QR" style="max-width: 300px;">



    <form method="POST" action="thongTinVe.php">
      <input type="hidden" name="seats" value="<?= htmlspecialchars($seats) ?>">
      <input type="hidden" name="showtime_id" value="<?= htmlspecialchars($showtime_id) ?>">
      <input type="hidden" name="total_price" value="<?= htmlspecialchars($total_price) ?>">
      <input type="hidden" name="foods" value='<?= json_encode($foods) ?>'>
    </form>.    <form method="POST" action="thongTinVe.php">
      <input type="hidden" name="seats" value="<?= htmlspecialchars($seats) ?>">
      <input type="hidden" name="showtime_id" value="<?= htmlspecialchars($showtime_id) ?>">
      <input type="hidden" name="total_price" value="<?= htmlspecialchars($total_price) ?>">
      <input type="hidden" name="foods" value='<?= json_encode($foods) ?>'>
    </form>

      <script>
        setTimeout(function () {
          document.querySelector('form').submit();
        }, 5000);
      </script>
    </div>
  </div>

  <!-- Các vùng nội dung động giống Home -->
  <div id="rap-cinetix-content" style="display:none;"></div>
  <div id="gia-ve-content" style="display:none;"></div>
  <div id="lien-he-content" style="display:none;"></div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/Home.js"></script>
  <script src="js/rolltab.js"></script>
</body>
</html>
<?php include('footer.php'); ?>
