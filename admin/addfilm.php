<?php
// Kết nối CSDL
include("../connect.php");

// Kiểm tra nếu form đã gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $title = trim($_POST['title']);
    $image_url = trim($_POST['image_url']);
    $release_date = $_POST['release_date'];
    $genre = trim($_POST['genre']);
    $director = trim($_POST['director']);
    $actor = trim($_POST['actor']);
    $age_rating = trim($_POST['age_rating']);
    $status = $_POST['status'];

    // Kiểm tra dữ liệu không được để trống
    if (empty($title) || empty($image_url) || empty($release_date) || empty($genre) || empty($director) || empty($actor) || empty($age_rating) || empty($status)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
        exit();
    }

    // Chuẩn bị và thực thi câu lệnh SQL
    $sql = "INSERT INTO movies (title, image_url, release_date, genre, director, actor, age_rating, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $title, $image_url, $release_date, $genre, $director, $actor, $age_rating, $status);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('Thêm phim thành công!'); window.location.href='quanlyphim.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm phim: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Lỗi truy vấn CSDL.'); window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    // Nếu truy cập không phải POST
    header("Location: quanlyphim.php");
    exit();
}
?>
