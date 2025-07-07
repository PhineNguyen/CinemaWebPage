<?php
session_start();

// Kiểm tra nếu chưa đăng nhập hoặc không phải là admin
if (!isset($_SESSION['user']) || $_SESSION['ro_lo'] !== 'admin') {
    exit();
}

include('../connect.php');
include('header_admin.php');
include('handle_delete.php');
// Gọi hàm xử lý xóa người dùng
handleDelete('users', 'id', 'delete_user_id', 'taikhoannhansu.php', $conn);
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


// Xử lý tìm kiếm
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = "(users.ro_lo = 'admin' OR users.ro_lo = 'employee')";
if ($search !== '') {
    $search_sql = mysqli_real_escape_string($conn, $search);
    $where .= " AND (users.user_name LIKE '%$search_sql%' OR users.email LIKE '%$search_sql%' OR users.phone_number LIKE '%$search_sql%')";
}

$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE $where");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT 
    users.id AS user_id, 
    users.user_name AS username,
    users.email AS email,
    users.phone_number AS phone, 
    users.ro_lo AS role,
    users.account_status AS status 
    FROM users 
    WHERE $where
    LIMIT $offset, $limit";

$results = mysqli_query($conn, $sql);

if ($results && mysqli_num_rows($results) > 0) {
    echo '<main class="main-content">';
    // Form tìm kiếm nhân sự và nút thêm
    echo '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">';
    echo '<form method="get" class="search-form" style="margin:0;">';
    echo '<input type="text" name="search" placeholder="Tìm kiếm theo tên, email hoặc số điện thoại..." value="' . (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') . '" style="padding:6px 12px; width:260px;">';
    echo '<button type="submit" style="padding:6px 16px; margin-left:8px;"><i class="fa fa-search"></i> Tìm kiếm</button>';
    echo '</form>';
    echo '<button id="btn2" style="padding:6px 16px;background:#ffc107;color:#212529;border:none;border-radius:4px;cursor:pointer;font-weight:600;"><i class="fa-solid fa-plus"></i><span> Thêm </span></button>';
    echo '</div>';

    echo '<table>';
    echo '<thead>
            <tr>
                <th>STT</th>
                <th>ID Nhân viên</th>
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
                    <button class='btn-edit' data-id='{$row['user_id']}'><i class='fa-solid fa-pencil-alt'></i> Sửa</button>
                    <form method='post'>
                        <input type='hidden' name='delete_user_id' value='{$row['user_id']}'>
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
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<strong>' . $i . '</strong>';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '">>></a>';
        }
        echo '</div>';
    }

    echo '</main>';
} else {
    echo "<p class='main-content'>Không có nhân viên nào.</p>";
}
?>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/admin_profile.js"></script>
</body>
</html>
