<?php
session_start();
include('connect.php');
header('Content-Type: text/html; charset=utf-8');

// Lấy user_id từ session (tùy session lưu là id hay user_id)
$user_id = 0;
if (isset($_SESSION['user']['id'])) {
    $user_id = intval($_SESSION['user']['id']);
} elseif (isset($_SESSION['user']['user_id'])) {
    $user_id = intval($_SESSION['user']['user_id']);
}

// Lấy tên người dùng
$username = 'Người vô danh';
if ($user_id > 0) {
    $sql = "SELECT user_name FROM users WHERE id = $user_id LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        $username = htmlspecialchars($row['user_name']);
    }
}

// Lấy lịch sử booking
$bookings = [];
if ($user_id > 0) {
    $sql = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY booking_time DESC";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }
}

// Lấy chi tiết booking đầu tiên (nếu có)
$selected_booking = (count($bookings) > 0) ? $bookings[0] : null;
$booking_details = [];
if ($selected_booking) {
    $booking_id = intval($selected_booking['id']);
    $sql = "SELECT seat_id FROM booking_details WHERE booking_id = $booking_id";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $booking_details[] = $row['seat_id'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lịch sử giao dịch</title>
  <link rel="stylesheet" href="CSS/lichsu.css" />
</head>
<body>
  <div class="history-modal-bg" id="history-modal-bg">
    <div class="history-modal" id="history-modal">
      <div class="history-header">LỊCH SỬ GIAO DỊCH</div>
      <div class="history-content">
        <div class="history-left">
          <div class="history-avatar"></div>
          <div class="history-username">Xin chào <?php echo $username; ?></div>
          <div class="history-list">
            <?php if (count($bookings) > 0): ?>
              <?php foreach ($bookings as $idx => $booking): ?>
                <div class="history-list-item<?php if ($idx === 0) echo ' active'; ?>">
                  <div class="history-list-date"><?php echo date('j/n/Y', strtotime($booking['booking_time'])); ?></div>
                  <div class="history-list-movie<?php if ($idx === 0) echo ' highlight'; ?>">
                    Suất chiếu: <?php echo htmlspecialchars($booking['showtime_id']); ?> <br/>
                    <span class="history-list-id">Mã giao dịch: <?php echo $booking['id']; ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="history-list-empty">Không có giao dịch nào</div>
            <?php endif; ?>
          </div>
        </div>
        <div class="history-divider"></div>
        <div class="history-right">
          <?php if ($selected_booking): ?>
            <div class="history-info">
              <div>Ngày: <?php echo date('j/n/Y', strtotime($selected_booking['booking_time'])); ?></div>
              <div>Mã giao dịch: <?php echo $selected_booking['id']; ?></div>
              <div>Tổng tiền: <?php echo number_format($selected_booking['total_amount'], 0, ',', '.'); ?> VNĐ</div>
              <div>Trạng thái: <?php echo htmlspecialchars($selected_booking['status']); ?></div>
              <div>Suất chiếu: <?php echo htmlspecialchars($selected_booking['showtime_id']); ?></div>
              <div>Ghế: <?php echo implode(', ', $booking_details); ?></div>
            </div>
          <?php else: ?>
            <div class="history-empty">Không có chi tiết giao dịch nào</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('history-modal-bg').onclick = function(e) {
      if (e.target === this) this.style.display = 'none';
    };
  </script>
</body>
</html>
