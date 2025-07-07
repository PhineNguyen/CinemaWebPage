<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['ro_lo'] !== 'admin') {
    exit();
}
include('../connect.php');
include('header_admin.php');
include('handle_delete.php');
// Gọi hàm xử lý xóa người dùng
handleDelete('users', 'id', 'delete_user_id', 'taikhoannguoidung.php', $conn);
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
$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE users.ro_lo = 'user'");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_page = ceil($total_records / $limit);
if ($page > $total_page && $total_page > 0) $page = $total_page;
$offset = ($page - 1) * $limit;

$sql = "SELECT 
    users.id AS user_id, 
    users.user_name AS username,
    users.email AS email,
    users.phone_number AS phone, 
    users.ro_lo AS role,
    users.account_status AS status 
    FROM users 
    WHERE users.ro_lo = 'user'
    LIMIT $offset, $limit";

$results = mysqli_query($conn, $sql);

if ($results && mysqli_num_rows($results) > 0) {
    echo '<main class="main-content">';
    echo '<table>';
    echo '<thead>
            <tr>
                <th>STT</th>
                <th>ID Khách hàng</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
          </thead>';
    echo '<tbody>';
    $i = ($page - 1) * $limit;
    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td>" . ++$i . "</td>
                <td>{$row['user_id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['role']}</td>
                <td>{$row['status']}</td>
                <td>
                   <div class='action-buttons'>
                        <form method='post'>
                            <input type='hidden' name='delete_user_id' value='{$row['user_id']}'>
                            <button type='submit' class='btn-delete'><i class='fa-solid fa-trash'></i> Xóa</button>
                        </form>
                    </div>
                </td>
              </tr>";
    }

    echo '</tbody></table>';

    if ($total_page > 1) {
        echo '<div class="pagination">';
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '"><<</a>';
        }
        $max_links = 4; // Số trang muốn hiển thị
        $start = max(1, $page - floor($max_links / 2));
        $end = min($total_page, $start + $max_links - 1);

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

    if ($end < $total_page) {
        if ($end < $total_page - 1) echo '<span>...</span>';
        echo '<a href="?page=' . $total_page . '">' . $total_page . '</a>';
    }

        if ($page < $total_page) {
            echo '<a href="?page=' . ($page + 1) . '">>></a>';
        }
        echo '</div>';
    }

    echo '</main>';
} else {
    echo "<p class='main-content'>Không có người dùng nào.</p>";
}
?>
  </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/admin_profile.js"></script>
</body>
</html>
