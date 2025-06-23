<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/chonbapnuoc.css">
</head>
<body>
    <div class="main-contain">
      <div class="combo-list">
        <h2>Combo - Bắp nước</h2>

        <!-- Combo 1 -->
        <div class="combo-item" data-combo="1">
          <img src="pic/combo1big.jpg" alt="Combo 1 big">
          <div class="combo-info">
            <h3>Combo 1 big</h3>
            <p class="price">89.000đ</p>
            <div class="quantity-control">
              <button class="minus">-</button>
              <input type="number" value="0" min="0">
              <button class="plus">+</button>
            </div>
          </div>
          <button class="select" id="chang1" style="background-color: orange; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
            >Thay đổi</button>
        </div>

        <!-- Combo 2 -->
        <div class="combo-item" data-combo="2">
          <img src="pic/combo2big.jpg" alt="Combo 2 big">
          <div class="combo-info">
            <h3>Combo 2 big</h3>
            <p class="price">109.000đ</p>
            <div class="quantity-control">
              <button class="minus">-</button>
              <input type="number" value="0" min="0">
              <button class="plus">+</button>
            </div>
          </div>
          <button class="select" id="chang2" style="background-color: orange; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
            >Thay đổi</button>
        </div>

        <!-- Nước lẻ -->
        <div class="combo-item" id="nuoc">
          <img src="pic/coca cola.jpg" alt="Nước lẻ">
          <div class="combo-info">
            <h3>Coca cola</h3>
            <p class="price">49.000đ</p>
            <div class="quantity-control">
              <button class="minus">-</button>
              <input type="number" value="0" min="0">
              <button class="plus">+</button>
            </div>
          </div>
          <button class="select" style="background-color: orange; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
            >Chọn loại nước</button>
        </div>

        <!-- Bắp lẻ -->
        <div class="combo-item" id="bap">
          <img src="pic/bap.jpg" alt="Bắp lẻ">
          <div class="combo-info">
            <h3>Bắp</h3>
            <p class="price">49.000đ</p>
            <div class="quantity-control">
              <button class="minus">-</button>
              <input type="number" value="0" min="0">
              <button class="plus">+</button>
            </div>
          </div>
          <button class="select" style="background-color: orange; color: black;border: none;padding: 6px 12px;border-radius: 6px;font-weight: bold;cursor: pointer;margin-left: 200px;" 
          >Chọn vị bắp</button>
        </div>

      </div>
      <div class="combo-footer">
        <button class="continue-btn">Quay lại</button>
        <button class="continue-btn">Tiếp tục</button>
      </div>

    </div>

<!-- FORM CHỌN LOẠI NƯỚC -->
<form id="popup-nuoc" class="popup-form">
  <div class="popup-content">
    <h3>Chọn loại nước</h3>
    <label><input type="radio" name="loai_nuoc" value="Milo"
    data-name="Milo" data-price="45.000đ" data-img="pic/milo.jpg"> Milo</label><br>
    <label><input type="radio" name="loai_nuoc" value="Coca Cola"
    data-name="Coca Cola" data-price="49.000đ" data-img="pic/coca cola.jpg"> Coca Cola</label><br>
    <label><input type="radio" name="loai_nuoc" value="Pepsi"
    data-name="Sprite" data-price="48.000đ" data-img="pic/sprite.jpg"> Sprite</label><br>
    <label><input type="radio" name="loai_nuoc" value="Fanta"
    data-name="Fanta" data-price="47.000đ" data-img="pic/fanta.jpg"> Fanta</label><br><br>
    <button type="button" class="close-popup">Xác nhận</button>
  </div>
</form>

<!-- FORM CHỌN VỊ BẮP -->
<form id="popup-bap" class="popup-form">
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
</form>

<!-- FORM CHỌN BẮP & NƯỚC -->
<form id="popup-combo" class="popup-form" style="display:none;">
  <div class="popup-content">
    <h3>Chọn vị bắp</h3>
    <div id="bap-options">
      <label><input type="radio" name="vi_bap" value="Bơ"> Bơ</label><br>
      <label><input type="radio" name="vi_bap" value="Phô mai"> Phô mai</label><br>
      <label><input type="radio" name="vi_bap" value="Caramel"> Caramel</label><br><br>
    </div>

    <h3>Chọn loại nước</h3>
    <div id="nuoc-options">
      <label><input type="checkbox" name="nuoc" value="Milo"> Milo</label><br>
      <label><input type="checkbox" name="nuoc" value="Coca Cola"> Coca Cola</label><br>
      <label><input type="checkbox" name="nuoc" value="Sprite"> Sprite</label><br>
      <label><input type="checkbox" name="nuoc" value="Fanta"> Fanta</label><br><br>
    </div>

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