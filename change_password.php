<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';

// Lấy mật khẩu hiện tại từ database
$sql = "SELECT pass_word FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$message = "";

if ($result->num_rows !== 1) {
    $message = "Tài khoản không tồn tại.";
} else {
    $row = $result->fetch_assoc();
    $stored_password = $row['pass_word'];

    if ($current_password !== $stored_password) {
        $message = "Mật khẩu cũ không đúng.";
    } else {
        // Cập nhật mật khẩu mới
        $update = "UPDATE users SET pass_word = ? WHERE id = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("ss", $new_password, $user_id);

        if ($stmt->execute()) {
            $message = "<span style='color: green;'>Đổi mật khẩu thành công!</span>";
        } else {
            $message = "Có lỗi xảy ra khi đổi mật khẩu.";
        }
    }
}


// Trả về lại file user_infor.php bằng session message
$_SESSION['password_message'] = $message;

// Để giữ nguyên pop-up không biến mất nếu nhập sai mật khẩu
$_SESSION['show_password_modal'] = true;

header("Location: infor_admin.php#passwordModal");
exit;
?>
