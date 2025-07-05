<?php
function handleDelete($table, $id_field, $post_key, $redirect_url, $conn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$post_key])) {
        $delete_id = $_POST[$post_key];
        $check = mysqli_query($conn, "SELECT * FROM $table WHERE $id_field = '$delete_id'");
        if (mysqli_num_rows($check) > 0) {
            if (mysqli_query($conn, "DELETE FROM $table WHERE $id_field = '$delete_id'")) {
                echo "<script>alert('Xóa thành công!'); window.location.href='$redirect_url';</script>";
                exit();
            } else {
                echo "<script>alert('Xóa thất bại: lỗi hệ thống');</script>";
            }
        } else {
            echo "<script>alert('Không tìm thấy mục cần xóa');</script>";
        }
    }
}
?>