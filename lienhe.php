<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>
  <link rel="stylesheet" href="CSS/Home.css" />
  <link rel="stylesheet" href="CSS/lienhe.css" />
</head>
<body>

<?php
include('connect.php');

echo '<div class="contact-container">';
echo '<div class="title_contact">Thông Tin Liên Hệ Các Chi Nhánh CINETIX</div>';

$sql = "SELECT ci_name, address, city, hotline, email_ci FROM cinemas ORDER BY city, ci_name";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="branch">';
    $current_city = null;
    while ($detail = mysqli_fetch_assoc($result)) {
        if ($current_city !== $detail['city']) {
            if ($current_city !== null) echo '</ul>';
            $current_city = $detail['city'];
            echo '<h3><li>' . htmlspecialchars($current_city) . '</li></h3>';
            echo '<p><strong>Hotline:</strong> ' . htmlspecialchars($detail['hotline']) . '</p>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($detail['email_ci']) . '</p>';
            echo '<ul class="branch-list">';
        }
        echo '<li><strong>Tên rạp:</strong> ' . htmlspecialchars($detail['ci_name']) . ' (' . htmlspecialchars($detail['address']) . ')</li>';
    }
    echo '</ul></div>';
} else {
    echo "<p>Không có rạp phim nào.</p>";
}

echo '</div>';
?>
