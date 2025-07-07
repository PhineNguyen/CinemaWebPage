<?php
session_start();
include("connect.php");
include("header.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phonenumber = trim($_POST["phonenumber"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Kiểm tra xác nhận mật khẩu
    if ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp.";
    } else {
        // Kiểm tra xem email đã tồn tại chưa
        $checkSql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $error = "Email đã tồn tại.";
        } else {
            // ✅ Mã hóa mật khẩu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Thêm tài khoản mới
            $insertSql = "INSERT INTO users (user_name, email,phone_number, pass_word) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param("ssss", $name,  $email,$phonenumber, $hashed_password); 

            if ($stmt->execute()) {
                $success = "Đăng ký thành công! Bạn có thể <a href='login.php' style='color: lightgreen;'>đăng nhập</a>.";
            } else {
                $error = "Lỗi khi đăng ký. Vui lòng thử lại.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <link rel="stylesheet" href="CSS/LoRe.css"> <!-- Dùng lại CSS của login -->
</head>
<body>
  <div class="login-container">
    <h2>ĐĂNG KÝ</h2>

    <?php if (!empty($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php elseif (!empty($success)): ?>
      <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="register.php">
      <label for="name">Họ và tên</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="phonenumber">Số điện thoại</label>
      <input type="text" id ="phonenumber" name="phonenumber" required>

      <label for="password">Mật khẩu</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm_password">Xác nhận mật khẩu</label>
      <input type="password" id="confirm_password" name="confirm_password" required>

      <button type="submit">Đăng ký</button>
    </form>

    <p class="register-link">Đã có tài khoản? <a href="login.php" style="color:white">Đăng nhập</a></p>
  </div>
</body>
</html>
<?php include("footer.php"); ?>
