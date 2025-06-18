use cinemawebpage;
INSERT INTO users (id, user_name, email, pass_word, phone_number, ro_lo) VALUES
(1,'Alice', 'alice@example.com', 'password123', '0123456789', 'admin'),
(2,'Bob', 'bob@example.com', 'password123', '0987654321', 'admin'),
(3,'Charlie', 'charlie@example.com', 'password123', '0912345678', 'admin'),
(4,'David', 'david@example.com', 'password123', '0909123456', 'user'),
(5,'Eva', 'eva@example.com', 'password123', '0988123456', 'user'),
(6,'Frank', 'frank@example.com', 'password123', '0934567890', 'user'),
(7,'Grace', 'grace@example.com', 'password123', '0976543210', 'user'),
(8,'Helen', 'helen@example.com', 'password123', '0901234567', 'admin'),
(9,'Ivan', 'ivan@example.com', 'password123', '0923456789', 'user'),
(10,'Jane', 'jane@example.com', 'password123', '0911223344', 'user');


INSERT INTO movies (
    id, title, 
    descript,genre, 
    director,actor, 
    duration, release_date, 
    lgs,age_rating,status,banner_url,
    image_url, trailer_url
) VALUES
(
    1,
    'TỪ VŨ TRỤ JOHN WICK: BALLERINA',
    'Lấy bối cảnh giữa sự kiện của Sát thủ John Wick: Phần 3 – Chuẩn Bị Chiến Tranh, bộ phim Từ Vũ Trụ John Wick: Ballerina theo chân Eve Macarro (thủ vai bởi Ana de Armas) trên hành trình trả thù cho cái chết của gia đình mình, dưới sự huấn luyện của tổ chức tội phạm Ruska Roma.',
    'Hành Động, Hồi hộp',
    'Len Wiseman',
    'Ana de Armas, Keanu Reeves, Catalina Sandino Moreno,...',
    125, '2025-06-06',
    'Tiếng Anh – Phụ đề Tiếng Việt',
    'T18 - Phim được phổ biến đến người xem từ đủ 18 tuổi trở lên (18+)', 
    'Đang chiếu','https://i.postimg.cc/ryn0bJND/cover.jpg',
    'https://image.tmdb.org/t/p/w500/2VUmvqsHb6cEtdfscEA6fqqVzLg.jpg', 
    'https://www.youtube.com/watch?v=P_urL6YPSvs'
),
(
    2,
    'BỘ 5 SIÊU ĐẲNG CẤP',
    'Thể loại: Siêu Hài, Siêu Lòng, Siêu Hài Lòng HI.FIVE – bộ phim bom tấn siêu anh hùng châu Á, pha trộn hành động mãn nhãn và tiếng cười bùng nổ. Năm người bình thường bỗng dưng "trúng số" — bất ngờ sở hữu siêu năng lực bá đạo sau một ca ghép tạng... kỳ quặc! Bị đời đẩy đưa trở thành siêu anh hùng bất đắc dĩ, họ vừa "gánh team" cứu thế giới, phải học cách dùng năng lực đúng lúc để không phá banh mọi thứ xung quanh. Khi định mệnh ép bạn lên level – bạn có dám bung skill tới bến?',
    'Hài, Hành Động, Thần thoại',
    'Kang Hyung Cheol',
    'Yoo Ah In, Ahn Jae Hong, Park Jin Young, Ra Mi Ran,...',
    119, '2025-07-13',
    'Tiếng Hàn – Phụ đề Tiếng Việt và Lồng Tiếng',
    'T16 - Phim được phổ biến đến người xem từ đủ 16 tuổi trở lên (16+)', 
    'Sắp chiếu','https://i.postimg.cc/Y25khLpX/hi5-750-1747888779482.jpg',
    'https://image.tmdb.org/t/p/w500/3vRgeb0cARTebM8cbDXogGhOyit.jpg', 
    'https://www.youtube.com/watch?v=QLv_ARaBAH4'
),
(
    3,
    'LILO & STITCH',
    'Bộ phim live action Lilo và Stitch đưa câu chuyện kinh điển của Disney năm 2002 trở lại với một diện mạo mới, vừa hài hước vừa đầy cảm xúc. Phim theo chân Lilo, một cô bé người Hawaii cô đơn, và Stitch, sinh vật ngoài hành tinh tinh nghịch đang chạy trốn, khi cả hai vô tình tìm thấy nhau và cùng nhau hàn gắn những tan vỡ trong gia đình của Lilo.',
    'Gia đình, Hài, Phiêu Lưu',
    'Dean Fleischer Camp',
    'Maia Kealoha, Sydney Elizabeth Agudong, Tia Carrere, Chris Sanders',
    107, '2025-05-23',
    'Tiếng Anh - Phụ đề Tiếng Việt; Lồng tiếng Việt',
    'P - Phim được phép phổ biến đến người xem ở mọi độ tuổi.', 
    'Ngừng chiếu','https://i.postimg.cc/MTBBm8V1/banner-Stich.png',
    'https://image.tmdb.org/t/p/w500/Y6pjszkKQUZ5uBbiGg7KWiCksJ.jpg', 
    'https://www.youtube.com/watch?v=ePezbqx6VqU'
),
(
    4,
    'DƯỚI ĐÁY HỒ',
    'Tú liên tục rơi vào vòng xoáy kỳ lạ khi những người cô quen biết dường như đã trở thành một người khác. Tình cờ một thế giới bí ẩn nằm sâu dưới đáy hồ mở ra, nơi bản sao tà ác của con người được hình thành và nuôi dưỡng bởi chấp niệm chưa được hóa giải của chính họ. Bản sao của Tú nổi dậy, khát khao điên cuồng để thay thế cô. Tú sẽ làm gì để chiến thắng bản sao của mình?',
    'Kinh Dị',
    'Trần Hữu Tấn',
    'Karen Nguyễn, Kay Trần, Thanh Duy, Nguyên Thảo, Lâm Hoàng Oanh, Mạc Trung Kiên, Nguyễn Hữu Tiến,...',
    98, '2025-06-06',
    'Tiếng Việt và phụ đề tiếng Anh',
    'T18 - Phim được phổ biến đến người xem từ đủ 18 tuổi trở lên (18+)',
    'Đang chiếu','https://i.postimg.cc/63n18q6Z/hq720.jpg',
    'https://image.tmdb.org/t/p/w500/tN3WWhiklSI8NErftXqyfkR9GJ.jpg', 
    'https://www.youtube.com/watch?v=N7IcsG_hM4s'
),
(
    5,
    'NHIỆM VỤ: BẤT KHẢ THI - NGHIỆP BÁO CUỐI CÙNG',
    'Cuộc đời là tất thảy những lựa chọn. Tom Cruise thủ vai Ethan Hunt trở lại trong Nhiệm Vụ: Bất Khả Thi – Nghiệp Báo Cuối Cùng.',
    'Hành Động, Hồi hộp, Phiêu Lưu',
    'Christopher McQuarrie',
    'Tom Cruise',
    169, '2025-07-30',
    'Tiếng Anh - Phụ đề Tiếng Việt, tiếng Hàn',
    'T16 - Phim được phổ biến đến người xem từ đủ 16 tuổi trở lên (16+)', 
    'Sắp chiếu',' https://i.postimg.cc/636xxCf3/mi8-poster-1800x1200.jpg',
    'https://image.tmdb.org/t/p/w500/geEjCGfdmRAA1skBPwojcdvnZ8A.jpg', 
    'https://www.youtube.com/watch?v=K5PP7igejMU'
),
(
    6,
    'ĐIỆP QUỶ TÂN NƯƠNG',
    'Sau khi dì mất, Salim và Tasya trở về nhà tổ để lo tang và chụp ảnh cưới. Tại đây, Salim buộc phải thắp nhang mỗi ngày trên bàn thờ bí ẩn để giữ mạng sống. Sự xuất hiện của họ vô tình đánh thức những linh hồn tổ tiên chết tức tưởi từ xa xưa. Tasya quyết tâm khám phá bí mật gia tộc để giải thoát Salim khỏi lời nguyền. Nhưng sự thật cô sắp đối mặt còn đáng sợ hơn cả những cô hồn dã quỷ.',
    'Kinh Dị',
    'Paul Agusta',
    'Morgan Oey, Zulfa Maharani, Jourdy Pranata, Brigitta Cynthia',
    101, '2025-06-06',
    'Tiếng Indonesia - Phụ đề Tiếng Anh và Tiếng Việt',
    'T16 - Phim được phổ biến đến người xem từ đủ 16 tuổi trở lên (16+)', 
    'Đang chiếu','https://i.postimg.cc/hPNnQzcy/2048wx858h-32.jpg',
    'https://image.tmdb.org/t/p/w500/1RjwK6xD5SDo79GZJRHxiDvKI8U.jpg', 
    'https://www.youtube.com/watch?v=paQM8Lz7BRQ'
),
(
    7,
    'TỘI ĐỒ',
    'Mắc kẹt trong cuộc sống thực tại rối ren, cả hai quay trở lại quê nhà để có một khởi đầu mới, để rồi phát hiện một thế lực ác quỷ đang nhăm nhe chờ đợi họ.',
    'Hồi Hộp, Kinh Dị, Tâm Lý',
    'Ryan Coogler',
    'Hailee Steinfeld, Jack O''Connell, Michael B. Jordan',
    138, '2025-05-21',
    'Tiếng Anh',
    'T18 - Phim được phổ biến đến người xem từ đủ 18 tuổi trở lên (18+)',
    'Ngừng chiếu','https://i.postimg.cc/nz0Pt53j/toi-do-750-1742267857580.jpg',
    'https://image.tmdb.org/t/p/w500/jYfMTSiFFK7ffbY2lay4zyvTkEk.jpg', 
    'https://www.youtube.com/watch?v=cDnngg3MTio'
);


