<?php
include('../connect.php');

// Lấy danh sách phim đang chiếu
$movies = mysqli_query($conn, "SELECT id, title FROM movies WHERE status = 'Đang chiếu'");

// Lấy danh sách ngày chiếu
$dates = mysqli_query($conn, "SELECT DISTINCT show_date FROM showtimes ORDER BY show_date ASC");

// Lấy danh sách giờ chiếu
$times = mysqli_query($conn, "SELECT DISTINCT show_time FROM showtimes ORDER BY show_time ASC");

// Lấy danh sách khách hàng
$users = mysqli_query($conn, "SELECT id, user_name FROM users WHERE account_status = 'Hoạt động'");
?>

<form method="post" action="add_ticket_process.php">
  <h3>🎫 Thêm vé mới</h3>

  <label>Tên phim:</label><br>
  <select name="movie_id" required>
    <option value="">-- Chọn phim --</option>
    <?php while ($row = mysqli_fetch_assoc($movies)) {
      echo "<option value='{$row['id']}'>{$row['title']}</option>";
    } ?>
  </select><br><br>

  <label>Ngày chiếu:</label><br>
  <select name="show_date" required>
    <option value="">-- Chọn ngày --</option>
    <?php while ($row = mysqli_fetch_assoc($dates)) {
      echo "<option value='{$row['show_date']}'>{$row['show_date']}</option>";
    } ?>
  </select><br><br>

  <label>Giờ chiếu:</label><br>
  <select name="show_time" required>
    <option value="">-- Chọn giờ --</option>
    <?php while ($row = mysqli_fetch_assoc($times)) {
      echo "<option value='{$row['show_time']}'>{$row['show_time']}</option>";
    } ?>
  </select><br><br>

  <label>Mã ghế:</label><br>
  <input type="text" name="seat_id" placeholder="VD: R1-A1" required><br><br>

  <label>Khách hàng:</label><br>
  <select name="user_id" required>
    <option value="GUEST001">Khách vãng lai</option>
    <?php while ($row = mysqli_fetch_assoc($users)) {
      echo "<option value='{$row['id']}'>{$row['user_name']} ({$row['id']})</option>";
    } ?>
  </select><br><br>

  <label>Phương thức thanh toán:</label><br>
  <select name="payment_method" required>
    <option value="Tiền mặt">Tiền mặt</option>
    <option value="Banking">Banking</option>
    <option value="Momo">Momo</option>
    <option value="ZaloPay">ZaloPay</option>
  </select><br><br>

  <label>Trạng thái:</label><br>
  <select name="status" required>
    <option value="Đã thanh toán">Đã thanh toán</option>
    <option value="Chưa thanh toán">Chưa thanh toán</option>
  </select><br><br>

  <button type="submit">➕ Thêm vé</button>
</form>