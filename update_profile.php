<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_name = $_POST['name'] ?? '';
  $new_phone = $_POST['phone'] ?? '';
  $new_email = $_POST['email'] ?? '';

  // Kiểm tra dữ liệu 
  if (empty($new_name) || empty($new_phone) || empty($new_email)) {
    $_SESSION['update_message'] = "<span style='color:red;'>Vui lòng điền đầy đủ thông tin.</span>";
    header("Location: infor_admin.php");
    exit;
  }

  $sql = "UPDATE users SET user_name = ?, phone_number = ?, email = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $new_name, $new_phone, $new_email, $user_id);

  if ($stmt->execute()) {
    // Cập nhật lại session nếu tên người dùng thay đổi
    $_SESSION['user']['user_name'] = $new_name;
    header("Location: Home.php");
    exit;
  } else {
    $_SESSION['update_message'] = "<span style='color:red;'>Cập nhật thất bại. Vui lòng thử lại.</span>";
    header("Location: infor_admin.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Cập nhật tài khoản</title>
  <link rel="stylesheet" href="CSS/infor_admin.css">
</head>
<body>
<!-- Lịch sử đặt vé -->
<div class="booking-history-section">
  <button class="toggle-history-btn" onclick="toggleBookingHistory()">Lịch sử đặt vé</button>
  <div id="booking-history-content" style="display:none; margin-top:20px;">
    <?php
    // Lấy lịch sử booking
    $bookings = [];
    $sql = "SELECT * FROM bookings WHERE user_id = ? ORDER BY booking_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $bookings[] = $row;
    }
    if (count($bookings) > 0): ?>
      <table class="booking-history-table">
        <thead>
          <tr>
            <th>Mã giao dịch</th>
            <th>Ngày đặt</th>
            <th>Suất chiếu</th>
            <th>Ghế</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $booking):
          // Lấy danh sách ghế cho booking này
          $seats = [];
          $sql2 = "SELECT seat_id FROM booking_details WHERE booking_id = ?";
          $stmt2 = $conn->prepare($sql2);
          $stmt2->bind_param("s", $booking['id']);
          $stmt2->execute();
          $result2 = $stmt2->get_result();
          while ($row2 = $result2->fetch_assoc()) {
            $seats[] = $row2['seat_id'];
          }
        ?>
          <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo date('d/m/Y H:i', strtotime($booking['booking_time'])); ?></td>
            <td><?php echo htmlspecialchars($booking['showtime_id']); ?></td>
            <td><?php echo implode(', ', $seats); ?></td>
            <td><?php echo number_format($booking['total_amount'], 0, ',', '.'); ?> VNĐ</td>
            <td><?php echo htmlspecialchars($booking['status']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="no-history-message">Bạn chưa có lịch sử đặt vé nào.</div>
    <?php endif; ?>
  </div>
</div>
<script>
function toggleBookingHistory() {
  var content = document.getElementById('booking-history-content');
  content.style.display = (content.style.display === 'none' || content.style.display === '') ? 'block' : 'none';
}
</script>
</body>
</html>
