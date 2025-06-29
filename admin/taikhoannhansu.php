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

// Tính tổng số bản ghi để phân trang
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE users.ro_lo = 'admin' OR users.ro_lo = 'employee'");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Truy vấn dữ liệu có JOIN 3 bảng
$sql = " SELECT 
    users.id AS user_id, 
    users.user_name AS username,
    users.email AS email ,
    users.phone_number AS phone, 
    users.ro_lo AS role ,
    users.account_status AS status 
    FROM users 
    where users.ro_lo = 'admin' OR users.ro_lo = 'employee'
    LIMIT $offset, $limit";

$results = mysqli_query($conn, $sql);

if ($results && mysqli_num_rows($results) > 0) {
    echo '<main class="main-content">';
    echo '<div class="buttons">';
    echo '<button><i class="fa-solid fa-plus"></i><span> Thêm </span></button>';
    echo '</div>';

    echo '<table>';
    echo '<thead>
            <tr>
                <th>STT</th>
                <th>ID Nhân viên</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Ngày vào làm</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
          </thead>';
    echo '<tbody>';
$i=0;
    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td>" . ++$i . "</td>
                <td>{$row['user_id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}đ</td>
                <td>{$row['phone']}</td>
                <td>{$row['role']}</td>
                <td>{$row['status']}</td>

                <td>
                <button><i class='btn-edit-delete'></i>Xóa</button>
                <button><i class='btn-edit-Edit'></i>Sửa</button>
                </td>
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
