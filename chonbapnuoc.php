<?php
include('connect.php');
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn bắp nước</title>
    <link rel="stylesheet" href="CSS/chonbapnuoc.css">
</head>
<!-- Bỏ mũi tên trong input -->
<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
}
input[type=number] {
-moz-appearance: textfield;
}
</style>
<body>
    <div class="main-contain">
       <h2>Combo - Bắp nước</h2>
      <div class="combo-list">
        <!-- List -->
        <?php 
        // Truy vấn dữ liệu
        $sql="SELECT * FROM foods ORDER BY id ASC LIMIT 4"; 
        $result=$conn->query($sql);

        if ($result->num_rows > 0) {
          $count = 0;
          $total = $result->num_rows;
          while ($row = $result->fetch_assoc()) {
            $count++;
            echo '<div class="combo-item" data-combo="' . htmlspecialchars($row['id']) . '">';
            echo '  <img src="' . htmlspecialchars($row['food_images']) . '" alt="' . htmlspecialchars($row['namef']) . '">';
            echo '  <div class="combo-info">';
            echo '    <h3>' . htmlspecialchars($row['namef']) . '</h3>';
            echo '    <p class="price">' . number_format($row['price'], 0, ',', '.') . 'đ</p>';
            echo '    <div class="quantity-control">';
            echo '      <button class="minus">-</button>';
            echo '      <input type="number" value="0" min="0">';
            echo '      <button class="plus">+</button>';
            echo '    </div>';
            echo '  </div>';
            if($count === $total){
            echo '  <button class="select" id="chang' . htmlspecialchars($row['id']) . '"  style="background-color:#EBB802; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
            >Thay đổi</button>';
            };
            echo '</div>';
          }
        }
        ?>

        <!-- KHUNG TOTAL -->
        <div id="total-box">
          <div>
            Tổng tiền:<span id="total-price">0đ</span>
          </div>
        </div>

        <div class="combo-footer">
          <button class="continue-btn">Quay lại</button>
          <button class="continue-btn">Tiếp tục</button>
        </div> 
      </div> 
    </div>

<!-- FORM CHỌN LOẠI NƯỚC -->
<form id="popup-nuoc" class="popup-form" style="display: none;">
  <div class="popup-content">
    <h3>Chọn loại nước</h3>
    <div id="drink-options">
      <?php 
        $drink_sql = "SELECT * FROM foods ORDER BY id DESC LIMIT 4 ";
        $drink_result = $conn->query($drink_sql);
        if ($drink_result->num_rows > 0) {
          while ($drink = $drink_result->fetch_assoc()) {
            echo '<label>';
            echo '<input type="radio" name="loai_nuoc" value="' . htmlspecialchars($drink['id']) . '" 
                    data-name="' . htmlspecialchars($drink['namef']) . '" 
                    data-price="' . number_format($drink['price'], 0, ',', '.') . 'đ" 
                    data-img="' . htmlspecialchars($drink['food_images']) . '"> ';
            echo htmlspecialchars($drink['namef']);
            echo '</label><br>';
          }
        }
      ?>
    </div>
    <br>
    <button type="button" class="close-popup" id="b1">Xác nhận</button>
  </div>
</form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/chonbapnuoc.js"></script>
</html>
<?php
include('footer.php');
?>