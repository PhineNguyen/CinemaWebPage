<?php
include('../connect.php');
// Lấy ID rạp từ URL
$ci_id = $_GET['id'] ?? '';
if (!$ci_id) {
    exit("Thiếu ID rạp.");
}

// Lấy thông tin rạp
$stmt = $conn->prepare("SELECT * FROM cinemas WHERE id = ?");
$stmt->bind_param("s", $ci_id);
$stmt->execute();
$result = $stmt->get_result();
$cinema = $result->fetch_assoc();
$stmt->close();

if (!$cinema) {
    exit("Không tìm thấy rạp.");
}

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ci_name = trim($_POST['ci_name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $ci_status = trim($_POST['ci_status']);

    $stmt = $conn->prepare("UPDATE cinemas SET ci_name = ?, address = ?, city = ?, ci_status = ? WHERE id = ?");
    $stmt->bind_param("sssss", $ci_name, $address, $city, $ci_status, $ci_id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công'); window.location.href='quanlyrapPC.php';</script>";
        exit();
    } else {
        $error = "Lỗi cập nhật: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin rạp</title>
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css">
</head>
<body>
    <form method="post">
        <h2>Sửa thông tin rạp</h2>

        <?php if (!empty($error)): ?>
            <p style="color:red"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <label for="ci_name">Tên rạp:</label>
        <input type="text" name="ci_name" id="ci_name" value="<?= htmlspecialchars($cinema['ci_name']) ?>" required>

        <label for="address">Địa chỉ:</label>
        <input type="text" name="address" id="address" value="<?= htmlspecialchars($cinema['address']) ?>" required>

        <label for="city">Thành phố:</label>
        <input type="text" name="city" id="city" value="<?= htmlspecialchars($cinema['city']) ?>" required>

        <label for="ci_status">Trạng thái:</label>
        <select name="ci_status" id="ci_status">
            <option value="Hoạt động" <?= $cinema['ci_status'] === 'Hoạt động' ? 'selected' : '' ?>>Hoạt động</option>
            <option value="Ngừng hoạt động" <?= $cinema['ci_status'] === 'Không hoạt động' ? 'selected' : '' ?>>Ngừng hoạt động</option>
        </select>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
