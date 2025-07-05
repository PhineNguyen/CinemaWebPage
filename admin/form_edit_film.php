<?php
include('../connect.php');
// Lấy ID phim
$movie_id = $_GET['id'] ?? '';
if (!$movie_id) {
    exit("Thiếu ID phim.");
}

// Truy vấn lấy thông tin phim
$stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->bind_param("s", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
$stmt->close();

if (!$movie) {
    exit("Không tìm thấy phim.");
}

// Xử lý form cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $image_url = trim($_POST['image_url']);
    $release_date = trim($_POST['release_date']);
    $genre = trim($_POST['genre']);
    $lgs = trim($_POST['lgs']);
    $age_rating = trim($_POST['age_rating']);
    $status = trim($_POST['status']);

    $stmt = $conn->prepare("UPDATE movies SET title = ?, image_url = ?, release_date = ?, genre = ?, lgs = ?, age_rating = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssssssss", $title, $image_url, $release_date, $genre, $lgs, $age_rating, $status, $movie_id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công'); window.location.href='quanlyphim.php';</script>";
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
    <title>Sửa phim</title>
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css">
</head>
<body>
    <form method="post">
        <h2>Sửa thông tin phim</h2>

        <?php if (!empty($error)): ?>
            <p style="color:red"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <label for="title">Tên phim:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($movie['title']) ?>" required>

        <label for="image_url">Link Poster:</label>
        <input type="url" name="image_url" id="image_url" value="<?= htmlspecialchars($movie['image_url']) ?>" required>

        <label for="release_date">Năm phát hành:</label>
        <input type="date" name="release_date" id="release_date" value="<?= htmlspecialchars($movie['release_date']) ?>" required>

        <label for="genre">Thể loại:</label>
        <input type="text" name="genre" id="genre" value="<?= htmlspecialchars($movie['genre']) ?>" required>

        <label for="lgs">Ngôn ngữ:</label>
        <input type="text" name="lgs" id="lgs" value="<?= htmlspecialchars($movie['lgs']) ?>" required>

        <label for="age_rating">Giới hạn độ tuổi:</label>
        <input type="text" name="age_rating" id="age_rating" value="<?= htmlspecialchars($movie['age_rating']) ?>" required>

        <label for="status">Trạng thái:</label>
        <select name="status" id="status">
            <option value="Đang chiếu" <?= $movie['status'] === 'Đang chiếu' ? 'selected' : '' ?>>Đang chiếu</option>
            <option value="Ngừng chiếu" <?= $movie['status'] === 'Ngừng chiếu' ? 'selected' : '' ?>>Ngừng chiếu</option>
            <option value="Sắp chiếu" <?= $movie['status'] === 'Sắp chiếu' ? 'selected' : '' ?>>Sắp chiếu</option>
        </select>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