INSERT INTO cinemas (id, ci_name, address, city, hotline) VALUES
(1, 'Cinema One', '1 Main St', 'Hanoi', '19001000'),
(2, 'Cinema Two', '2 Main St', 'HCMC', '19002000'),
(3, 'Cinema Three', '3 Main St', 'Da Nang', '19003000');


INSERT INTO rooms (id, cinema_id, room_number, total_seats) VALUES
(1,1, 'Room 1', 50),
(2,2, 'Room 2', 60),
(3,3, 'Room 3', 70),
(4,1, 'Room 4', 80),
(5,2, 'Room 5', 90),
(6,3, 'Room 6', 100),
(7,1, 'Room 7', 50),
(8,2, 'Room 8', 60),
(9,3, 'Room 9', 70),
(10,1, 'Room 10', 80);
INSERT INTO seats (id, room_id, seat_row, seat_number) VALUES
(1,1, 'A', 1),
(2,1, 'A', 2),
(3,1, 'A', 3),
(4,2, 'A', 4),
(5,2, 'B', 5),
(6,2, 'B', 6),
(7,3, 'C', 7),
(8,3, 'C', 8),
(9,3, 'D', 9),
(10,4, 'D', 10);
INSERT INTO foods (id, namef, descript, price) VALUES
(1, 'Bỏng ngô', 'Bắp rang bơ giòn thơm', 30000),
(2, 'Coca', 'Nước ngọt có ga mát lạnh', 20000),
(3, 'Nachos', 'Khoai tây chiên phô mai', 35000),
(4, 'Xúc xích', 'Xúc xích kẹp bánh mì nóng', 40000),
(5, 'Nước lọc', 'Chai nước suối tinh khiết', 15000);

