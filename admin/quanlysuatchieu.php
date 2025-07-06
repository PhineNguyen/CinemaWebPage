<?php
session_start();
if (!isset($_SESSION['user']) || !in_array($_SESSION['ro_lo'], ['admin', 'employee'])) {
    exit();
}

include('../connect.php');
include('header_admin.php');
include('handle_delete.php');
// Gọi hàm xử lý xóa lịch chiếu
handleDelete('showtimes', 'id', 'delete_suatchieu_id', 'quanlysuatchieu.php', $conn);
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

$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM showtimes");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT 
    movies.title AS title, 
    movies.image_url AS image_url, 
    movies.ticket_price AS ticket_price,
    movies.status AS status,
    rooms.room_number AS room_number, 
    showtimes.show_date AS show_date, 
    showtimes.show_time AS show_time,
    showtimes.id AS id
FROM showtimes
JOIN movies ON showtimes.movie_id = movies.id
JOIN rooms ON showtimes.room_id = rooms.id
LIMIT $offset, $limit";

$results = mysqli_query($conn, $sql);

if ($results && mysqli_num_rows($results) > 0) {
    echo '<main class="main-content">';
    echo '<div class="buttons">';
    echo '<button id="btn4"><i class="fa-solid fa-plus"></i><span> Thêm </span></button>';
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
                <th></th>
            </tr>
          </thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td><input type='checkbox' class='checkItem'></td>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td><img src='" . htmlspecialchars($row['image_url']) . "' width='100'></td>
                <td>" . number_format($row['ticket_price'], 0, ',', '.') . " VNĐ</td>
                <td>" . htmlspecialchars($row['show_date']) . "</td>
                <td>" . htmlspecialchars($row['show_time']) . "</td>
                <td>" . htmlspecialchars($row['room_number']) . "</td>
                <td>
                <div class='action-buttons'>
                    
                    <button class='btn-edit' id='edit4' data-id='{$row['id']}'><i class='fa-solid fa-pencil-alt'></i> Sửa</button>
                    
                    <form method='post'>
                        <input type='hidden' name='delete_suatchieu_id' value='{$row['id']}'>
                        <button type='submit' class='btn-delete'><i class='fa-solid fa-trash'></i> Xóa</button>
                    </form>
                </div>
                </td>    
              </tr>";
    }

    echo '</tbody></table>';

    if ($total_pages > 1) {
    echo '<div class="pagination">';
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '"><<</a>';
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
        echo '<a href="?page=' . ($page + 1) . '">>></a>';
    }
    echo '</div>';
}

    echo '</main>';
} else {
    echo "<p class='main-content'>Không có lịch chiếu phim nào.</p>";
}
?>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/admin_profile.js"></script>
</body>
</html>
