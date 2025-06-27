<?php  
include('header.php');
include('connect.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thanh toán</title>
  <link rel="stylesheet" href="CSS/thanhtoan.css">
</head>
<!-- Bỏ mũi tên trong input -->
<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
}
input[type=number] {
-moz-appearance: textfield;
}
</style>
<body>
  <div class="payment-container">
    <h2>Thanh toán</h2>

    <!-- Thông tin đặt vé -->
    <div class="warning-box">
      Bạn ơi, vé đã mua sẽ <strong>không thể hoàn, huỷ, đổi vé</strong>. Bạn nhớ kiểm tra kỹ thông tin nhé!
    </div>
    <div class="left-and-right">
      <div class="left-section">
        
        <div class="ticket-section">
          <!-- Thông tin vé -->
          <div class="ticket-infor">
            <img src="pic/Doraemon_Movie_2025_Poster.jpg" alt="Doraemon">
            <div class="ticket-details">
              <h4>CINETIX Tân Bình</h4>
              <p>Doraemon movie 44: Nobita và cuộc phiêu lưu vào thế giới trong tranh</p>
              <div class="ticket-info">
                <div><strong>Thời gian:</strong><br>17:00~18:45<br>Thứ bảy, 07/06/2025</div>
                <div><strong>Định dạng:</strong><br>2D Lồng tiếng</div>
                <div><strong>Phòng chiếu:</strong><br>Rạp số 5</div>
                <div><strong>Số ghế:</strong><br>E08</div>
              </div>
            </div>
          </div>
        </div>
        <!-- Combo và Tổng tiền -->
            <div class="combo-section">
              <h3>Combo bắp nước</h3>
              <div class="combo-box">
                <img src="pic/Doraemon_Movie_2025_Poster.jpg" alt="Combo">
                <div class="combo-info">
                  <div><strong>Combo 1 big</strong><br><small>Bắp caramel</small></div>
                  <div class="combo-price">89.000đ</div>
                </div>
                <div class="quantity-box">
                  <button class="minus">-</button>
                  <input type="number" value="1" min="0">
                  <button class="plus">+</button>
                </div>
              </div>
            </div>
      </div>
        <!-- Phương thức thanh toán -->
        <div class="payment">
          <div class="payment-methods">
            <h3>Phương thức thanh toán</h3>
            <label><input type="radio" name="payment" checked> <img src="#"> Thẻ ATM ( thẻ nội địa )</label><br>
            <label><input type="radio" name="payment"> <img src="#"> Thẻ quốc tế ( Visa, Master, Amex, JCB)</label><br>
            <label><input type="radio" name="payment"> <img src="#"> VNPay</label><br>
            <label><input type="radio" name="payment"> <img src="#"> Momo</label><br>
            <label><input type="radio" name="payment"> <img src="#"> ZaloPay</label>
          </div>
        </div>
    </div>
    <!-- Tổng tiền -->
      <div class="summary">
        <p class="total">Tạm tính: <strong>195.000đ</strong></p>
        <label class="terms">
          <input type="checkbox"> Tôi đồng ý với điều khoản sử dụng và mua vé cho người có độ tuổi phù hợp
        </label>
        <button class="confirm-btn">Xác nhận</button>
      </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/thanhtoan.js"></script>
</html>
<?php include('footer.php') ?>