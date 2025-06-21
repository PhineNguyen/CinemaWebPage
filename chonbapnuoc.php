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
    <div class="combo-item">
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
    </div>

    <!-- Combo 2 -->
    <div class="combo-item">
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
    </div>

  </div>

  <div class="combo-footer">
    <button class="continue-btn">Tiếp tục</button>
  </div>
</div>
</body>
</html>
<?php
include('footer.php');
?>