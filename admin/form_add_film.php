<?php
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $film_name = trim($_POST['film_name']);
    $poster = trim($_POST['poster']);
    $release_year = trim($_POST['release_year']);
    $genre = trim($_POST['genre']);
    $language = trim($_POST['language']);
    $age_limit = trim($_POST['age_limit']);
    $status = $_POST['status']; // Lấy trạng thái từ select

    $stmt = $conn->prepare("INSERT INTO movies (title, image_url, release_date, genre, lgs, age_rating, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $film_name, $poster, $release_year, $genre, $language, $age_limit, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm phim thành công'); window.location.href='quanlyphim.php';</script>";
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
    <title>Thêm phim</title>
    <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
    <link rel="stylesheet" href="../admin/adminCSS/header_admin.css">
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php include('header_admin.php'); ?>

    <form method="post">
        <h2>Thêm phim mới</h2>

        <label for="film_name">Tên phim:</label>
        <input type="text" name="film_name" id="film_name" required>

        <label for="poster">Poster (URL):</label>
        <input type="url" name="poster" id="poster" required>

        <label for="release_year">Năm phát hành:</label>
        <input type="date" name="release_year" id="release_year" required>

        <label for="genre">Thể loại:</label>
        <input type="text" name="genre" id="genre" required>

        <label for="language">Ngôn ngữ:</label>
        <input type="text" name="language" id="language" required>

        <label for="age_limit">Giới hạn độ tuổi:</label>
        <input type="text" name="age_limit" id="age_limit" required>

        <label for="status">Trạng thái:</label>
        <select name="status" id="status" required>
            <option value="Đang chiếu" selected>Đang chiếu</option>
            <option value="Sắp chiếu">Sắp chiếu</option>
        </select>

        <button type="submit"><i class="fa fa-save"></i> Lưu </button>
    </form>
</body>
</html>
