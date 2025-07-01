<?php
    include('connect.php');
    include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã QR</title>
    <link rel="stylesheet" href="CSS/maQRthanhtoan.css">
</head>
<body>
    <div class="qr-popup">
        <div class="qr-box">
            <button class="close-btn" onclick="closeQR()">x</button>
            <p >Quét mã bên dưới để thanh toán</p>
            <img src="pic/qrcode-default.png" alt="QR Code" class="qr-img">
            <p class="timer"></p>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/maQRthanhtoan.js"></script>
</html>
<?php
    include('footer.php');
?>