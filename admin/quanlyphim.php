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

    // Tính OFFSET
    $offset = ($page - 1) * $limit;

    // Tổng số phim để tính tổng số trang
    $total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM movies");
    $total_row = mysqli_fetch_assoc($total_result);
    $total_movies = $total_row['total'];
    $total_pages = ceil($total_movies / $limit);
    
    $sql = "SELECT title, image_url, release_date, genre, lgs, age_rating, status FROM movies limit $offset, $limit";
    $results = mysqli_query($conn, $sql);
    if($results && mysqli_num_rows($results) > 0){
    echo' <main class="main-content">';
    echo '<div class="buttons">';
    echo '<button><i class="fa-solid fa-plus"></i><span>Thêm </span></button>';
    echo '<button><i class="fa-solid fa-minus"></i><span>Xóa</span></button>';
    echo '<button><i class="fa-solid fa-wrench"></i><span>Sửa</span></button>';
    echo '</div>';

     echo '<table>';
       echo '<thead>';
           echo '<tr>';
               echo '<th><input type="checkbox" id="checkAll"></th>';
               echo '<th>Tên phim</th>';
               echo '<th>Poster</th>';
               echo '<th>Năm phát hành</th>';
               echo '<th>Thể loại</th>';          
               echo '<th>Ngôn ngữ</th>';               
               echo '<th>Giới hạn độ tuổi</th>';                     
               echo '<th>Trạng thái</th>';
             echo '</tr>';
       echo '</thead>';
    echo '<tbody>';
            while ($movieDetails = mysqli_fetch_assoc($results)) {
        echo "<tr>
                <td><input type='checkbox' class='checkItem'></td>
                <td>" . $movieDetails['title'] . "</td>
                <td><img src='" . $movieDetails['image_url'] . "' width='120' alt='Poster'></td>
                <td>" . $movieDetails['release_date'] . "</td>
                <td>" . $movieDetails['genre'] . "</td>
                <td>" . $movieDetails['lgs'] . "</td>
                <td>" . $movieDetails['age_rating'] . "</td>
                <td>" . $movieDetails['status'] . "</td>
              </tr>";
    }

     echo "</tbody></table>";

    // Hiển thị nút chuyển trang nếu có nhiều trang
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
} else {
    echo "Không có phim nào trong cơ sở dữ liệu.";
}
?>
  </div>
</body>
</html>