<html>
<head>
    <title>Bài Tập</title>
</head>
<body>
    <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$link=@mysqli_connect("localhost", "root", "") or die("Kết nối thất bại");
mysqli_select_db($link, "web tin tức") or die("Chọn CSDL thất bại");
$sl = "SELECT * FROM user";
$kq = mysqli_query($link, $sl);
if (!$kq) {
    die('Lỗi truy vấn: ' . mysqli_error($link));
}

echo '<table border="1" cellpadding="8" cellspacing="0">';
echo '<tr>';
echo '<th>STT</th>';
echo '<th>Họ tên</th>';
echo '<th>Username</th>';
echo '<th>Email</th>';
echo '</tr>';
$i=1;

while($d=mysqli_fetch_array($kq)) {
    echo '<tr>';
    echo '<td>' . $i . '</td>';
    echo '<td>' . $d['HoTen'] . '</td>';
    echo '<td>' . $d['Username'] . '</td>';
    echo '<td>' . $d['Email'] . '</td>';
    echo '</tr>';
    $i++;
}

?>
</body>
</html>