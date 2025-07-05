<?php
include('../connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id']; // Có thể là "GUEST001"
    $showtime_id = $_POST['show_time'];
    $seat_codes = explode(',', $_POST['seat_id']); // ví dụ: "R1-A1,R1-A2"
    $status = $_POST['status'];
    $payment_method = $_POST['payment_method'];

    $seat_ids = [];
    $total = 0;

    // 🔍 Lấy giá vé phim dựa theo showtime
    $ticket_price = 0;
    // 1. Truy vấn để lấy giá vé phim từ showtime
$movie_query = mysqli_query($conn, "
    SELECT movies.ticket_price 
    FROM showtimes 
    JOIN movies ON showtimes.movie_id = movies.id 
    WHERE showtimes.id = '$showtime_id'
");
$ticket_price = 0;
if ($row = mysqli_fetch_assoc($movie_query)) {
    $ticket_price = $row['ticket_price'];
}

// 2. Duyệt qua từng ghế
foreach ($seat_codes as $code) {
    $code = trim($code); // ví dụ: R1-A1
    [$room_number, $seat_pos] = explode('-', $code);

    $seat_row = substr($seat_pos, 0, 1);
    $seat_number = substr($seat_pos, 1);

    $room_query = mysqli_query($conn, "SELECT id FROM rooms WHERE room_number = '$room_number'");
    if ($room = mysqli_fetch_assoc($room_query)) {
        $room_id = $room['id'];

        $seat_query = mysqli_query($conn, "
            SELECT id, price_seat_type 
            FROM seats 
            WHERE room_id = '$room_id' 
              AND seat_row = '$seat_row' 
              AND seat_number = '$seat_number'
        ");

        if ($seat = mysqli_fetch_assoc($seat_query)) {
            $seat_ids[] = $seat['id'];
            $total += ($ticket_price + $seat['price_seat_type']); // ✅ Cộng cả giá vé + phụ thu ghế
        }
    }
}


    // 1. Insert booking
    $insert_booking = "INSERT INTO bookings (user_id, showtime_id, total_amount, status) 
                       VALUES ('$user_id', '$showtime_id', '$total', '$status')";
    mysqli_query($conn, $insert_booking);
    $booking_id = mysqli_insert_id($conn);

    // 2. Insert payment
    $insert_payment = "INSERT INTO payments (payment_method, payment_status) 
                       VALUES ('$payment_method', 'thành công')";
    mysqli_query($conn, $insert_payment);
    $payment_id = mysqli_insert_id($conn);

    // 3. Gán payment_id vào booking
    mysqli_query($conn, "UPDATE bookings SET payment_id = '$payment_id' WHERE id = '$booking_id'");

    // 4. Insert chi tiết ghế và vé
    foreach ($seat_ids as $seat_id) {
        $insert_detail = "INSERT INTO booking_details (booking_id, seat_id) 
                          VALUES ('$booking_id', '$seat_id')";
        mysqli_query($conn, $insert_detail);
        $booking_detail_id = mysqli_insert_id($conn);

        $ticket_code = uniqid("VE");
        $insert_ticket = "INSERT INTO tickets (booking_detail_id, ticket_code) 
                          VALUES ('$booking_detail_id', '$ticket_code')";
        mysqli_query($conn, $insert_ticket);

        // 5. Đánh dấu ghế đã đặt
        mysqli_query($conn, "UPDATE seats SET seat_status = 'Đã đặt' WHERE id = '$seat_id'");
    }

    echo "<script>alert('✅ Đặt vé thành công!'); window.location.href='datve.php';</script>";
    exit();
}
?>
