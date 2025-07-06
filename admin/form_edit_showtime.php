<?php
include('../connect.php');

// Lấy ID suất chiếu cần sửa
$showtime_id = $_GET['id'] ?? '';
if (!$showtime_id) {
    exit("Thiếu ID suất chiếu.");
}

// Truy vấn dữ liệu suất chiếu
$stmt = $conn->prepare("SELECT * FROM showtimes WHERE id = ?");
$stmt->bind_param("i", $showtime_id);
$stmt->execute();
$result = $stmt->get_result();
$showtime = $result->fetch_assoc();
$stmt->close();

if (!$showtime) {
    exit("Không tìm thấy suất chiếu.");
}

// Xử lý cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $room_id = $_POST['room_id'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];

    $stmt = $conn->prepare("UPDATE showtimes SET movie_id = ?, room_id = ?, show_date = ?, show_time = ? WHERE id = ?");
    $stmt->bind_param("iissi", $movie_id, $room_id, $show_date, $show_time, $showtime_id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật suất chiếu thành công!'); window.location.href='quanlysuatchieu.php';</script>";
        exit();
    } else {
        $error = "Lỗi khi cập nhật: " . $stmt->error;
    }
    $stmt->close();
}

// Lấy danh sách phim và phòng
$movies = mysqli_query($conn, "SELECT id, title FROM movies");
$rooms = mysqli_query($conn, "SELECT id, room_number FROM rooms");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa suất chiếu</title>
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css">
</head>
<body>
    <form method="post">
        <h2>Sửa thông tin suất chiếu</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <label for="movie_id">Phim:</label>
        <select name="movie_id" id="movie_id" required>
            <?php while ($movie = mysqli_fetch_assoc($movies)): ?>
                <option value="<?= $movie['id'] ?>" <?= $movie['id'] == $showtime['movie_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($movie['title']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="room_id">Phòng chiếu:</label>
        <select name="room_id" id="room_id" required>
            <?php while ($room = mysqli_fetch_assoc($rooms)): ?>
                <option value="<?= $room['id'] ?>" <?= $room['id'] == $showtime['room_id'] ? 'selected' : '' ?>>
                    Phòng <?= htmlspecialchars($room['room_number']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="show_date">Ngày chiếu:</label>
        <input type="date" name="show_date" id="show_date" value="<?= $showtime['show_date'] ?>" required>

        <label for="show_time">Giờ chiếu:</label>
        <input type="time" name="show_time" id="show_time" value="<?= $showtime['show_time'] ?>" required>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
