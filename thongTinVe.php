<?php include('header.php') ?>
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
  <div class="success-container">
    <h1><i class="fa-solid fa-circle-check"style="color: #00cc66;"></i></h1>
    <h1>THANH TOÁN THÀNH CÔNG!</h1>
    <p class="description">Bạn đã đặt vé online thành công. CINETIX Cinema xin chân thành cảm ơn bạn. Thông tin vé của bạn ở bên dưới:</p>

    <div class="ticket-card">
      <div class="ticket-header">
        <div class="cinema-info">
          <img src="pic/Doraemon_Movie_2025_Poster.jpg" alt="Logo Cinetix" class="cinema-logo">
          <div>
            <h3>CINETIX Tân Bình</h3>
            <p class="movie-title">Doraemon movie 44: Nobita và cuộc phiêu lưu vào thế giới trong tranh</p>
            <small>2D Lồng tiếng</small>
          </div>
        </div>
        <div class="ticket-actions">
          <i class="fa-solid fa-download"></i>
          <i class="fa-solid fa-share-from-square"></i>
        </div>
      </div>

      <div class="ticket-body">
        <img src="pic/Doraemon_Movie_2025_Poster.jpg" alt="Poster phim" class="poster">

        <div class="ticket-details">
          <p><strong>Mã đặt vé:</strong> <span class="code">K8315NA9</span></p>
          <p><strong>Thời gian:</strong> <span class="time">17:00~18:45</span></p>
          <p><strong>Thứ bảy,</strong> 07/06/2025</p>
          <p><strong>Phòng chiếu:</strong> <strong>Rạp số 5</strong></p>
          <p><strong>Số ghế:</strong> E08</p>
          <p><strong>Số vé:</strong> 01</p>
          <small class="note">Đưa mã này cho nhân viên soát vé để nhận vé vào rạp</small>
        </div>

        <div class="qr-section">
          <img src="pic/qrcode-default.png" alt="QR code" class="qr-code">
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php include('footer.php') ?>
