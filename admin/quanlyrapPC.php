<?php

// Ngăn truy cập nếu chưa đăng nhập hoặc không phải admin
session_start();
if (!isset($_SESSION['user']) || $_SESSION['ro_lo'] !== 'admin') {
    exit();
}

include('../connect.php');
include('header_admin.php');
include('handle_delete.php');
// Gọi xử lý xóa
handleDelete('cinemas', 'id', 'delete_rap_id', 'quanlyrapPC.php', $conn);
handleDelete('rooms', 'id', 'delete_room_id', 'quanlyrapPC.php', $conn);
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
    <main class="main-content">

<?php
// PHÂN TRANG RẠP
$limit_cinemas = 5;
$pages_cinemas = isset($_GET['pages_cinemas']) ? (int)$_GET['pages_cinemas'] : 1;
if ($pages_cinemas < 1) $pages_cinemas = 1;

$total_result_cinemas = mysqli_query($conn, "SELECT COUNT(*) AS total_cinemas FROM cinemas");
$total_row_cinemas = mysqli_fetch_assoc($total_result_cinemas);
$total_records_cinemas = $total_row_cinemas['total_cinemas'];
$total_pages_cinemas = ceil($total_records_cinemas / $limit_cinemas);
if ($pages_cinemas > $total_pages_cinemas && $total_pages_cinemas > 0) $pages_cinemas = $total_pages_cinemas;

$offset_cinemas = ($pages_cinemas - 1) * $limit_cinemas;
$sqlClist = "SELECT id, ci_name, address, city, ci_status FROM cinemas LIMIT $offset_cinemas, $limit_cinemas";
$ciList = mysqli_query($conn, $sqlClist);

if ($ciList && mysqli_num_rows($ciList) > 0) {
    echo '<h2>DANH SÁCH RẠP</h2>';
    echo '<div class="buttons_cinemas">';
    echo '<button class="btn-add-cinema"><i class="fa-solid fa-plus"></i><span> Thêm rạp</span></button>';
    echo '</div>';
    echo '<table>';
    echo '<thead>
            <tr>
                <th>ID Rạp</th>
                <th>Tên Rạp</th>
                <th>Địa chỉ</th>
                <th>Thành phố</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
          </thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($ciList)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['ci_name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['city']}</td>
                <td>{$row['ci_status']}</td>
                <td>
                    <div class='action-buttons'>
                        
                        <button class='btn-edit' id='edit3' data-id='{$row['id']}'><i class='fa-solid fa-pencil-alt'></i> Sửa</button>
                        
                        <form method='post'>
                            <input type='hidden' name='delete_rap_id' value='{$row['id']}'>
                            <button type='submit' class='btn-delete'><i class='fa-solid fa-trash'></i> Xóa</button>
                        </form>
                    </div>
                </td>
              </tr>";
    }
    echo '</tbody></table>';

    // Phân trang rạp
    if ($total_pages_cinemas > 1) {
        echo '<div class="pagination_cinemas">';
        if ($pages_cinemas > 1) {
            echo '<a href="?pages_cinemas=' . ($pages_cinemas - 1) . '"><<</a>';
        }

        $max_links = 4;
        $start = max(1, $pages_cinemas - floor($max_links / 2));
        $end = min($total_pages_cinemas, $start + $max_links - 1);

        if ($start > 1) {
            echo '<a href="?pages_cinemas=1">1</a>';
            if ($start > 2) echo '<span>...</span>';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == $pages_cinemas) {
                echo '<strong>' . $i . '</strong>';
            } else {
                echo '<a href="?pages_cinemas=' . $i . '">' . $i . '</a>';
            }
        }

        if ($end < $total_pages_cinemas) {
            if ($end < $total_pages_cinemas - 1) echo '<span>...</span>';
            echo '<a href="?pages_cinemas=' . $total_pages_cinemas . '">' . $total_pages_cinemas . '</a>';
        }

        if ($pages_cinemas < $total_pages_cinemas) {
            echo '<a href="?pages_cinemas=' . ($pages_cinemas + 1) . '">>></a>';
        }
        echo '</div>';
    }
} else {
    echo "<p>Không có rạp nào.</p>";
}
echo '<br>';

