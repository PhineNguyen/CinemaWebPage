<?php
include('header.php');
include('connect.php');
session_start();
// Kiểm tra nếu đã thanh toán thành công, chuyển hướng về trang chủ
if (isset($_SESSION['paid_success']) && $_SESSION['paid_success'] === true) {
    unset($_SESSION['paid_success']); // Hủy session 
    header("Location: Home.php");
}
$foods = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['foods'])) {
    $foods = json_decode($_POST['foods'], true);
    $_SESSION['foods'] = $foods; // nếu muốn lưu lại
}
// Thông tin ghế và suất chiếu từ Post (chonbapnuoc.js)
$seats = $_POST['seats'] ?? '';
$showtime_id = $_POST['showtime_id'] ?? '';
$total_price = $_POST['total_price'] ?? 0;
// Tính tổng tiền combo/bắp nước
$totalFood = 0;
if (!empty($foods)) {
    foreach ($foods as $item) {
        if (!empty($item['price']) && !empty($item['qty'])) {
            $totalFood += $item['price'] * $item['qty'];
        }
    }
}
echo'<pre>';
print_r($_POST);
echo '</pre>';
// Tổng tiền cuối cùng
$total_price = (float)$total_price; // ép kiểu chắc chắn
$totalAmount = $total_price + $totalFood;


// Lấy thông tin suất chiếu từ showtime_id
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
          <?php if (!empty($showtimeInfo)): ?>
            <div class="ticket-infor">
              <img src="<?php echo htmlspecialchars($showtimeInfo['poster']); ?>" alt="<?php echo htmlspecialchars($showtimeInfo['ten_phim']); ?>">
              <div class="ticket-details">
                <h4><?php echo htmlspecialchars($showtimeInfo['rap']); ?></h4>
                <p><?php echo htmlspecialchars($showtimeInfo['ten_phim']); ?></p>
                <div class="ticket-info">
                  <div><strong>Thời gian:</strong><br>
                    <?php 
                      echo date('H:i', strtotime($showtimeInfo['show_time'])) . "<br>" . date('d/m/Y', strtotime($showtimeInfo['show_date']));
                    ?>
                  </div>
                  <div><strong>Định dạng:</strong><br><?php echo htmlspecialchars($showtimeInfo['dinh_dang']); ?></div>
                  <div><strong>Phòng chiếu:</strong><br><?php echo htmlspecialchars($showtimeInfo['phong_chieu']); ?></div>
                  <div><strong>Số ghế:</strong><br><?php echo htmlspecialchars($seats); ?></div>
                </div>
              </div>
            </div>
          <?php else: ?>
            <p>Không có thông tin suất chiếu.</p>
          <?php endif; ?>
        </div>

        <!-- Combo -->
        <div class="combo-section">
          <h3>Combo bắp nước</h3>
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
    <div class="summary" data-ticket-price="<?php echo $totalAmount; ?>">
  <p class="total">Tạm tính: <strong id="total-amount">
    <?php echo number_format($totalAmount, 0, ',', '.') . 'đ'; ?>
  </strong></p>

      <label class="terms">
        <input type="checkbox" id="agreeTerms"> Tôi đồng ý với điều khoản sử dụng và mua vé cho người có độ tuổi phù hợp
      </label>
      <div class="button-row">
        <button class="back-btn">Quay lại</button>
        <button class="confirm-btn" id="confirmBtn"  disabled>Xác nhận</button>
      </div>
    </div>
  </div>
</body>
<script>
  const TOTAL = "<?= htmlspecialchars($total_price) ?>";
  const SEATS = "<?= htmlspecialchars($seats) ?>";
  const SHOWTIME_ID = "<?= htmlspecialchars($showtime_id) ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/thanhtoan.js"></script>
</html>
<?php include('footer.php') ?>