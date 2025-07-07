<?php
include('../connect.php');

$cinema_id = $_GET['cinema_id'] ?? '';
$result = mysqli_query($conn, "SELECT id, room_number FROM rooms WHERE cinema_id = '" . mysqli_real_escape_string($conn, $cinema_id) . "'");

$rooms = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
}

header('Content-Type: application/json');
echo json_encode($rooms);
