<?php  
include('header.php');
include('connect.php');
session_start();
// Kiểm tra nếu đã thanh toán thành công, chuyển hướng về trang chủ
if (isset($_SESSION['paid_success']) && $_SESSION['paid_success'] === true) {
    unset($_SESSION['paid_success']); // Hủy session 
    header("Location: Home.php");
}

// Lấy giá vé
$sql = "SELECT total_amount FROM bookings WHERE id = 5";
$result = $conn->query($sql);
$ticketPrice = 0;
if ($row = $result->fetch_assoc()) {
    $ticketPrice = $row['total_amount'];}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thanh toán</title>
  <link rel="stylesheet" href="CSS/thanhtoan.css">
</head>

<body>
  <nav class="nav-item">
    <a href="home.php">PHIM</a>
    <a href="rapCinetix.php">RẠP CINETIX</a>
    <a href="giave.php">GIÁ VÉ</a>
    <a href="lienhe.php">LIÊN HỆ</a>
  </nav>
  
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
          <?php
            $sql = "SELECT 
                      ci.ci_name AS rap,
                      mv.title AS ten_phim,
                      mv.image_url AS poster,
                      DATE_FORMAT(st.show_time, '%H:%i') AS gio_bat_dau,
                      DATE_FORMAT(st.show_date, '%d/%m/%Y') AS ngay_chieu,
                      mv.lgs AS dinh_dang,
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
            <div class="ticket-infor">
              <img src="<?php echo htmlspecialchars($row['poster']); ?>" alt="<?php echo htmlspecialchars($row['ten_phim']); ?>">
              <div class="ticket-details">
                <h4><?php echo htmlspecialchars($row['rap']); ?></h4>
                <p><?php echo htmlspecialchars($row['ten_phim']); ?></p>
                <div class="ticket-info">
                  <div><strong>Thời gian:</strong><br><?php echo $row['gio_bat_dau']; ?><br><?php echo $row['ngay_chieu']; ?></div>
                  <div><strong>Định dạng:</strong><br><?php echo htmlspecialchars($row['dinh_dang']); ?></div>
                  <div><strong>Phòng chiếu:</strong><br><?php echo htmlspecialchars($row['phong_chieu']); ?></div>
                  <div><strong>Số ghế:</strong><br><?php echo htmlspecialchars($row['so_ghe']); ?></div>
                </div>
              </div>
            </div>
          <?php
              }
            } else {
              echo "<p>Không có vé nào được tìm thấy.</p>";
            }
          ?>
        </div>

        <!-- Combo -->
            <div class="combo-section">
              <h3>Combo bắp nước</h3>
              <?php
              $sql = "
                  SELECT 
                      b.id AS booking_id,
                      f.namef AS combo_name,
                      f.food_images,
                      f.price,
                      f.descript,
                      fo.quantity,
                      (fo.quantity * f.price) AS total_price
                  FROM bookings b
                  JOIN food_orders fo ON b.id = fo.booking_id
                  JOIN foods f ON fo.food_id = f.id
                  GROUP BY b.id
                  LIMIT 1 OFFSET 3
              ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="combo-box" data-price="<?php echo $row['price']; ?>">
                      <img src="<?php echo $row['food_images']; ?>" alt="Combo">
                      <div class="combo-info">
                        <div>
                          <strong><?php echo htmlspecialchars($row['combo_name']); ?></strong><br>
                          <small><?php echo $row['descript']; ?></small>
                        </div>
                        <div class="combo-price"><?php echo number_format($row['price'], 0, ',', '.'); ?>đ</div>
                      </div>
                      <div class="quantity-box">
                        <button class="minus">-</button>
                        <div class="quantity-display"><?php echo $row['quantity']; ?></div>
                        <button class="plus">+</button>
                      </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<p>Không có combo nào được đặt.</p>";
                }
              ?>
            </div>
      </div>
        <!-- Phương thức thanh toán -->
        <div class="payment">
          <div class="payment-methods">
            <h3>Phương thức thanh toán</h3>
            <label><input type="radio" name="payment" checked>Thẻ ATM ( thẻ nội địa )</label><br>
            <label><input type="radio" name="payment"> Thẻ quốc tế ( Visa, Master, Amex, JCB)</label><br>
            <label><input type="radio" name="payment"> VNPay</label><br>
            <label><input type="radio" name="payment"> Momo</label><br>
            <label><input type="radio" name="payment"> ZaloPay</label>
          </div>
        </div>
    </div>
    <!-- Tổng tiền -->
    <div class="summary" data-ticket-price="<?php echo $ticketPrice; ?>">
      <p class="total">Tạm tính: <strong id="total-amount">0đ</strong></p>
      <label class="terms">
        <input type="checkbox" id="agreeTerms"> Tôi đồng ý với điều khoản sử dụng và mua vé cho người có độ tuổi phù hợp
      </label>
      <div class="button-row">
        <button class="back-btn">Quay lại</button>
        <button class="confirm-btn" id="confirmBtn" disabled>Xác nhận</button>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/thanhtoan.js"></script>
</html>
<?php include('footer.php') ?>