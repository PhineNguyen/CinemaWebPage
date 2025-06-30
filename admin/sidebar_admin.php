<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Nút toggle nằm ngoài sidebar -->


<!-- Sidebar -->
<?php
  $role = isset($_SESSION['ro_lo']) ? $_SESSION['ro_lo'] : '';
?>
<div class="sidebar">
  <div class="sidebar-item">
    <?php if ($role === 'admin'): ?>
      <a href="admin.php"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="taikhoannguoidung.php"><i class="fa-solid fa-users"></i><span>Tài khoản người dùng</span></a>
      <a href="taikhoannhansu.php"><i class="fa-solid fa-user-tie"></i><span>Tài khoản nhân sự</span></a>
      <a href="quanlyphim.php"><i class="fa-solid fa-film"></i><span>Quản lý phim</span></a>
      <a href="quanlysuatchieu.php"><i class="fa-solid fa-clock"></i><span>Quản lý suất chiếu</span></a>
      <a href="quanlyrapPC.php"><i class="fa-solid fa-building"></i><span>Quản lý rạp & Phòng chiếu</span></a>
    <?php endif; ?>
      <a href="xemSuatChieu.php"><i class="fa-solid fa-film"></i><span>Xem suất chiếu</span></a>
      <a href="datVe.php"><i class="fa-solid fa-clock"></i><span>Đặt vé</span></a>
      <a href="hoTroKhachHang.php"><i class="fa-solid fa-film"></i><span>Hỗ trợ khách hàng</span></a>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>