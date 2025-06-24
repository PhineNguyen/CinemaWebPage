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
        <!-- Nước lẻ  -->
          <?php 
        $sql="select * from foods where id = 'N04'";
        $result=$conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
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
            echo '  <button class="select" id="chang2" style="background-color: orange; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
            >Thay đổi</button>';
            echo '</div>';
          }
        }
        ?>
        
        <!-- Bắp - CB1 - CB2 -->
        <?php 
        $sql="SELECT * FROM foods ORDER BY id ASC LIMIT 3";
        $result=$conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
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
            echo '  <button class="select" id="chang2" style="background-color: orange; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
            >Thay đổi</button>';
            echo '</div>';
          }
        }
        ?>
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
    <button type="button" class="close-popup">Xác nhận</button>
  </div>
</form>


<!-- FORM CHỌN VỊ BẮP -->
<!-- <form id="popup-bap" class="popup-form">
  <div class="popup-content">
    <h3>Chọn vị bắp</h3>
    <label><input type="radio" name="vi_bap" value="Bơ"
    data-name="Bắp vị bơ" data-price="55.000đ"> Bơ</label><br>
    <label><input type="radio" name="vi_bap" value="Phô mai"
    data-name="Bắp vị phô mai" data-price="55.000đ"> Phô mai</label><br>
    <label><input type="radio" name="vi_bap" value="Caramel"
    data-name="Bắp vị caramel" data-price="55.000đ"> Caramel</label><br><br>
    <button type="button" class="close-popup">Xác nhận</button>
  </div>
</form> -->


<!-- FORM CHỌN BẮP & NƯỚC -->
<form id="popup-combo" class="popup-form" style="display: none;">
  <div class="popup-content">
    <h3>Chọn vị bắp</h3>
    <div id="bap-options">
      <?php 
        $bap_sql = "SELECT * FROM foods WHERE category = 'bap'";
        $bap_result = $conn->query($bap_sql);
        if ($bap_result->num_rows > 0) {
          while ($bap = $bap_result->fetch_assoc()) {
            echo '<label>';
            echo '<input type="radio" name="vi_bap" value="' . htmlspecialchars($bap['id']) . '" 
                    data-name="' . htmlspecialchars($bap['namef']) . '" 
                    data-price="' . number_format($bap['price'], 0, ',', '.') . 'đ"> ';
            echo htmlspecialchars($bap['namef']);
            echo '</label><br>';
          }
        }
      ?>
    </div>

    <h3>Chọn loại nước</h3>
    <div id="nuoc-options">
      <?php 
        $nuoc_sql = "SELECT * FROM foods ORDER BY id DESC LIMIT 4 ";
        $nuoc_result = $conn->query($nuoc_sql);
        if ($nuoc_result->num_rows > 0) {
          while ($nuoc = $nuoc_result->fetch_assoc()) {
            echo '<label>';
            echo '<input type="radio" name="loai_nuoc" value="' . htmlspecialchars($nuoc['id']) . '" 
                    data-name="' . htmlspecialchars($nuoc['namef']) . '" 
                    data-price="' . number_format($nuoc['price'], 0, ',', '.') . 'đ" 
                    data-img="' . htmlspecialchars($nuoc['food_images']) . '"> ';
            echo htmlspecialchars($nuoc['namef']);
            echo '</label><br>';
          }
        }
      ?>
    </div>

    <br>
    <button type="button" class="close-popup">Xác nhận</button>
  </div>
</form> 


</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/chonbapnuoc.js"></script>
</html>


<?php
include('footer.php');
?>