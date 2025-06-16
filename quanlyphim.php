<?php
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phim</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/admin.css">  
    <link rel="stylesheet" href="CSS/quanlyphim.css">    
</head>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/admin.js"></script>
<script src="js/addfilm.js"></script>
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
        <a href="quanlyphim.php" class="sidebar-item active">
            <i class="fa-solid fa-film"></i>
            <span>Quản lý phim</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="quanlysuatchieu.php" class="sidebar-item">
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
                <button type="button" name="them" onclick="openAddForm()" >+ Thêm</button>
                <button type="button" name="xoa">Xóa</button>
                <button type="button" name="sua">Sửa</button>
                <button type="button" name="chontatca">Chọn tất cả</button>
                <input type="text" placeholder="Search..." class="search-box">
            </div>

            <?php
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $limit = 5;
                $offset = ($page - 1) * $limit;

                $sql = "SELECT title, image_url, release_date, genre, director, actor, age_rating, status FROM movies LIMIT $limit OFFSET $offset";
                $result = mysqli_query($conn, $sql);
            ?>

            <table class="movie-table">
               <?php

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' class='movie-checkbox'></td>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td><img src='" . htmlspecialchars($row['image_url']) . "' width='100' height='150'></td>";
                        echo "<td>" . htmlspecialchars($row['release_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['director']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['actor']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['age_rating']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có dữ liệu.</td></tr>";
                }
            ?>

                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllCheckbox"></th>
                        <th>Tên phim</th>
                        <th>Poster</th>
                        <th>Năm phát hành</th>
                        <th>Thể loại</th>
                        <th>Đạo diễn</th>
                        <th>Diễn viên</th>
                        <th>Giới hạn độ tuổi</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tự update -->
                </tbody>
            </table>

            <?php
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $limit = 5; // số phim mỗi trang
                $offset = ($page - 1) * $limit;
                $sql = "SELECT title, image_url, release_date, genre, director, actor, age_rating, status FROM movies LIMIT $limit OFFSET $offset";
                $totalSql = "SELECT COUNT(*) as total FROM movies";
                $totalResult = mysqli_query($conn, $totalSql);
                $totalRow = mysqli_fetch_assoc($totalResult);
                $totalMovies = $totalRow['total'];
                $totalPages = ceil($totalMovies / $limit);

            ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="pagination-button">&laquo;</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="pagination-button <?= ($i == $page) ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="pagination-button">&raquo;</a>
                <?php endif; ?>
            </div>

        </div>

        <!-- Form thêm phim (ẩn) -->
        <div id="addFormModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddForm()">&times;</span>
            <h2>Thêm phim mới</h2>
            <form action="themphim.php" method="POST">
            <input type="text" name="title_vi" placeholder="Tên phim" required>
            <input type="text" name="image_url" placeholder="Link poster" required>
            <input type="number" name="release_date" placeholder="Năm phát hành" required>
            <input type="text" name="genre_vi" placeholder="Thể loại" required>
            <input type="text" name="director_vi" placeholder="Đạo diễn" required>
            <input type="text" name="actor_vi" placeholder="Diễn viên" required>
            <input type="text" name="age_rating_vi" placeholder="Giới hạn độ tuổi" required>
            <!-- Select trạng thái phim -->
            <label for="status" class="status">Trạng thái phim:</label>
            <select name="status" required>
                <option value="">-- Chọn trạng thái --</option>
                <option value="dang_chieu">Đang chiếu</option>
                <option value="sap_chieu">Sắp chiếu</option>
                <option value="ngung_chieu">Ngừng chiếu</option>
            </select>
            <br/>
            <button type="submit" class="btn-add">Thêm phim</button>
            </form>
        </div>
        </div>

    </div>

    <!-- Modal xác nhận xóa -->
    <div id="deleteConfirmModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Xác nhận xóa</h2>
        <p>Bạn có chắc chắn muốn xóa các phim đã chọn không?</p>
        <div class="modal-buttons">
        <button id="confirmDeleteBtn" class="btn-delete">Xóa</button>
        <button onclick="closeDeleteModal()" class="btn-cancel">Hủy</button>
        </div>
    </div>
    </div>

</main>
</body>
</html>