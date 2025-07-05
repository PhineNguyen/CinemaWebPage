<?php
include('../connect.php');

// Lấy ID người dùng cần sửa từ URL
$user_id = $_GET['id'] ?? '';
if (!$user_id) {
    exit("Thiếu ID người dùng.");
}

// Lấy dữ liệu người dùng từ CSDL
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    exit("Không tìm thấy người dùng.");
}

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = trim($_POST['user_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone_number']);
    $role = trim($_POST['ro_lo']);
    $status = trim($_POST['account_status']);

    $stmt = $conn->prepare("UPDATE users SET user_name = ?, email = ?, phone_number = ?, ro_lo = ?, account_status = ? WHERE id = ?");
    $stmt->bind_param("ssssss", $user_name, $email, $phone, $role, $status, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công'); window.location.href='taikhoannhansu.php';</script>";
        exit();
    } else {
        $error = "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa người dùng</title>
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css">
</head>
<body>
    <form method="post">
        <h2>Sửa thông tin nhân sự</h2>

        <?php if (!empty($error)): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <label for="user_name">Họ tên:</label>
        <input type="text" name="user_name" id="user_name" value="<?= htmlspecialchars($user['user_name']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label for="phone_number">Số điện thoại:</label>
        <input type="text" name="phone_number" id="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>" required>

        <label for="ro_lo">Vai trò:</label>
        <select name="ro_lo" id="ro_lo" required>
            <option value="admin" <?= $user['ro_lo'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="employee" <?= $user['ro_lo'] === 'employee' ? 'selected' : '' ?>>Nhân viên</option>
        </select>

        <label for="account_status">Trạng thái:</label>
        <select name="account_status" id="account_status">
            <option value="Hoat động" <?= $user['account_status'] === 'Hoat động' ? 'selected' : '' ?>>Hoạt động</option>
            <option value="Ngừng hoạt động" <?= $user['account_status'] === 'Không hoạt động' ? 'selected' : '' ?>>Ngừng hoạt động</option>
        </select>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
