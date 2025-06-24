<?php  include('header.php') ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thanh toán vé</title>
  <link rel="stylesheet" href="CSS/thanhtoan.css">
</head>
<body style="background-color: black">
  <div class="payment-container">
    <h2>Thanh toán</h2>
    <div class="main-content">
      <div class="ticket-info">
        <h3>Thông tin đặt vé</h3>
        <div class="ticket-card">
          <img src="#" alt="Poster phim">
          <div class="ticket-details">
            <p class="note"><strong>Lưu ý:</strong> Đã mua sẽ <strong>không thể hoàn, hủy, đổi</strong>.</p>
            <p><strong>Rạp:</strong> CINETIX Tân Bình</p>
            <p><strong>Phim:</strong> Doraemon movie 46: Nobita và cuộc phiêu lưu vào thế giới trong tranh</p>
            <p><strong>Thời gian:</strong> 17:00 - 18:45, Thứ ba, 07/06/2025</p>
            <p><strong>Phòng chiếu:</strong> 5</p>
            <p><strong>Ghế:</strong> E08</p>
            <p><strong>Định dạng:</strong> 2D Lồng tiếng</p>
          </div>
        </div>

        <div class="combo">
          <h4>Combo bắp nước</h4>
          <div class="combo-item">
            <img src="#" alt="Combo bắp nước">
            <div class="combo-details">
              <p><strong>Combo 1 big</strong></p>
              <p>Bắp caramel</p>
              <p><strong>89.000đ</strong></p>
              <div class="quantity">
                <button>-</button>
                <span>1</span>
                <button>+</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="payment-method">
        <h3>Phương thức thanh toán</h3>
        <form>
          <label><input type="radio" name="payment"> Thẻ ATM (thẻ nội địa)</label>
          <label><input type="radio" name="payment"> Thẻ quốc tế (Visa, Master, Amex, JCB)</label>
          <label><input type="radio" name="payment"> VNPay</label>
          <label><input type="radio" name="payment"> Momo</label>
          <label><input type="radio" name="payment"> ZaloPay</label>

          <div class="total">
            <p><strong>Tạm tính:</strong> 195.000đ</p>
          </div>

          <label class="checkbox">
            <input type="checkbox"> Tôi đồng ý với điều khoản sử dụng và mua vé cho người có độ tuổi phù hợp
          </label>

          <button type="submit" class="confirm-btn">Xác nhận</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
<?php include('footer.php') ?>