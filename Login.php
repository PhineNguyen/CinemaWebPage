<?php
// Bắt đầu phiên làm việc và kết nối CSDL
session_start();
include("connect.php");
include("header.php");

// Khởi tạo biến lỗi rỗng
$error = "";

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Truy vấn người dùng theo email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả
    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Kiểm tra mật khẩu (có thể dùng password_verify nếu có hash)
        if ($password === $user['pass_word']) {
            $_SESSION["user"] = $user;
            header("Location: Home.php");
            exit();
        } else {
            $error = "Mật khẩu không đúng.";
        }
    } else {
        $error = "Tài khoản không tồn tại.";
    }
}
?>
<div class="separator-line"></div>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="CSS/LoRe.css"> <!-- File CSS riêng -->
</head>
<body>
  <div class="login-container">
    <h2>ĐĂNG NHẬP</h2>

    <?php if (!empty($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Mật khẩu</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Đăng nhập</button>
    </form>

    <p class="register-link">Chưa có tài khoản? <a href="register.php" style="color:white">Đăng ký</a></p>
  </div>


</body>
</html>
  <?php include("footer.php"); ?>