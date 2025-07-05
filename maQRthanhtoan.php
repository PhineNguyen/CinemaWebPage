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
  <link rel="stylesheet" href="CSS/maQRthanhtoan.css">
</head>
<body>
  <nav class="nav-item">
    <a href="home.php">PHIM</a>
    <a href="rapCinetix.php">RẠP CINETIX</a>
    <a href="giave.php">GIÁ VÉ</a>
    <a href="lienhe.php">LIÊN HỆ</a>
  </nav>

  <div class="qr-container">
    <h2>Quét mã QR để thanh toán</h2>
    <img src="pic/qrcode-default.png" alt="Mã QR" style="max-width: 300px;">

    <p><strong>Ghế:</strong> <?= htmlspecialchars($seats) ?></p>
    <p><strong>Tổng tiền:</strong> <?= number_format($total_price, 0, ',', '.') ?>đ</p>

    <?php if (!empty($foods)): ?>
      <div>
        <h3>Combo đã chọn:</h3>
        <ul>
        <?php foreach ($foods as $item): ?>
          <li>
            <?= htmlspecialchars($item['name'] ?? ''); ?>
            x<?= intval($item['qty'] ?? 0); ?>
            <?= !empty($item['flavor']) ? ' - Vị: ' . htmlspecialchars($item['flavor']) : ''; ?>
            <?= !empty($item['size']) && is_array($item['size']) ? ' - Size: ' . implode(', ', array_map('htmlspecialchars', $item['size'])) : ''; ?>
          </li>
        <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

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
</body>
</html>
<?php include('footer.php'); ?>
