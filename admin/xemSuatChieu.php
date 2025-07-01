<?php
session_start();

// Kiểm tra quyền truy cập
if (!isset($_SESSION['user']) || $_SESSION['ro_lo'] !== 'employee') {
    header("Location: homeEmployee.php");
    exit();
}
include('../connect.php');
include('header_admin.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Suất Chiếu</title>
  <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
  <link rel="stylesheet" href="../admin/adminCSS/header_admin.css"> 
  <link rel="stylesheet" href="../admin/adminCSS/quanlyphim.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="admin-layout">
    <aside class="sidebar">
      <?php include('sidebar_admin.php'); ?>
    </aside>
    <main class="main-content">
      <?php
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        // Đếm tổng số suất chiếu
        $total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM showtimes");
        $total_row = mysqli_fetch_assoc($total_result);
        $total_showtimes = $total_row['total'];
        $total_pages = ceil($total_showtimes / $limit);

        // Lấy danh sách suất chiếu có phân trang
        $sql = "SELECT movies.title, showtimes.show_date, showtimes.show_time, rooms.room_number
                  FROM showtimes
                  JOIN movies ON showtimes.movie_id = movies.id
                  JOIN rooms ON showtimes.room_id = rooms.id
                  ORDER BY showtimes.show_date, showtimes.show_time
                  LIMIT $offset, $limit";
        $results = mysqli_query($conn, $sql);

        if ($results && mysqli_num_rows($results) > 0) {
            echo '<div class="buttons">
            </div>
            <table>
            <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên phim</th>
                        <th>Ngày chiếu</th>
                        <th>Giờ chiếu</th>
                        <th>Phòng</th>
                    </tr>
                  </thead>
            <tbody>';
            $i = $offset;
            while ($row = mysqli_fetch_assoc($results)) {
                echo "<tr>
                        <td>" . ++$i . "</td>
                        <td>{$row['title']}</td>
                        <td>{$row['show_date']}</td>
                        <td>{$row['show_time']}</td>
                        <td>{$row['room_number']}</td>
                      </tr>";
            }
            echo '</tbody></table>';

            // Phân trang
            if ($total_pages > 1) {
                echo '<div class="pagination">';
                if ($page > 1) {
                    echo '<a href="?page=' . ($page - 1) . '">&lt;&lt;</a>';
                }
                $max_links = 4; // Số trang muốn hiển thị
                $start = max(1, $page - floor($max_links / 2));
                $end = min($total_pages, $start + $max_links - 1);

                if ($start > 1) {
                    echo '<a href="?page=1">1</a>';
                    if ($start > 2) echo '<span>...</span>';
                }

                for ($i = $start; $i <= $end; $i++) {
                    if ($i == $page) {
                        echo '<strong>' . $i . '</strong>';
                    } else {
                        echo '<a href="?page=' . $i . '">' . $i . '</a>';
                    }
                }

                if ($end < $total_pages) {
                    if ($end < $total_pages - 1) echo '<span>...</span>';
                    echo '<a href="?page=' . $total_pages . '">' . $total_pages . '</a>';
                }

                if ($page < $total_pages) {
                    echo '<a href="?page=' . ($page + 1) . '">&gt;&gt;</a>';
                }
                echo '</div>';
            }
        } else {
            echo "<p class='main-content'>Không có suất chiếu nào.</p>";
        }
      ?>
    </main>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/admin_profile.js"></script>
</body>
</html>