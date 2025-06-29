<?php
  session_start();
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
$ticket_count = "SELECT COUNT(bd.id) AS total_tickets_sold
FROM bookings b
JOIN booking_details bd ON b.id = bd.booking_id
JOIN showtimes s ON b.showtime_id = s.id
WHERE b.status = 'paid'
  AND MONTH(s.show_date) = $month;
  AND YEAR(s.show_date) = $year";
$ticketTotal = mysqli_query($conn, $ticket_count);
// $limit = 5;
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// if ($page < 1) $page = 1;

// $offset = ($page - 1) * $limit;

// // Tính tổng số bản ghi để phân trang
// $total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM showtimes");
// $total_row = mysqli_fetch_assoc($total_result);
// $total_records = $total_row['total'];
// $total_pages = ceil($total_records / $limit);

// // Truy vấn dữ liệu có JOIN 3 bảng
// $sql = "SELECT 
//     movies.title AS title, 
//     movies.image_url AS image_url, 
//     movies.ticket_price AS ticket_price,
//     movies.status AS status,
//     rooms.room_number AS room_number, 
//     showtimes.show_date AS show_date, 
//     showtimes.show_time AS show_time
// FROM showtimes
// JOIN movies ON showtimes.movie_id = movies.id
// JOIN rooms ON showtimes.room_id = rooms.id
// LIMIT $offset, $limit";



if ($results && mysqli_num_rows($results) > 0) {
  echo '<main class="main-content">';
    echo '<div class="dashboard">';
      echo '<div class="card">';
        echo '<div>Tổng số vé bán ra (T5/2025)</div>';
        echo '<h2>100</h2>';
    echo '</div>';
      echo '<div class="card">';
        echo '<div>Doanh thu trong ngày (01/06/2025)</div>';
        echo '<h2>500,000</h2>';
    echo '</div>';
      echo '<div class="card">';
        echo '<div>Doanh thu trong tháng (T5/2025)</div>';
        echo '<h2>8,000,000</h2>';
    echo '</div>';
  echo '</div>';

  echo '<div class="date-list" style="margin: 20px 0;">';
    echo '<label for="date-input">Chọn ngày:</label>';
    echo '<input type="text" id="date-input" name="date-input" list="date-options" placeholder="Chọn ngày (VD: 2025-06-01)">';
      echo '<datalist id="date-options">';
        echo '<option value="2025-06-01">';
        echo '<option value="2025-06-02">';
        echo '<option value="2025-06-03">';
        echo '<option value="2025-06-04">';
        echo '<option value="2025-06-05">';
    echo '</datalist>';
    echo '</div>';
    echo '<table>';
    echo '<thead>
            <tr>
                <th>Tên phim</th>
                <th>Số vé đã bán</th>
                <th>Doanh thu</th>
            </tr>
          </thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td>{$row['show_date']}</td>
                <td>{$row['show_time']}</td>
                <td>{$row['room_number']}</td>
              </tr>";
    }

    echo '</tbody></table>';

    // Hiển thị phân trang
    if ($total_pages > 1) {
        echo '<div class="pagination">';
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '">Trang trước</a>';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<strong>' . $i . '</strong>';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '">Trang sau</a>';
        }
        echo '</div>';
    }

    echo '</main>';
} else {
    echo "<p class='main-content'>Không có lịch chiếu phim nào.</p>";
}
?>
   
  </div>
</body>
</html>