INSERT INTO showtimes (id, movie_id, room_id, show_date, show_time, price) VALUES
(1,1, 1, '2024-06-01', '18:00:00', 75000.00),
(2,2, 2, '2024-06-02', '18:00:00', 76000.00),
(3,3, 3, '2024-06-03', '18:00:00', 77000.00),
(4,4, 4, '2024-06-04', '18:00:00', 78000.00),
(5,5, 5, '2024-06-05', '18:00:00', 79000.00),
(6,6, 6, '2024-06-06', '18:00:00', 80000.00),
(7,7, 7, '2024-06-07', '18:00:00', 81000.00);
INSERT INTO payments (id, payment_method, payment_time, status) VALUES
(1, 'ZaloPay', NOW(), 'success'),
(2, 'Cash', NOW(), 'success'),
(3, 'Momo', NOW(), 'success'),
(4, 'Banking', NOW(), 'failed'),
(5, 'Cash', NOW(), 'success'),
(6, 'Momo', NOW(), 'success'),
(7, 'Banking', NOW(), 'failed'),
(8, 'ZaloPay', NOW(), 'success'),
(9, 'Cash', NOW(), 'success'),
(10, 'Momo', NOW(), 'success');
INSERT INTO bookings (id, user_id, showtime_id, booking_time, total_amount, status, payment_id) VALUES
(1, 1, 1, NOW(), 75000.00, 'paid', 1),
(2, 2, 2, NOW(), 76000.00, 'paid', 2),
(3, 3, 3, NOW(), 77000.00, 'paid', 3),
(4, 4, 4, NOW(), 78000.00, 'unpaid', NULL), -- chưa thanh toán nên chưa có payment
(5, 5, 5, NOW(), 79000.00, 'paid', 4),
(6, 6, 6, NOW(), 80000.00, 'paid', 5),
(7, 7, 7, NOW(), 81000.00, 'unpaid', NULL);
INSERT INTO booking_details (id, booking_id, seat_id) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7);
INSERT INTO food_orders (id, booking_id, food_id, quantity) VALUES
(1, 1, 2, 2),   -- Alice đặt 2 phần Coke
(2, 2, 1, 1),   -- Alice đặt 1 phần Bắp
(3, 3, 1, 1),   -- Bob đặt 1 phần Nachos
(4, 1, 1, 1),   -- Charlie đặt 1 phần Bắp
(5, 4, 2, 2),   -- Charlie đặt 2 phần Hotdog
(6, 5, 5, 1),   -- David đặt 1 chai nước
(7, 2, 2, 2);   -- Eva đặt 2 lon Coke



