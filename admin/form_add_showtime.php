<?php
include('../connect.php');

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $ticket_price = (float)$_POST['ticket_price'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $room_id = $_POST['room_id'];

    // Thêm lịch chiếu mới vào bảng showtimes
    $stmt = $conn->prepare("INSERT INTO showtimes (movie_id, room_id, show_date, show_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $movie_id, $room_id, $show_date, $show_time);

    if ($stmt->execute()) {
        // Cập nhật giá vé phim nếu cần (giả sử trong bảng movies có cột ticket_price)
        $update = $conn->prepare("UPDATE movies SET ticket_price = ? WHERE id = ?");
        $update->bind_param("di", $ticket_price, $movie_id);
        $update->execute();
        $update->close();

        echo "<script>alert('Thêm lịch chiếu thành công'); window.location.href='quanlysuatchieu.php';</script>";
    } else {
        echo "<p style='color:red;'>Lỗi: {$stmt->error}</p>";
    }
    $stmt->close();
}

// Lấy dữ liệu cho dropdown phim và rạp
$movies = mysqli_query($conn, "SELECT id, title FROM movies");
$cinemas = mysqli_query($conn, "SELECT id, ci_name FROM cinemas");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm lịch chiếu phim</title>
    <link rel="stylesheet" href="../admin/adminCSS/admin_layout.css">
    <link rel="stylesheet" href="../admin/adminCSS/header_admin.css">
    <link rel="stylesheet" href="../admin/adminCSS/form_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include('header_admin.php'); ?>

<form method="post">
    <h2>Thêm lịch chiếu phim</h2>

    <label for="movie_id">Tên phim:</label>
    <select name="movie_id" id="movie_id" required>
        <option value="">-- Chọn phim --</option>
        <?php while ($row = mysqli_fetch_assoc($movies)) : ?>
            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></option>
        <?php endwhile; ?>
    </select>

    <label for="ticket_price">Giá vé (VNĐ):</label>
    <input type="number" name="ticket_price" id="ticket_price" min="10000" step="1000" required>

    <label for="show_date">Ngày chiếu:</label>
    <input type="date" name="show_date" id="show_date" required>

    <label for="show_time">Giờ chiếu:</label>
    <input type="time" name="show_time" id="show_time" required>

    <label for="cinema_id">Rạp chiếu:</label>
    <select name="cinema_id" id="cinema_id" required>
        <option value="">-- Chọn rạp --</option>
        <?php while ($row = mysqli_fetch_assoc($cinemas)) : ?>
            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['ci_name']); ?></option>
        <?php endwhile; ?>
    </select>

    <label for="room_id">Phòng chiếu:</label>
    <select name="room_id" id="room_id" required>
        <option value="">-- Chọn phòng --</option>
    </select>

    <button type="submit"><i class="fa fa-save"></i> Lưu</button>
</form>

<script>
    $(document).ready(function () {
        $('#cinema_id').on('change', function () {
            var cinemaId = $(this).val();
            $('#room_id').html('<option>Đang tải...</option>');

            if (cinemaId) {
                $.get('get_rooms.php', { cinema_id: cinemaId }, function (data) {
                    var options = '<option value="">-- Chọn phòng --</option>';
                    data.forEach(function (room) {
                        options += `<option value="${room.id}">Phòng ${room.room_number}</option>`;
                    });
                    $('#room_id').html(options);
                });
            } else {
                $('#room_id').html('<option value="">-- Chọn phòng --</option>');
            }
        });
    });
</script>
</body>
</html>
