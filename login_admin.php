<?php
// Bắt đầu phiên làm việc và kết nối CSDL
session_start();
include("connect.php");

// Khởi tạo biến lỗi rỗng
$error = "";

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["user_name"]);
    $password = trim($_POST["password"]);

    // Truy vấn người dùng theo username và role = 'admin'
    $sql = "SELECT * FROM users WHERE user_name = ? AND ro_lo = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả
    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // So sánh mật khẩu (nếu bạn chưa dùng hash)
        if ($password === $user['pass_word']) {
            $_SESSION["user_name"] = $user['user_name'];
            $_SESSION["ro_lo"] = $user['ro_lo'];
            header("Location: admin.php"); // chuyển hướng sau khi đăng nhập
            exit();
        } else {
            $error = "Mật khẩu không đúng.";
        }
    } else {
        $error = "Chỉ có admin mới được phép đăng nhập.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="CSS/login_admin.css">
</head>
<body>
    <div class="khunglogin">
        <!--Khung tiêu đề-->
        <div class="ktieude">
            <div>LOGIN</div>
        </div>

        <!-- Form đăng nhập -->
        <form method="POST" action="login_admin.php">
            <div class="knhap">
                <div>
                    <input type="text" name="user_name" placeholder="Username" required><br/>
                </div>
                <div>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>

            <!-- Thông báo lỗi -->
        <?php if (!empty($error)): ?>
            <div style="color: red; text-align: center; margin-bottom: 10px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

            <div class="kchucnang">
                <div>
                    <input type="checkbox" name="remember"> Remember Me 
                </div>
                <div>
                    <a href="#">Forgot Password?</a>
                </div>
            </div>

            <div class="ksubmit">
                <div>
                    <button type="submit">Sign In</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/login_admin.js"></script>
</body>
</html>