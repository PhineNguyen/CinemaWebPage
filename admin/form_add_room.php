<?php
include('../connect.php');

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idphong = trim($_POST['idphong']);
    $tenphong = trim($_POST['tenphong']);
    $idrap = $_POST['idrap'];
    $soluongghe = (int)$_POST['soluongghe'];
    $trangthai = 'Phòng trống'; // Mặc định là hoạt động

    $stmt = $conn->prepare("INSERT INTO rooms (id, room_number, cinema_id, total_seats, room_status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $idphong, $tenphong, $idrap, $soluongghe, $trangthai);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm phòng thành công'); window.location.href='quanlyrapPC.php';</script>";
    } else {
        echo "<p style='color:red;'>Lỗi: {$stmt->error}</p>";
    }
    $stmt->close();
}

// Lấy danh sách rạp để đổ vào dropdown
$raps = mysqli_query($conn, "SELECT id, ci_name FROM cinemas");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm phòng chiếu</title>
    <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
    <link rel="stylesheet" href="../admin/adminCSS/header_admin.css">
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css"> <!-- Dùng lại CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include('header_admin.php'); ?>

<form method="post">
    <h2>Thêm phòng chiếu</h2>

    <label for="idphong">Mã phòng:</label>
    <input type="text" name="idphong" id="idphong" required>

    <label for="tenphong">Tên phòng:</label>
    <input type="text" name="tenphong" id="tenphong" required>

    <label for="idrap">Thuộc rạp:</label>
    <select name="idrap" id="idrap" required>
        <option value="">-- Chọn rạp --</option>
        <?php while ($row = mysqli_fetch_assoc($raps)) : ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['ci_name']; ?></option>
        <?php endwhile; ?>
    </select>

    <label for="soluongghe">Số lượng ghế:</label>
    <input type="number" name="soluongghe" id="soluongghe" min="1" required>

     <label for="status">Trạng thái:</label>
        <select name="account_status" id="status" disabled>
            <option value="active" selected >Phòng trống</option>
        </select>

    <button type="submit"><i class="fa fa-save"></i> Lưu</button>
</form>
</body>
</html>
