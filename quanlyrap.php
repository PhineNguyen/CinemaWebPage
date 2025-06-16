<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
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
        <a href="quanlysuatchieu.php" class="sidebar-item">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Quản lý suất chiếu</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="quanlyrap.php" class="sidebar-item active">
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
    <!-- Main content -->
     <div class="main-content">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, doloremque consequatur neque deserunt doloribus sequi quaerat id aut possimus ipsa ad error eum, illo quidem temporibus, totam labore libero similique!
     </div>
</body>
</html>