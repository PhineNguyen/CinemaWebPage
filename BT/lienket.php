<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "web tin tức");
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liên kết web</title>
</head>
<body>
    <h3>Danh sách liên kết</h3>
    <form method="post">
        <input type="submit" name="hienthi" value="Hiển thị liên kết">
    </form>

    <?php
    if (isset($_POST['hienthi'])) {
        $sql = "SELECT Ten, URL FROM lienket";
        $result = $conn->query($sql);

        echo "<div style='width:250px; border:1px solid blue; padding:10px; margin-top:10px;'>";
        echo "<ul>";

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li><a href='" . $row["URL"] . "' target='_blank'>" . $row["Ten"] . "</a></li>";
            }
        } else {
            echo "<li>Không có dữ liệu</li>";
        }

        echo "</ul>";
        echo "</div>";
    }

    $conn->close();
    ?>
</body>
</html>
