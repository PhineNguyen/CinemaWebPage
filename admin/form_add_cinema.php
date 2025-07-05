<?php
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idrap = trim($_POST['idrap']);
    $tenrap = trim($_POST['tenrap']);
    $diachi = trim($_POST['diachi']);
    $thanhpho = trim($_POST['thanhpho']);
    $trangthai = 'Hoạt động'; // Mặc định là hoạt động

    $stmt = $conn->prepare("INSERT INTO cinemas (id, ci_name, address, city, ci_status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $idrap, $tenrap, $diachi, $thanhpho, $trangthai);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm rạp thành công'); window.location.href='quanlyrapPC.php';</script>";
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
    <title>Thêm Rạp</title>
    <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
    <link rel="stylesheet" href="../admin/adminCSS/header_admin.css">
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css"> <!-- Dùng lại form CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php include('header_admin.php'); ?>

    <form method="post">
        <h2>Thêm rạp mới</h2>

        <label for="idrap">Mã rạp:</label>
        <input type="text" name="idrap" id="idrap" required>

        <label for="tenrap">Tên rạp:</label>
        <input type="text" name="tenrap" id="tenrap" required>

        <label for="diachi">Địa chỉ:</label>
        <input type="text" name="diachi" id="diachi" required>

        <label for="thanhpho">Thành phố:</label>
        <input type="text" name="thanhpho" id="thanhpho" required>

         <label for="status">Trạng thái:</label>
        <select name="account_status" id="status" disabled>
            <option value="active" selected >Hoạt động</option>
        </select>

        <button type="submit"><i class="fa fa-save"></i> Lưu </button>
    </form>
</body>
</html>
