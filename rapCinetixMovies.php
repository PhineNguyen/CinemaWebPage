<?php
header('Content-Type: application/json');
include('connect.php');

$cinema = isset($_GET['cinema']) ? $_GET['cinema'] : '';

$cinemaInfo = [
    'CINETIX GO! Mỹ Tho' => [
        'image' => 'https://iguov8nhvyobj.vcdn.cloud/media/site/cache/1/980x415/b58515f018eb873dafa430b6f9ae0c1e/c/g/cgv-vincom-quang-ngai-1.png',
        'address' => 'Tầng 3, TTTM GO! Mỹ Tho, 545 Lê Văn Phẩm, Phường 5, Thành phố Mỹ Tho, Tiền Giang',
        'fax' => '+84 4 6 275 5240',
        'hotline' => '1900 6017',
    ],
    'CINETIX GO! Quận 1' => [
        'image' => 'https://www.cgv.vn/media/wysiwyg/2023/062023/TTTM_1.jpg',
        'address' => 'Tầng 5, Vincom Center, 72 Lê Thánh Tôn, Quận 1, TP. Hồ Chí Minh',
        'fax' => '+84 4 6 275 5240',
        'hotline' => '1900 6017',
    ],
    'CINETIX VINCOM Thủ Đức' => [
        'image' => 'https://www.cgv.vn/media/wysiwyg/2023/112023/Zone_2.jpg',
        'address' => 'Tầng 5, TTTM Vincom Thủ Đức, 216 Võ Văn Ngân, Bình Thọ, Thủ Đức, TP. HCM',
        'fax' => '+84 4 6 275 5240',
        'hotline' => '1900 6017',
    ],
    'CINETIX GO! Ninh Kiều' => [
        'image' => 'https://www.cgv.vn/media/wysiwyg/2023/112023/Zone_6.jpg',
        'address' => 'Tầng 4, Sense City, 1 Đại lộ Hòa Bình, P. Tân An, Q. Ninh Kiều, Cần Thơ',
        'fax' => '+84 4 6 275 5240',
        'hotline' => '1900 6017',
    ],
];

$movies = [];
$sql = "SELECT id, title, image_url, trailer_url FROM movies LIMIT 12";
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

$cinemaData = isset($cinemaInfo[$cinema]) ? $cinemaInfo[$cinema] : null;

echo json_encode([
    'cinema' => $cinemaData,
    'movies' => $movies
]);
