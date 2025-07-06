<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Nút toggle nằm ngoài sidebar -->


<!-- Sidebar -->
<?php
  $role = isset($_SESSION['ro_lo']) ? $_SESSION['ro_lo'] : '';
  $current = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
  <div class="sidebar-item">
   <?php if ($role === 'admin'): ?>
      <a href="admin.php" class="<?= $current=='admin.php'?'active':'' ?>"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="taikhoannguoidung.php" class="<?= $current=='taikhoannguoidung.php'?'active':'' ?>"><i class="fa-solid fa-users"></i><span>Tài khoản người dùng</span></a>
      <a href="taikhoannhansu.php" class="<?= $current=='taikhoannhansu.php'?'active':'' ?>"><i class="fa-solid fa-user-tie"></i><span>Tài khoản nhân sự</span></a>
      <a href="quanlyphim.php" class="<?= $current=='quanlyphim.php'?'active':'' ?>"><i class="fa-solid fa-film"></i><span>Quản lý phim</span></a>
      <a href="quanlysuatchieu.php" class="<?= $current=='quanlysuatchieu.php'?'active':'' ?>"><i class="fa-solid fa-clock"></i><span>Quản lý suất chiếu</span></a>
      <a href="quanlyrapPC.php" class="<?= $current=='quanlyrapPC.php'?'active':'' ?>"><i class="fa-solid fa-building"></i><span>Quản lý rạp & Phòng chiếu</span></a>
    <?php endif; ?>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
