<?php
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
  <link rel="stylesheet" href="../admin/adminCSS/quanlyphim.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="admin-layout">
    <aside class="sidebar">
      <?php include('sidebar_admin.php'); ?>
    </aside>

<?php
$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

// Tính tổng số bản ghi để phân trang
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM showtimes");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Truy vấn dữ liệu có JOIN 3 bảng
$sql = "SELECT 
    movies.title AS title, 
    movies.image_url AS image_url, 
    movies.ticket_price AS ticket_price,
    movies.status AS status,
    rooms.room_number AS room_number, 
    showtimes.show_date AS show_date, 
    showtimes.show_time AS show_time
FROM showtimes
JOIN movies ON showtimes.movie_id = movies.id
JOIN rooms ON showtimes.room_id = rooms.id
LIMIT $offset, $limit";

$results = mysqli_query($conn, $sql);

if ($results && mysqli_num_rows($results) > 0) {
    echo '<main class="main-content">';
    echo '<div class="buttons">';
    echo '<button><i class="fa-solid fa-plus"></i><span> Thêm </span></button>';
    echo '<button><i class="fa-solid fa-minus"></i><span> Xóa</span></button>';
    echo '<button><i class="fa-solid fa-wrench"></i><span> Sửa</span></button>';
    echo '</div>';

    echo '<table>';
    echo '<thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Tên phim</th>
                <th>Poster</th>
                <th>Giá vé</th>
                <th>Ngày chiếu</th>
                <th>Giờ chiếu</th>
                <th>Phòng</th>
                <th>Trạng thái</th>
            </tr>
          </thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td><input type='checkbox' class='checkItem'></td>
                <td>{$row['title']}</td>
                <td><img src='{$row['image_url']}' width='100'></td>
                <td>{$row['ticket_price']}VNĐ</td>
                <td>{$row['show_date']}</td>
                <td>{$row['show_time']}</td>
                <td>{$row['room_number']}</td>
                <td>{$row['status']}</td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="/adminjs/sidebar.js"></script>

</body>

</html>