// PHÂN TRANG PHÒNG CHIẾU
$limit_rooms = 8;
$pages_rooms = isset($_GET['pages_rooms']) ? (int)$_GET['pages_rooms'] : 1;
if ($pages_rooms < 1) $pages_rooms = 1;

$total_result_rooms = mysqli_query($conn, "SELECT COUNT(*) AS total_rooms FROM rooms");
$total_row_rooms = mysqli_fetch_assoc($total_result_rooms);
$total_records_rooms = $total_row_rooms['total_rooms'];
$total_pages_rooms = ceil($total_records_rooms / $limit_rooms);
if ($pages_rooms > $total_pages_rooms && $total_pages_rooms > 0) $pages_rooms = $total_pages_rooms;

$offset_rooms = ($pages_rooms - 1) * $limit_rooms;
$sqlRlist = "SELECT rooms.id AS room_id, rooms.room_number, rooms.room_status, rooms.total_seats, cinemas.ci_name AS cinema_name 
FROM rooms 
JOIN cinemas ON rooms.cinema_id = cinemas.id 
ORDER BY rooms.id ASC 
LIMIT $offset_rooms, $limit_rooms";
$roomList = mysqli_query($conn, $sqlRlist);

if ($roomList && mysqli_num_rows($roomList) > 0) {
    echo '<h2>DANH SÁCH PHÒNG CHIẾU</h2>';
    echo '<div class="buttons_rooms">';
    echo '<button class="btn-add-room"><i class="fa-solid fa-plus"></i><span> Thêm phòng</span></button>';
    echo '</div>';
    echo '<table>';
    echo '<thead>
            <tr>
                <th>ID phòng</th>
                <th>Tên phòng</th>
                <th>Rạp</th>
                <th>Số lượng ghế</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
          </thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($roomList)) {
        echo "<tr>
                <td>{$row['room_id']}</td>
                <td>{$row['room_number']}</td>
                <td>{$row['cinema_name']}</td>
                <td>{$row['total_seats']}</td>
                <td>{$row['room_status']}</td>
                <td>
                    <div class='action-buttons'>
                        <form method='post'>
                            <input type='hidden' name='delete_room_id' value='{$row['room_id']}'>
                            <button type='submit' class='btn-delete'><i class='fa-solid fa-trash'></i> Xóa</button>
                        </form>
                    </div>
                </td>
              </tr>";
    }
    echo '</tbody></table>';

    // Phân trang phòng chiếu
    // Phân trang phòng chiếu
if ($total_pages_rooms > 1) {
    echo '<div class="pagination_rooms">';
    if ($pages_rooms > 1) {
        echo '<a href="?pages_rooms=' . ($pages_rooms - 1) . '"><<</a>';
    }

    $max_links = 4;
    $start = max(1, $pages_rooms - floor($max_links / 2));
    $end = min($total_pages_rooms, $start + $max_links - 1);

    if ($start > 1) {
        echo '<a href="?pages_rooms=1">1</a>';
        if ($start > 2) echo '<span>...</span>';
    }

    for ($i = $start; $i <= $end; $i++) {
        if ($i == $pages_rooms) {
            echo '<strong>' . $i . '</strong>';
        } else {
            echo '<a href="?pages_rooms=' . $i . '&pages_cinemas=' . $pages_cinemas . '">' . $i . '</a>';
        }
    }

    if ($end < $total_pages_rooms) {
        if ($end < $total_pages_rooms - 1) echo '<span>...</span>';
        echo '<a href="?pages_rooms=' . $total_pages_rooms . '&pages_cinemas=' . $pages_cinemas . '">' . $total_pages_rooms . '</a>';
    }

    if ($pages_rooms < $total_pages_rooms) {
        echo '<a href="?pages_rooms=' . ($pages_rooms + 1) . '&pages_cinemas=' . $pages_cinemas . '">>></a>';
    }

    echo '</div>';
    }

} else {
    echo "<p>Không có phòng chiếu nào.</p>";
}
?>
    </main>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/admin_profile.js"></script>
</html>
