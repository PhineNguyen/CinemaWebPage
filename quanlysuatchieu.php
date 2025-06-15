<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phim</title>
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/quanlysuatchieu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/admin.js"></script>
<body>
    <div class="header">
        <div class="logo">
            <img src="pic/logo.png"> <img src="pic/CINETIX.png" alt="CineTix Logo">
        </div>
        <div class="admin-profile">
            <div class="admin-text">Admin</div>
            <div class="admin-icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="mucluc">
                <a href="infor_admin.php"><i class="fa-solid fa-circle-user"></i> Tài khoản</a>
                <a href="#"><i class="fa-solid fa-gear"></i> Cài đặt</a>
                <a href="login_admin.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
            </div>
        </div>
    </div>
    <!-- Menu trái -->
    <div class="sidebar">
        <a href="admin.php" class="sidebar-item">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="quanlyphim.php" class="sidebar-item">
            <i class="fa-solid fa-film"></i>
            <span>Quản lý phim</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="quanlysuatchieu.php" class="sidebar-item active">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Quản lý suất chiếu</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="quanlyrap.php" class="sidebar-item">
            <i class="fa-solid fa-house-user"></i>
            <span>Quản lý rạp & phòng</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="quanlyve.php" class="sidebar-item">
            <i class="fa-solid fa-ticket"></i>
            <span>Quản lý vé</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!--Main-->
    <div class="main-content">
        <div class="main-box">
            <div class="actions">
                <button>+ Thêm</button>
                <button>Xóa</button>
                <button>Sửa</button>
                <input type="text" placeholder="Search..." class="search-box">
            </div>

            <table class="movie-table">
                <?php

$sql = "SELECT title_vi, image_url, price, ngày ,lịch chiếu, room_number FROM movies,rooms";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['title_vi']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($row['image_url']) . "' width='100' height='150'></td>";
        echo "<td>" . htmlspecialchars($row['release_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['genre_vi']) . "</td>";
        echo "<td>" . htmlspecialchars($row['director_vi']) . "</td>";
        echo "<td>" . htmlspecialchars($row['actor_vi']) . "</td>";
        echo "<td>" . htmlspecialchars($row['age_rating_vi']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>Không có dữ liệu.</td></tr>";
}
?>
            <thead>
                    <tr>
                        <th>Tên phim</th>
                        <th>Poster</th>
                        <th>Giá</th>
                        <th>Ngày</th>
                        <th>Lịch chiếu</th>
                        <th>Phòng</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
        
                </tbody>
            </table>

            <div class="pagination">
                <button class="pagination-button">&lt;</button>
                <button class="pagination-button active">1</button>
                <button class="pagination-button">2</button>
                <button class="pagination-button">3</button>
                <button class="pagination-button">&gt;</button>
            </div>
        </div>
    </div>

</main>
</body>
</html>