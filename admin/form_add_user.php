<?php
include('../connect.php');

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = trim($_POST['id']);
    $user_name = trim($_POST['user_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone_number']);
    $role = 'user'; // Mặc định là user
    $status = 'Hoat động'; // Mặc định là hoạt động

    $stmt = $conn->prepare("INSERT INTO users (id, user_name, email, phone_number, ro_lo, account_status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $user_id, $user_name, $email, $phone, $role, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm người dùng thành công'); window.location.href='taikhoannguoidung.php';</script>";
    } else {
        echo "<p style='color:red;'>Lỗi: {$stmt->error}</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm người dùng</title>
    <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
    <link rel="stylesheet" href="../admin/adminCSS/header_admin.css">
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php include('header_admin.php'); ?>

    <form method="post">
        <h2>Thêm người dùng</h2>
        
        <label for="user_id">ID khách hàng:</label>
        <input type="text" name="id" id="user_id" required>

        <label for="user_name">Họ tên:</label>
        <input type="text" name="user_name" id="user_name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Số điện thoại:</label>
        <input type="text" name="phone_number" id="phone" required>

        <label for="role">Vai trò:</label>
        <select id="role" required>
            <option selected>Người dùng</option>
        </select>

        <label for="status">Trạng thái tài khoản:</label>
        <select name="account_status" id="status" disabled>
            <option value="active" selected >Hoạt động</option>
        </select>

        <button type="submit"><i class="fa fa-save"></i> Lưu </button>
    </form>
</body>
</html>
