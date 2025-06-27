<?php
    session_start();
    include('header_admin.php');
    include('../connect.php');
    $error = "";
// Xử lý khi form được gửi đi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

        if (empty($Email) || empty($password)) {
            $error = "Vui lòng nhập đầy đủ email và mật khẩu.";
        } else {
            $sql = "SELECT * FROM users WHERE email = ? AND ro_lo = 'admin'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows == 1) {
                $user = $result->fetch_assoc();

                if ($password === $user['pass_word']) {
                    // Lưu thông tin đăng nhập
                    $_SESSION["user"] = $user;
                    $_SESSION["email"] = $user['email'];
                    $_SESSION["ro_lo"] = $user['ro_lo'];
                    session_regenerate_id(true); // tăng bảo mật

                    header("Location: admin.php");
                    exit();
                } else {
                    $error = "Mật khẩu không đúng.";
                }
            } else {
                $error = "Tài khoản không tồn tại hoặc không phải admin.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../admin/adminCSS/admin_login.css">
  <link rel="stylesheet" href="../admin/adminCSS/header_admin.css">
</head>

<body>
    <div class="login-container">
        <h2>Đăng Nhập Tài Khoản Admin</h2>

        <form method="POST" action="admin_login.php">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Email" required><br/>
            
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required><br/>
            
            <button type="submit">Đăng Nhập</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../"></script>
</body>
</html>