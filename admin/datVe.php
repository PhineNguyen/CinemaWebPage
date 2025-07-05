<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['ro_lo'] !== 'employee') {
    header("Location: homeEmployee.php");
    exit();
}
include('../connect.php');
include('header_admin.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đặt Vé</title>
  <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
  <link rel="stylesheet" href="../admin/adminCSS/header_admin.css"> 
  <link rel="stylesheet" href="../admin/adminCSS/quanlyphim.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    #popupModal {
      display: none;
      position: fixed;
      top: 20%;
      left: 30%;
      width: 40%;
      background: #fff;
      padding: 20px;
      border: 1px solid #ccc;
      z-index: 999;
      box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
    }
    #btnCloseModal {
      float: right;
      cursor: pointer;
      font-weight: bold;
      color: red;
    }
  </style>
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

  $total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tickets");
  $total_row = mysqli_fetch_assoc($total_result);
  $total_pages = ceil($total_row['total'] / $limit);

  $sql = "SELECT 
    t.ticket_code AS ma_ve,
    u.user_name AS username,
    m.title AS ten_phim,
    st.show_time AS thoi_gian,
    st.show_date AS ngay,
    r.room_number AS phong,
    1 AS so_ve,
    CONCAT(s.seat_row, s.seat_number) AS so_ghe,
    t.status AS trang_thai
    FROM tickets t
    JOIN booking_details bd ON t.booking_detail_id = bd.id
    JOIN seats s ON bd.seat_id = s.id
    JOIN rooms r ON s.room_id = r.id
    JOIN bookings b ON bd.booking_id = b.id
    JOIN users u ON b.user_id = u.id
    JOIN showtimes st ON b.showtime_id = st.id
    JOIN movies m ON st.movie_id = m.id
    LIMIT $offset, $limit";

  $results = mysqli_query($conn, $sql);

  echo '<main class="main-content">';
  echo '<div class="buttons">
          <button id="btnOpenModal"><i class="fa-solid fa-plus"></i><span> Thêm </span></button>
        </div>';

  if ($results && mysqli_num_rows($results) > 0) {
      echo '<table>
        <thead>
          <tr>
            <th>Mã vé</th>
            <th>Tên phim</th>
            <th>Ngày</th>
            <th>Thời gian</th>
            
            <th>Tên khách hàng</th>                
            
         
            
            <th>Phòng</th>
        
            <th>Số ghế</th>
            <th></th>
          </tr>
        </thead>
        <tbody>';
      while ($row = mysqli_fetch_assoc($results)) {
          echo "<tr>
                  <td>{$row['ma_ve']}</td>
                  <td>{$row['username']}</td>
                  <td>{$row['ten_phim']}</td>
                  <td>{$row['ngay']}</td>
                  <td>{$row['thoi_gian']}</td>
                  <td>{$row['phong']}</td>
                  <td>{$row['so_ve']}</td>
                  <td>{$row['so_ghe']}</td>
                  <td>
                    <div class='action-buttons'>
                      <button class='btn-delete'><i class='fa-solid fa-pencil-alt'></i>Xóa</button>
                    </div>
                  </td>
                </tr>";
      }
      echo '</tbody></table>';

      // Phân trang
      if ($total_pages > 1) {
          echo '<div class="pagination">';
          if ($page > 1) {
              echo '<a href="?page=' . ($page - 1) . '"><<</a>';
          }
          for ($i = 1; $i <= $total_pages; $i++) {
              echo ($i == $page) ? "<strong>$i</strong>" : "<a href='?page=$i'>$i</a>";
          }
          if ($page < $total_pages) {
              echo '<a href="?page=' . ($page + 1) . '">>></a>';
          }
          echo '</div>';
      }

  } else {
      echo "<p>Không có vé nào.</p>";
  }

  echo '</main>';
  ?>

</div>

<!-- Popup Modal -->
<div id="popupModal">
  <span id="btnCloseModal">❌</span>
  <div id="modalContent">Đang tải...</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/datVe.js"></script>
</body>
</html>
