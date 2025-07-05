<?php
session_start();

// Kiểm tra đăng nhập và vai trò admin
if (!isset($_SESSION['user']) || $_SESSION['ro_lo'] !== 'admin') {
    header("Location: admin_login.php");
    exit();
}

include('../connect.php');
include('header_admin.php');

?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang quản trị</title>
  <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
  <link rel="stylesheet" href="../admin/adminCSS/header_admin.css"> 
  <link rel="stylesheet" href="../admin/adminCSS/admin.css">
</head>
<body>
<div class="admin-layout">
  <aside class="sidebar">
    <?php include('sidebar_admin.php'); ?>
  </aside>

  <?php
  $month = date('m');
  $year = date('Y');

  // Tổng vé bán ra trong tháng
  $sql_tickets = "SELECT COUNT(bd.id) AS total_tickets_sold
                  FROM bookings b
                  JOIN booking_details bd ON b.id = bd.booking_id
                  JOIN showtimes s ON b.showtime_id = s.id
                  WHERE b.status = 'paid'
                    AND MONTH(s.show_date) = $month
                    AND YEAR(s.show_date) = $year";
  $result_tickets = mysqli_query($conn, $sql_tickets);
  $row_tickets = mysqli_fetch_assoc($result_tickets);
  $totalTickets = $row_tickets['total_tickets_sold'] ?? 0;

  // Doanh thu trong ngày
  $sql_daily = "SELECT SUM(total_amount) AS daily_revenue
                FROM bookings
                WHERE status = 'paid'
                  AND DATE(booking_time) = CURDATE()";
  $result_daily = mysqli_query($conn, $sql_daily);
  $row_daily = mysqli_fetch_assoc($result_daily);
  $dailyRevenue = $row_daily['daily_revenue'] ?? 0;

  // Doanh thu trong tháng
  $sql_monthly = "SELECT SUM(total_amount) AS monthly_revenue
                  FROM bookings
                  WHERE status = 'paid'
                    AND booking_time BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW())";
  $result_monthly = mysqli_query($conn, $sql_monthly);
  $row_monthly = mysqli_fetch_assoc($result_monthly);
  $monthlyRevenue = $row_monthly['monthly_revenue'] ?? 0;

  // Xử lý ngày được chọn
  $selectedDate = isset($_GET['selected_date']) ? mysqli_real_escape_string($conn, $_GET['selected_date']) : date('Y-m-d');
  if (!DateTime::createFromFormat('Y-m-d', $selectedDate)) {
    $selectedDate = date('Y-m-d');
  }
  ?>

  <main class="main-content">
    <div class="dashboard">
      <div class="card">
        <div>Tổng số vé bán ra (T<?php echo $month . '/' . $year; ?>)</div>
        <h2><?php echo $totalTickets; ?></h2>
      </div>

      <div class="card">
        <div>Doanh thu trong ngày (<?php echo date('d/m/Y'); ?>)</div>
        <h2><?php echo number_format($dailyRevenue, 0, ',', '.'); ?> VNĐ</h2>
      </div>

      <div class="card">
        <div>Doanh thu trong tháng (<?php echo date('m/Y'); ?>)</div>
        <h2><?php echo number_format($monthlyRevenue, 0, ',', '.'); ?> VNĐ</h2>
      </div>
    </div>

    <!-- Chọn ngày -->
    <form method="GET" style="margin: 20px 0;">
      <label for="date-input">Chọn ngày:</label>
      <input type="date" id="date-input" name="selected_date" list="date-options" value="<?php echo $selectedDate; ?>">
      <datalist id="date-options">
        <?php
        $dateQuery = "SELECT DISTINCT show_date FROM showtimes ORDER BY show_date";
        $dateResult = mysqli_query($conn, $dateQuery);
        while ($dateRow = mysqli_fetch_assoc($dateResult)) {
          echo "<option value='{$dateRow['show_date']}'>";
        }
        ?>
      </datalist>
      <input type="submit" value="Lọc">
    </form>

    <!-- Bảng danh sách lịch chiếu -->
    <div class="table-container">
      <h2>Danh sách lịch chiếu ngày <?php echo date('d/m/Y', strtotime($selectedDate)); ?></h2>
      <table class="showtimes-table">
        <thead>
          <tr>
            <th>Tên phim</th>
            <th>Số vé đã bán</th>
            <th>Tổng doanh thu</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "
            SELECT 
              m.title,
              COUNT(DISTINCT bd.id) AS tickets_sold,
              IFNULL(SUM(
                CASE 
                  WHEN st.price_seat_type IS NOT NULL THEN st.price_seat_type
                  ELSE 0
                END
              ), 0) + IFNULL(SUM(fo.quantity * f.price), 0) AS total_revenue
            FROM showtimes s
            JOIN movies m ON s.movie_id = m.id
            LEFT JOIN bookings b ON b.showtime_id = s.id AND b.status = 'paid'
            LEFT JOIN booking_details bd ON bd.booking_id = b.id
            LEFT JOIN seats st ON bd.seat_id = st.id
            LEFT JOIN food_orders fo ON fo.booking_id = b.id
            LEFT JOIN foods f ON fo.food_id = f.id
            WHERE s.show_date = '$selectedDate'
            GROUP BY m.id, m.title
            ORDER BY m.title ASC
          ";
          $result = mysqli_query($conn, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['title']) . "</td>";
              echo "<td>" . number_format($row['tickets_sold']) . "</td>";
              echo "<td>" . number_format($row['total_revenue'], 0, ',', '.') . " VNĐ</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='3'>Không có dữ liệu cho ngày này.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/admin_profile.js"></script>

</body>
</html>
