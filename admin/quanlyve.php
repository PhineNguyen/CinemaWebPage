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

$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;
$total_result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM tickets t
    JOIN booking_details bd ON t.booking_detail_id = bd.id
    JOIN seats s ON bd.seat_id = s.id
    JOIN rooms r ON s.room_id = r.id
    JOIN bookings b ON bd.booking_id = b.id
    JOIN showtimes st ON b.showtime_id = st.id
    JOIN movies m ON st.movie_id = m.id
");

$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);
if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
$offset = ($page - 1) * $limit;
// Truy vấn dữ liệu có JOIN 3 bảng
$sql = "SELECT 
    t.ticket_code AS ma_ve,
    m.title AS ten_phim,
    st.show_time AS thoi_gian,
    st.show_date AS ngay,
    r.room_number AS phong,
    1 AS so_ve,  -- mỗi dòng là 1 vé
    CONCAT(s.seat_row, s.seat_number) AS so_ghe,
    t.status AS trang_thai
    FROM tickets t
    JOIN booking_details bd ON t.booking_detail_id = bd.id
    JOIN seats s ON bd.seat_id = s.id
    JOIN rooms r ON s.room_id = r.id
    JOIN bookings b ON bd.booking_id = b.id
    JOIN showtimes st ON b.showtime_id = st.id
    JOIN movies m ON st.movie_id = m.id
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
                <th>Mã vé</th>
                <th>Tên phim</th>
                <th>Ngày</th>
                <th>Thời gian</th>
                <th>Phòng</th>
                <th>Số vé</th>
                <th>Số ghế</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
          </thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td><input type='checkbox' class='checkItem'></td>
                <td>{$row['ma_ve']}</td>
                <td>{$row['ten_phim']}</td>
                <td>{$row['ngay']}</td>
                <td>{$row['thoi_gian']}</td>
                <td>{$row['phong']}</td>
                <td>{$row['so_ve']}</td>
                <td>{$row['so_ghe']}</td>
                <td>{$row['trang_thai']}</td>
                <td><button class='btn-edit'>Cập nhật</button></td>
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
    echo " ";
}
?>
  </div>
</body>
</html>
