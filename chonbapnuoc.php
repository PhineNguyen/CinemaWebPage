<?php
include('header.php');
include('connect.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
      <div class="combo-list">
        <h2>Combo - Bắp nước</h2>
        
        <!-- List -->
        <?php 
        $sql="SELECT * FROM foods id LIMIT 3,4"; //Lấy dòng thứ 4 đến 7
        $result=$conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="combo-item" data-combo="' . htmlspecialchars($row['id']) . '">';
            echo '  <img src="' . htmlspecialchars($row['food_images']) . '" alt="' . htmlspecialchars($row['namef']) . '">';
            echo '  <div class="combo-info">';
            echo '    <h3>' . htmlspecialchars($row['namef']) . '</h3>';
            echo '    <p class="vibap" style="font-size: 12px;"></p>';
            echo '    <p class="price">' . number_format($row['price'], 0, ',', '.') . 'đ</p>';
            echo '    <div class="quantity-control">';
            echo '      <button class="minus">-</button>';
            echo '      <input type="number" value="0" min="0">';
            echo '      <button class="plus">+</button>';
            echo '    </div>';
            echo '  </div>';
            echo '  <button class="select" id="chang' . htmlspecialchars($row['id']) . '"  style="background-color: orange; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
            >Thay đổi</button>';
            echo '</div>';
          }
        }
        ?>
        
        <!-- GẠCH NGANG -->
        <hr style="border: 2px solid white; width: 100%">

        <!-- KHUNG TOTAL -->
        <div id="total-box" style="background-color:white; /* Nền tối hài hòa với theme */
          color: black; /* Chữ trắng nổi bật */
          padding: 12px 20px; /* Khoảng cách bên trong */
          border-radius: 8px; /* Bo góc nhẹ */
          width: 575px; /* Cùng chiều rộng với combo-item */
          margin: 0 auto; /* Căn giữa */
          font-size: 16px; /* Kích thước chữ dễ đọc */
          font-weight: bold; /* Chữ đậm cho tiêu đề */ ">
          <div>
            Tổng tiền:
            <span id="total-price" style="text-align: right;">0đ</span>
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


<!-- FORM CHỌN VỊ BẮP -->
 <form id="popup-bap" class="popup-form" style="display: none;">
  <div class="popup-content">
    <h3>Chọn vị bắp</h3>
    <div id="corn-options">
      <?php 
        $food_sql = "SELECT * FROM foods ORDER BY id ASC LIMIT 3 ";
        $food_result = $conn->query($food_sql);
        if ($food_result->num_rows > 0) {
          while ($food = $food_result->fetch_assoc()) {
            echo '<label>';
            echo '<input type="radio" name="vi_bap" value="' . htmlspecialchars($food['id']) . '" 
                    data-name="' . htmlspecialchars($food['namef']) . '" 
                    data-price="' . number_format($food['price'], 0, ',', '.') . 'đ"> ';
            echo htmlspecialchars($food['namef']);
            echo '</label><br>';
          }
        }
      ?>
    </div>
    <br>
    <button type="button" class="close-popup" id="b2">Xác nhận</button>
  </div>
</form>

<!-- FORM CHỌN VỊ BẮP 2 -->
 <form id="popup-bap2" class="popup-form" style="display: none;">
  <div class="popup-content">
    <h3>Chọn vị bắp</h3>
    <div id="corn-options">
      <?php 
        $food_sql = "SELECT * FROM foods ORDER BY id ASC LIMIT 3 ";
        $food_result = $conn->query($food_sql);
        if ($food_result->num_rows > 0) {
          while ($food = $food_result->fetch_assoc()) {
            echo '<label>';
            echo '<input type="radio" name="vi_bap" value="' . htmlspecialchars($food['id']) . '" 
                    data-name="' . htmlspecialchars($food['namef']) . '"> ';
            echo htmlspecialchars($food['namef']);
            echo '</label><br>';
          }
        }
      ?>
    </div>
    <br>
    <button type="button" class="close-popup" id="b3">Xác nhận</button>
  </div>
</form>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/chonbapnuoc.js"></script>
</html>


<?php
include('footer.php');
?>