<?php
include('connect.php');
include('header.php');

$seats = $_POST['seats'] ?? '';
$showtime_id = $_POST['showtime_id'] ?? '';
$total_price = $_POST['total_price'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chọn bắp nước</title>
  <link rel="stylesheet" href="CSS/chonbapnuoc.css">
</head>
<body>
    <!-- Menu điều hướng dạng tab -->
    <nav class="nav-item">
      <a href="#" id="tab-home" class="active">BẮP NƯỚC</a>
      <a href="#" id="rap-cinetix-tab">RẠP CINETIX</a>
      <a href="#" id="gia-ve-tab">GIÁ VÉ</a>
      <a href="#" id="lien-he-tab">LIÊN HỆ</a>
    </nav>

    <div id="main-content">
      <div class="main-contain">
    <div class="header">Combo - Bắp nước</div>

    <?php
      $sql_cb = "SELECT * FROM foods id LIMIT 1,2";
      $combo = $conn->query($sql_cb);

      if ($combo->num_rows > 0) {
          while($row = $combo->fetch_assoc()) {
              echo '
              <div class="combo-item" id="combo-bapnuoc">
                  <div class="combo-icon">
                      <img src="' . $row["food_images"] . '" alt="' . $row["namef"] . '">
                  </div>
                  <div class="combo-info">
                      <h3>' . $row["namef"] . '</h3>
                      <span class="combo-description">' . $row["descript"] . '</span>
                      <p class="combo-price">' . number_format($row["price"], 0, ',', '.') . 'đ</p>
                  </div>
                  <div class="quantity-controls">
                      <button class="minus" disabled>-</button>
                      <div class="quantity-display">0</div>
                      <button class="plus">+</button>
                  </div>
              </div>';
          }
      } else {
          echo "Không có combo nào.";
      }
    ?>

    <!-- Bắp Section -->
    <div class="header">Bắp</div>

     <?php
      $sql_bap = "SELECT * FROM foods WHERE id = 'B03' ";
      $result_bap = $conn->query($sql_bap);

      if ($result_bap->num_rows > 0) {
          while($row = $result_bap->fetch_assoc()) {
              echo '
              <div class="combo-item" id="bap">
                  <div class="combo-icon">
                      <img src="' . $row["food_images"] . '" alt="' . $row["namef"] . '">
                  </div>
                  <div class="combo-info">
                      <h3>' . $row["namef"] . '</h3>
                      <p class="combo-price">' . number_format($row["price"], 0, ',', '.') . 'đ</p>
                  </div>
                  <div class="quantity-controls">
                      <button class="minus" disabled>-</button>
                      <div class="quantity-display">0</div>
                      <button class="plus">+</button>
                  </div>
              </div>
              <div class="flavor-options">
                <label class="flavor-label"><input type="radio" name="bap_flavor" value="pho-mai"> Phô mai</label>
                <label class="flavor-label"><input type="radio" name="bap_flavor" value="caramel"> Caramel</label>
                <label class="flavor-label"><input type="radio" name="bap_flavor" value="bo"> Bơ</label>
               </div>';
            }
      } else {
          echo "Không có bắp nào.";
      }
    ?>

    <!-- Nước Section -->
    <div class="header" >Nước</div>

    <?php
      $sql_nuoc = "SELECT 
                    f.*, 
                    fv_lon.price AS size_lon_price,
                    fv_nho.price AS size_nho_price
                FROM 
                    (SELECT * FROM foods ORDER BY id DESC LIMIT 4) AS f
                LEFT JOIN 
                    food_variants fv_lon ON f.id = fv_lon.food_id AND fv_lon.size = 'Lớn'
                LEFT JOIN 
                    food_variants fv_nho ON f.id = fv_nho.food_id AND fv_nho.size = 'Nhỏ';";
      $result_nuoc = $conn->query($sql_nuoc);

      if ($result_nuoc->num_rows > 0) {
          while($row = $result_nuoc->fetch_assoc()) {
              echo '
              <div class="combo-item" id="nuoc" >
                  <div class="combo-icon">
                      <img src="' . $row["food_images"] . '" alt="' . $row["namef"] . '">
                  </div>
                  <div class="combo-info">
                      <h3>' . $row["namef"] . '</h3>
                      <p class="combo-price">' . number_format($row["price"], 0, ',', '.') . 'đ</p>
                  </div>
                  <div class="quantity-controls">
                      <button class="minus" disabled>-</button>
                      <div class="quantity-display">0</div>
                      <button class="plus">+</button>
                  </div>
              </div>
              <div class="flavor-options">
                <label class="flavor-label"><input type="checkbox" name="size_flavor" value="lon" data-price="' . $row["size_lon_price"] . '"> Size lớn</label>
                <label class="flavor-label"><input type="checkbox" name="size_flavor" value="nho" data-price="' . $row["size_nho_price"] . '"> Size nhỏ</label>
              </div>';
            }
      } else {
          echo "Không có nước nào.";
      }
    ?>

    <!-- Tổng tiền -->
    <div id="total-box">
      <div style="font-weight: bold;">
        Tổng tiền: <span id="total-price">0đ</span>
      </div>
    </div>

    <!-- Nút -->
    <div class="combo-footer">
      <button class="continue-btn"id="back">Quay lại</button>
      <button class="continue-btn"id="continue">Tiếp tục</button>
  
    </div>
      </div>
    </div>

    <!-- Các vùng nội dung động giống Home -->
    <div id="rap-cinetix-content" style="display:none;"></div>
    <div id="gia-ve-content" style="display:none;"></div>
    <div id="lien-he-content" style="display:none;"></div>

    <!-- JS -->
    <script>
      const TOTAL = "<?= htmlspecialchars($total_price) ?>";
      const SEATS = "<?= htmlspecialchars($seats) ?>";
      const SHOWTIME_ID = "<?= htmlspecialchars($showtime_id) ?>";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/chonbapnuoc.js"></script>
    <script src="js/Home.js"></script>
    <script src="js/rolltab.js"></script>
</body>
</html>
<?php include('footer.php'); ?>
