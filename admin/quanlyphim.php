<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['ro_lo'] !== 'admin') {
    exit();
}
include('../connect.php');
include('header_admin.php');
include('handle_delete.php');
// Gọi hàm xử lý xóa phim
handleDelete('movies', 'id', 'delete_movies_id', 'quanlyphim.php', $conn);
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

    $total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM movies");
    $total_row = mysqli_fetch_assoc($total_result);
    $total_movies = $total_row['total'];
    $total_pages = ceil($total_movies / $limit);
    
    // Xử lý tìm kiếm phim
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $where = '1';
    if ($search !== '') {
        $search_sql = mysqli_real_escape_string($conn, $search);
        $where = "title LIKE '%$search_sql%' OR genre LIKE '%$search_sql%' OR lgs LIKE '%$search_sql%'";
    }
    $sql = "SELECT id, title, image_url, release_date, genre, lgs, age_rating, status FROM movies WHERE $where LIMIT $offset, $limit";
    $results = mysqli_query($conn, $sql);
    if($results && mysqli_num_rows($results) > 0){
    echo '<main class="main-content">';
    // Form tìm kiếm phim và nút thêm
    echo '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">';
    echo '<form method="get" class="search-form" style="margin:0;">';
    echo '<input type="text" name="search" placeholder="Tìm kiếm theo tên phim, thể loại, ngôn ngữ..." value="' . (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') . '" style="padding:6px 12px; width:260px;">';
    echo '<button type="submit" style="padding:6px 16px; margin-left:8px;"><i class="fa fa-search"></i> Tìm kiếm</button>';
    echo '</form>';
    echo '<button id="btn3" style="padding:6px 16px;background:#ffc107;color:#212529;border:none;border-radius:4px;cursor:pointer;font-weight:600;"><i class="fa-solid fa-plus"></i><span> Thêm </span></button>';
    echo '</div>';

    echo '<table>';
    echo '<thead>
    <tr>
    <th>Tên phim</th>
    <th>Poster</th>
    <th>Năm phát hành</th>
    <th>Thể loại</th>          
    <th>Ngôn ngữ</th>               
    <th>Giới hạn độ tuổi</th>                     
    <th>Trạng thái</th>
    <th></th>
    </tr>
    </thead>';
    echo '<tbody>';
    
    while ($movieDetails = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td>" . $movieDetails['title'] . "</td>
                <td><img src='" . $movieDetails['image_url'] . "' width='120' alt='Poster'></td>
                <td>" . $movieDetails['release_date'] . "</td>
                <td>" . $movieDetails['genre'] . "</td>
                <td>" . $movieDetails['lgs'] . "</td>
                <td>" . $movieDetails['age_rating'] . "</td>
                <td>" . $movieDetails['status'] . "</td>
                <td>
                <div class='action-buttons'>
                   
                    <button class='btn-edit' id='edit2' data-id='{$movieDetails['id']}'><i class='fa-solid fa-wrench'></i> Sửa</button>
                    
                    <form method='post'>
                        <input type='hidden' name='delete_movies_id' value='{$movieDetails['id']}'>
                        <button type='submit' class='btn-delete'><i class='fa-solid fa-trash'></i> Xóa</button>
                    </form>
                </div>
                </td>
              </tr>";
    }

    echo "</tbody></table>";

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
    echo "<main class='main-content'>Không có phim nào trong cơ sở dữ liệu.</main>";
}
?>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/admin_profile.js"></script>
</body>
</html>
