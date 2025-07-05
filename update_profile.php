<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_name = $_POST['name'] ?? '';
  $new_phone = $_POST['phone'] ?? '';
  $new_email = $_POST['email'] ?? '';

  // Kiểm tra dữ liệu 
  if (empty($new_name) || empty($new_phone) || empty($new_email)) {
    $_SESSION['update_message'] = "<span style='color:red;'>Vui lòng điền đầy đủ thông tin.</span>";
    header("Location: infor_admin.php");
    exit;
  }

  $sql = "UPDATE users SET user_name = ?, phone_number = ?, email = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $new_name, $new_phone, $new_email, $user_id);

  if ($stmt->execute()) {
    // Cập nhật lại session nếu tên người dùng thay đổi
    $_SESSION['user']['user_name'] = $new_name;
    header("Location: Home.php");
    exit;
  } else {
    $_SESSION['update_message'] = "<span style='color:red;'>Cập nhật thất bại. Vui lòng thử lại.</span>";
    header("Location: infor_admin.php");
    exit;
  }
}
?>
