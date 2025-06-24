<?php include('connect.php')?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thông tin liên hệ</title>
  <link rel="stylesheet" href="CSS/lienhe.css">
</head>
<body>

<div class="contact-container">
  <div class="title_contact">
    Thông Tin Liên Hệ Các Chi Nhánh CINETIX
  </div>
<?php
    $sql = "SELECT ci_name, address, city, hotline, email_ci FROM cinemas ORDER BY city, ci_name";
    $result = mysqli_query($conn, $sql);
    if($result && mysqli_num_rows($result) > 0){
       echo '<div class="branch">';
      $current_city = null;
      $current_hotline = null;
      $current_email = null;
      while($detail = mysqli_fetch_assoc($result)){
        if ($current_city !== $detail['city']) {
          if ($current_city !== null) {
            echo '</ul>';
          }
          $current_city = $detail['city'];
          $current_hotline = $detail['hotline'];
          $current_email = $detail['email_ci'];
         
          echo  '<h3>'.'<li>'. htmlspecialchars($current_city) .'</li>'.'</h3>' ;
          echo '<p><strong>Hotline:</strong> ' . htmlspecialchars($current_hotline) . '</p>';
          echo '<p><strong>Email:</strong> ' . htmlspecialchars($current_email) . '</p>';
          echo '<ul class="branch-list">';
          
        }
          echo '<strong>Tên rạp:</strong> ' . htmlspecialchars($detail['ci_name']) . "(" . htmlspecialchars($detail['address']) . ")<br>";
          echo '<br>';
      }
 
      echo '</ul>';
    }else{
      echo "Không có rạp phim nào";
    }
    echo '</div>';
  ?>
  
</div>
</body>
</html>
