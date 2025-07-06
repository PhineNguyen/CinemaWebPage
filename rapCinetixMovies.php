<?php
header('Content-Type: application/json');
include('connect.php');

$cinema = isset($_GET['cinema']) ? $_GET['cinema'] : '';

$cinemaInfo = [];
$sql = "SELECT ci_code, ci_name, address, hotline, email_ci FROM cinemas";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $code = strtoupper(trim($row['ci_code'] ?? ''));
        $name = strtoupper(trim($row['ci_name']));
        $infoArr = [
            'ci_name' => $row['ci_name'],
            'address' => $row['address'],
            'hotline' => $row['hotline'],
            'email_ci' => $row['email_ci'],
            'image' => 'https://iguov8nhvyobj.vcdn.cloud/media/site/cache/1/980x415/b58515f018eb873dafa430b6f9ae0c1e/b/t/bth_3355_2.jpg'
        ];
        if ($code) $cinemaInfo[$code] = $infoArr;
        $cinemaInfo[$name] = $infoArr; // luôn lưu theo tên rạp chuẩn hóa
    }
}

$movies = [];
$sql = "SELECT id, title, image_url, trailer_url FROM movies WHERE status = 'Đang chiếu' LIMIT 12";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'image_url' => $row['image_url'],
            'trailer_url' => $row['trailer_url']
        ];
    }
}

$cinemaByCity = [];
$sql = "SELECT ci_code, ci_name, city FROM cinemas";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $city = trim($row['city']);
        $cinemaByCity[$city][] = [
            'ci_code' => $row['ci_code'],
            'ci_name' => $row['ci_name']
        ];
    }
}

// Trả về lỗi nếu không có rạp nào ở thành phố được yêu cầu (nếu có tham số city)
if (isset($_GET['city'])) {
    $city = trim($_GET['city']);
    if (!isset($cinemaByCity[$city]) || count($cinemaByCity[$city]) === 0) {
        echo json_encode([
            'error' => 'Không có rạp nào ở khu vực này.',
            'city' => $city
        ]);
        exit;
    }
}

$cinemaData = null;
if ($cinema) {
    $cinemaKey = strtoupper(trim($cinema));
    if (isset($cinemaInfo[$cinemaKey])) {
        $info = $cinemaInfo[$cinemaKey];
        $cinemaData = [
            'ci_code' => $cinemaKey,
            'ci_name' => $info['ci_name'],
            'address' => $info['address'],
            'hotline' => $info['hotline'],
            'email_ci' => $info['email_ci'],
            'image' => $info['image']
        ];
    }
}
echo json_encode([
    'cinema' => $cinemaData,
    'movies' => $movies,
    'cinemaByCity' => $cinemaByCity
]);
