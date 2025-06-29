
use cinemawebpage;
INSERT INTO users (id, user_name, email, pass_word, phone_number, ro_lo, start_date, account_status) VALUES
-- Admins
('A123456', 'Alice', 'alice@example.com', 'password123', '0123456789', 'admin', '2023-01-15', 'Hoạt động'),
('A321654', 'Bob', 'bob@example.com', 'password123', '0987654321', 'admin', '2022-12-01', 'Hoạt động'),
('A111111', 'Daniel', 'daniel@example.com', 'password123', '0321654987', 'admin', '2023-03-11', 'Hoạt động'),
('A222222', 'Elisa', 'elisa@example.com', 'password123', '0399998888', 'admin', '2022-07-20', 'Không hoạt động'),
('A333333', 'George', 'george@example.com', 'password123', '0312345678', 'admin', '2024-01-05', 'Hoạt động'),
-- Employees
('E789564', 'Charlie', 'charlie@example.com', 'password123', '0912345678', 'employee', '2024-03-22', 'Hoạt động'),
('E147852', 'Helen', 'helen@example.com', 'password123', '0901234567', 'employee', '2023-08-09', 'Hoạt động'),
('E555555', 'Ivy', 'ivy@example.com', 'password123', '0390011223', 'employee', '2023-09-30', 'Không hoạt động'),
('E666666', 'Jack', 'jack@example.com', 'password123', '0355223344', 'employee', '2022-11-10', 'Hoạt động'),
('E777777', 'Luna', 'luna@example.com', 'password123', '0377889900', 'employee', '2023-05-16', 'Hoạt động'),
-- Users
('U852369', 'David', 'david@example.com', 'password123', '0909123456', 'user', NULL, 'Hoạt động'),
('U369852', 'Eva', 'eva@example.com', 'password123', '0988123456', 'user', NULL, 'Không hoạt động'),
('U145869', 'Frank', 'frank@example.com', 'password123', '0934567890', 'user', NULL, 'Hoạt động'),
('U458921', 'Grace', 'grace@example.com', 'password123', '0976543210', 'user', NULL, 'Hoạt động'),
('U758123', 'Ivan', 'ivan@example.com', 'password123', '0923456789', 'user', NULL, 'Không hoạt động'),
('U146289', 'Jane', 'jane@example.com', 'password123', '0911223344', 'user', NULL, 'Hoạt động'),
('U584126', 'Phines', 'phines@example.com', 'password123', '0332564894', 'user', NULL, 'Hoạt động'),
('U123123', 'Quinn', 'quinn@example.com', 'password123', '0365123488', 'user', NULL, 'Hoạt động'),
('U654321', 'Ray', 'ray@example.com', 'password123', '0354789123', 'user', NULL, 'Hoạt động'),
('U111222', 'Sara', 'sara@example.com', 'password123', '0345987123', 'user', NULL, 'Hoạt động'),
('U333444', 'Tina', 'tina@example.com', 'password123', '0389988776', 'user', NULL, 'Không hoạt động'),
('U999000', 'Uri', 'uri@example.com', 'password123', '0397766554', 'user', NULL, 'Hoạt động'),
('U888777', 'Victor', 'victor@example.com', 'password123', '0322446688', 'user', NULL, 'Không hoạt động'),
('U555666', 'Wendy', 'wendy@example.com', 'password123', '0377665544', 'user', NULL, 'Hoạt động'),
('U444555', 'Xuan', 'xuan@example.com', 'password123', '0399552244', 'user', NULL, 'Hoạt động'),
('U222333', 'Yen', 'yen@example.com', 'password123', '0366335544', 'user', NULL, 'Hoạt động'),
('U000111', 'Zane', 'zane@example.com', 'password123', '0399988776', 'user', NULL, 'Hoạt động'),
('U777888', 'Lily', 'lily@example.com', 'password123', '0322223333', 'user', NULL, 'Không hoạt động'),
('U999999', 'Noah', 'noah@example.com', 'password123', '0333444555', 'user', NULL, 'Hoạt động');





INSERT INTO movies (
    id, title, 
    descript,genre, 
    director,actor, 
    duration, release_date, 
    lgs,age_rating, ticket_price ,status,
    banner_url, image_url, trailer_url
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
    'T18 - Phim được phổ biến đến người xem từ đủ 18 tuổi trở lên (18+)', 50000,
    'Đang chiếu',
    'https://i.postimg.cc/2896cSmh/john-wick-ballerina.jpg',
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
    'T16 - Phim được phổ biến đến người xem từ đủ 16 tuổi trở lên (16+)', 50000,
    'Sắp chiếu',
    'https://i.postimg.cc/Y25khLpX/hi5-750-1747888779482.jpg',
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
    'P - Phim được phép phổ biến đến người xem ở mọi độ tuổi.', 50000,
    'Ngừng chiếu',
    'https://i.postimg.cc/MTBBm8V1/banner-Stich.png',
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
    'T18 - Phim được phổ biến đến người xem từ đủ 18 tuổi trở lên (18+)',50000,
    'Đang chiếu',
    ' https://i.postimg.cc/63n18q6Z/hq720.jpg',
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
    'T16 - Phim được phổ biến đến người xem từ đủ 16 tuổi trở lên (16+)', 50000,
    'Sắp chiếu',
    ' https://i.postimg.cc/636xxCf3/mi8-poster-1800x1200.jpg',
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
    'T16 - Phim được phổ biến đến người xem từ đủ 16 tuổi trở lên (16+)',50000, 
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
    'T18 - Phim được phổ biến đến người xem từ đủ 18 tuổi trở lên (18+)',50000,
    'Ngừng chiếu',
    'https://i.postimg.cc/nz0Pt53j/toi-do-750-1742267857580.jpg',
    'https://image.tmdb.org/t/p/w500/jYfMTSiFFK7ffbY2lay4zyvTkEk.jpg', 
    'https://www.youtube.com/watch?v=cDnngg3MTio'
);

INSERT INTO cinemas (id, ci_name, address, city, hotline, email_ci, ci_status) VALUES
('HN1', 'CinetixHN 1', '100 Hồ Con Rùa Quận Hoàn Kiếm', 'Hà Nội', '19001001', 'HanoiCinetix@gmail.com', 'Hoạt động'),
('HN2', 'CinetixHN 2', '101 Lê Nin Quận Đống Đa', 'Hà Nội', '19001001', 'HanoiCinetix@gmail.com', 'Hoạt động'),
('HN3', 'CinetixHN 3', '102 Lý Thường Kiệt Quận Cầu Giấy', 'Hà Nội', '19001001', 'HanoiCinetix@gmail.com', 'Tạm ngưng'),
('HCM1', 'CinetixHCM 1', '103 Đồng Khởi Quận 1', 'Thành Phố Hồ Chí Minh', '19001002', 'HCMCinetix@gmail.com', 'Hoạt động'),
('HCM2', 'CinetixHCM 2', '104 Tên Lửa Quận 3', 'Thành Phố Hồ Chí Minh', '19001002', 'HCMCinetix@gmail.com', 'Hoạt động'),
('HCM3', 'CinetixHCM 3', '105 Xô viết Nghệ Tĩnh Quận Bình Thạnh', 'Thành Phố Hồ Chí Minh', '19001002', 'HCMCinetix@gmail.com', 'Hoạt động'),
('Tv1', 'CinetixTv 1', '106 Nguyễn Thị Minh Khai Phường 1', 'Trà vinh', '19001003', 'TvCinetix@gmail.com', 'Hoạt động'),
('Tv2', 'CinetixTv 2', '107 Nguyễn Đáng, Phường 7', 'Trà vinh', '19001003', 'TvCinetix@gmail.com', 'Hoạt động'),
('Tv3', 'CinetixTv 3', '108 Lý Thường Kiệt Phường 8', 'Trà vinh', '19001003', 'TvCinetix@gmail.com', 'Hoạt động'),
('BT1', 'CinetixBT 1', '109 Hùng vương Phường 3', 'Bến Tre', '19001004', 'BTCinetix@gmail.com', 'Tạm ngưng'),
('BT2', 'CinetixBT 2', '110 Phạm Ngũ Lão Phường 5', 'Bến Tre', '19001004', 'BTCinetix@gmail.com', 'Hoạt động'),
('BT3', 'CinetixBT 3', '111 Phan Chu Trinh Phường 6', 'Bến Tre', '19001004', 'BTCinetix@gmail.com', 'Hoạt động');

INSERT INTO rooms (id, cinema_id, room_number, total_seats, room_status) VALUES
(1, 'HN1', 'Room 1', 65, 'Phòng trống'),
(2, 'HN1', 'Room 2', 65, 'Đang sử dụng'),
(3, 'HN1', 'Room 3', 65, 'Phòng trống'),
(4, 'HN1', 'Room 4', 65, 'Phòng trống'),
(5, 'HN1', 'Room 5', 65, 'Đang sử dụng'),
(6, 'HN2', 'Room 1', 65, 'Phòng trống'),
(7, 'HN2', 'Room 2', 65, 'Đang sử dụng'),
(8, 'HN2', 'Room 3', 65, 'Đang sử dụng'),
(9, 'HN2', 'Room 4', 65, 'Phòng trống'),
(10, 'HN2', 'Room 5', 65, 'Đang sử dụng'),
(11, 'HN3', 'Room 1', 65, 'Phòng trống'),
(12, 'HN3', 'Room 2', 65, 'Phòng trống'),
(13, 'HN3', 'Room 3', 65, 'Đang sử dụng'),
(14, 'HN3', 'Room 4', 65, 'Phòng trống'),
(15, 'HN3', 'Room 5', 65, 'Đang sử dụng'),
(16, 'HCM1', 'Room 1', 65, 'Đang sử dụng'),
(17, 'HCM1', 'Room 2', 65, 'Phòng trống'),
(18, 'HCM1', 'Room 3', 65, 'Đang sử dụng'),
(19, 'HCM1', 'Room 4', 65, 'Phòng trống'),
(20, 'HCM1', 'Room 5', 65, 'Đang sử dụng'),
(21, 'HCM2', 'Room 1', 65, 'Đang sử dụng'),
(22, 'HCM2', 'Room 2', 65, 'Phòng trống'),
(23, 'HCM2', 'Room 3', 65, 'Phòng trống'),
(24, 'HCM2', 'Room 4', 65, 'Đang sử dụng'),
(25, 'HCM2', 'Room 5', 65, 'Phòng trống'),
(26, 'HCM3', 'Room 1', 65, 'Phòng trống'),
(27, 'HCM3', 'Room 2', 65, 'Đang sử dụng'),
(28, 'HCM3', 'Room 3', 65, 'Đang sử dụng'),
(29, 'HCM3', 'Room 4', 65, 'Phòng trống'),
(30, 'HCM3', 'Room 5', 65, 'Phòng trống'),
(31, 'Tv1', 'Room 1', 65, 'Đang sử dụng'),
(32, 'Tv1', 'Room 2', 65, 'Phòng trống'),
(33, 'Tv1', 'Room 3', 65, 'Phòng trống'),
(34, 'Tv1', 'Room 4', 65, 'Đang sử dụng'),
(35, 'Tv1', 'Room 5', 65, 'Đang sử dụng'),
(36, 'Tv2', 'Room 1', 65, 'Đang sử dụng'),
(37, 'Tv2', 'Room 2', 65, 'Phòng trống'),
(38, 'Tv2', 'Room 3', 65, 'Phòng trống'),
(39, 'Tv2', 'Room 4', 65, 'Phòng trống'),
(40, 'Tv2', 'Room 5', 65, 'Đang sử dụng'),
(41, 'Tv3', 'Room 1', 65, 'Đang sử dụng'),
(42, 'Tv3', 'Room 2', 65, 'Phòng trống'),
(43, 'Tv3', 'Room 3', 65, 'Phòng trống'),
(44, 'Tv3', 'Room 4', 65, 'Đang sử dụng'),
(45, 'Tv3', 'Room 5', 65, 'Phòng trống'),
(46, 'BT1', 'Room 1', 65, 'Đang sử dụng'),
(47, 'BT1', 'Room 2', 65, 'Đang sử dụng'),
(48, 'BT1', 'Room 3', 65, 'Phòng trống'),
(49, 'BT1', 'Room 4', 65, 'Phòng trống'),
(50, 'BT1', 'Room 5', 65, 'Đang sử dụng'),
(51, 'BT2', 'Room 1', 65, 'Phòng trống'),
(52, 'BT2', 'Room 2', 65, 'Đang sử dụng'),
(53, 'BT2', 'Room 3', 65, 'Phòng trống'),
(54, 'BT2', 'Room 4', 65, 'Đang sử dụng'),
(55, 'BT2', 'Room 5', 65, 'Phòng trống'),
(56, 'BT3', 'Room 1', 65, 'Đang sử dụng'),
(57, 'BT3', 'Room 2', 65, 'Phòng trống'),
(58, 'BT3', 'Room 3', 65, 'Phòng trống'),
(59, 'BT3', 'Room 4', 65, 'Đang sử dụng'),
(60, 'BT3', 'Room 5', 65, 'Phòng trống');


INSERT INTO seats (id, room_id, seat_row, seat_number, seat_type, price_seat_type, seat_status) VALUES
-- phòng 1
(101, 1, 'A', 1, 'Ghế thường', 0, 'Ghế trống'),
(102, 1, 'A', 2, 'Ghế thường', 0, 'Ghế trống'),
(103, 1, 'A', 3, 'Ghế thường', 0, 'Ghế trống'),
(104, 1, 'A', 4, 'Ghế thường', 0, 'Ghế trống'),
(105, 1, 'A', 5, 'Ghế thường', 0, 'Ghế trống'),
(106, 1, 'A', 6, 'Ghế thường', 0, 'Ghế trống'),
(107, 1, 'A', 7, 'Ghế thường', 0, 'Ghế trống'),
(108, 1, 'A', 8, 'Ghế thường', 0, 'Ghế trống'),
(109, 1, 'A', 9, 'Ghế thường', 0, 'Ghế trống'),
(110, 1, 'A', 10, 'Ghế thường', 0, 'Ghế trống'),

(111, 1, 'B', 1, 'Ghế thường', 0, 'Ghế trống'),
(112, 1, 'B', 2, 'Ghế thường', 0, 'Ghế trống'),
(113, 1, 'B', 3, 'Ghế thường', 0, 'Ghế trống'),
(114, 1, 'B', 4, 'Ghế thường', 0, 'Ghế trống'),
(115, 1, 'B', 5, 'Ghế thường', 0, 'Ghế trống'),
(116, 1, 'B', 6, 'Ghế thường', 0, 'Ghế trống'),
(117, 1, 'B', 7, 'Ghế thường', 0, 'Ghế trống'),
(118, 1, 'B', 8, 'Ghế thường', 0, 'Ghế trống'),
(119, 1, 'B', 9, 'Ghế thường', 0, 'Ghế trống'),
(120, 1, 'B', 10, 'Ghế thường', 0, 'Ghế trống'),

(121, 1, 'C', 1, 'Ghế thường', 0, 'Ghế trống'),
(122, 1, 'C', 2, 'Ghế thường', 0, 'Ghế trống'),
(123, 1, 'C', 3, 'Ghế thường', 0, 'Ghế trống'),
(124, 1, 'C', 4, 'Ghế thường', 0, 'Ghế trống'),
(125, 1, 'C', 5, 'Ghế thường', 0, 'Ghế trống'),
(126, 1, 'C', 6, 'Ghế thường', 0, 'Ghế trống'),
(127, 1, 'C', 7, 'Ghế thường', 0, 'Ghế trống'),
(128, 1, 'C', 8, 'Ghế thường', 0, 'Ghế trống'),
(129, 1, 'C', 9, 'Ghế thường', 0, 'Ghế trống'),
(130, 1, 'C', 10, 'Ghế thường', 0, 'Ghế trống'),

(131, 1, 'D', 1, 'Ghế thường', 0, 'Ghế trống'),
(132, 1, 'D', 2, 'Ghế thường', 0, 'Ghế trống'),
(133, 1, 'D', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(134, 1, 'D', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(135, 1, 'D', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(136, 1, 'D', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(137, 1, 'D', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(138, 1, 'D', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(139, 1, 'D', 9, 'Ghế thường', 0, 'Ghế trống'),
(140, 1, 'D', 10, 'Ghế thường', 0, 'Ghế trống'),

(141, 1, 'E', 1, 'Ghế thường', 0, 'Ghế trống'),
(142, 1, 'E', 2, 'Ghế thường', 0, 'Ghế trống'),
(143, 1, 'E', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(144, 1, 'E', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(145, 1, 'E', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(146, 1, 'E', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(147, 1, 'E', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(148, 1, 'E', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(149, 1, 'E', 9, 'Ghế thường', 0, 'Ghế trống'),
(150, 1, 'E', 10, 'Ghế thường', 0, 'Ghế trống'),

(151, 1, 'F', 1, 'Ghế thường', 0, 'Ghế trống'),
(152, 1, 'F', 2, 'Ghế thường', 0, 'Ghế trống'),
(153, 1, 'F', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(154, 1, 'F', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(155, 1, 'F', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(156, 1, 'F', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(157, 1, 'F', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(158, 1, 'F', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(159, 1, 'F', 9, 'Ghế thường', 0, 'Ghế trống'),
(160, 1, 'F', 10, 'Ghế thường', 0, 'Ghế trống'),

(161, 1, 'G', 1, 'Ghế đôi', 15000, 'Ghế trống'),
(162, 1, 'G', 2, 'Ghế đôi', 15000, 'Ghế trống'),
(163, 1, 'G', 3, 'Ghế đôi', 15000, 'Ghế trống'),
(164, 1, 'G', 4, 'Ghế đôi', 15000, 'Ghế trống'),
(165, 1, 'G', 5, 'Ghế đôi', 15000, 'Ghế trống'),
-- Phòng 2
(201, 2, 'A', 1, 'Ghế thường', 0, 'Ghế trống'),
(202, 2, 'A', 2, 'Ghế thường', 0, 'Ghế trống'),
(203, 2, 'A', 3, 'Ghế thường', 0, 'Ghế trống'),
(204, 2, 'A', 4, 'Ghế thường', 0, 'Ghế trống'),
(205, 2, 'A', 5, 'Ghế thường', 0, 'Ghế trống'),
(206, 2, 'A', 6, 'Ghế thường', 0, 'Ghế trống'),
(207, 2, 'A', 7, 'Ghế thường', 0, 'Ghế trống'),
(208, 2, 'A', 8, 'Ghế thường', 0, 'Ghế trống'),
(209, 2, 'A', 9, 'Ghế thường', 0, 'Ghế trống'),
(210, 2, 'A', 10, 'Ghế thường', 0, 'Ghế trống'),

(211, 2, 'B', 1, 'Ghế thường', 0, 'Ghế trống'),
(212, 2, 'B', 2, 'Ghế thường', 0, 'Ghế trống'),
(213, 2, 'B', 3, 'Ghế thường', 0, 'Ghế trống'),
(214, 2, 'B', 4, 'Ghế thường', 0, 'Ghế trống'),
(215, 2, 'B', 5, 'Ghế thường', 0, 'Ghế trống'),
(216, 2, 'B', 6, 'Ghế thường', 0, 'Ghế trống'),
(217, 2, 'B', 7, 'Ghế thường', 0, 'Ghế trống'),
(218, 2, 'B', 8, 'Ghế thường', 0, 'Ghế trống'),
(219, 2, 'B', 9, 'Ghế thường', 0, 'Ghế trống'),
(220, 2, 'B', 10, 'Ghế thường', 0, 'Ghế trống'),

(221, 2, 'C', 1, 'Ghế thường', 0, 'Ghế trống'),
(222, 2, 'C', 2, 'Ghế thường', 0, 'Ghế trống'),
(223, 2, 'C', 3, 'Ghế thường', 0, 'Ghế trống'),
(224, 2, 'C', 4, 'Ghế thường', 0, 'Ghế trống'),
(225, 2, 'C', 5, 'Ghế thường', 0, 'Ghế trống'),
(226, 2, 'C', 6, 'Ghế thường', 0, 'Ghế trống'),
(227, 2, 'C', 7, 'Ghế thường', 0, 'Ghế trống'),
(228, 2, 'C', 8, 'Ghế thường', 0, 'Ghế trống'),
(229, 2, 'C', 9, 'Ghế thường', 0, 'Ghế trống'),
(230, 2, 'C', 10, 'Ghế thường', 0, 'Ghế trống'),

(231, 2, 'D', 1, 'Ghế thường', 0, 'Ghế trống'),
(232, 2, 'D', 2, 'Ghế thường', 0, 'Ghế trống'),
(233, 2, 'D', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(234, 2, 'D', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(235, 2, 'D', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(236, 2, 'D', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(237, 2, 'D', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(238, 2, 'D', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(239, 2, 'D', 9, 'Ghế thường', 0, 'Ghế trống'),
(240, 2, 'D', 10, 'Ghế thường', 0, 'Ghế trống'),

(241, 2, 'E', 1, 'Ghế thường', 0, 'Ghế trống'),
(242, 2, 'E', 2, 'Ghế thường', 0, 'Ghế trống'),
(243, 2, 'E', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(244, 2, 'E', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(245, 2, 'E', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(246, 2, 'E', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(247, 2, 'E', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(248, 2, 'E', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(249, 2, 'E', 9, 'Ghế thường', 0, 'Ghế trống'),
(250, 2, 'E', 10, 'Ghế thường', 0, 'Ghế trống'),

(251, 2, 'F', 1, 'Ghế thường', 0, 'Ghế trống'),
(252, 2, 'F', 2, 'Ghế thường', 0, 'Ghế trống'),
(253, 2, 'F', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(254, 2, 'F', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(255, 2, 'F', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(256, 2, 'F', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(257, 2, 'F', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(258, 2, 'F', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(259, 2, 'F', 9, 'Ghế thường', 0, 'Ghế trống'),
(260, 2, 'F', 10, 'Ghế thường', 0, 'Ghế trống'),

(261, 2, 'G', 1, 'Ghế đôi', 15000, 'Ghế trống'),
(262, 2, 'G', 2, 'Ghế đôi', 15000, 'Ghế trống'),
(263, 2, 'G', 3, 'Ghế đôi', 15000, 'Ghế trống'),
(264, 2, 'G', 4, 'Ghế đôi', 15000, 'Ghế trống'),
(265, 2, 'G', 5, 'Ghế đôi', 15000, 'Ghế trống'),

-- phòng 3
(301, 3, 'A', 1, 'Ghế thường', 0, 'Ghế trống'),
(302, 3, 'A', 2, 'Ghế thường', 0, 'Ghế trống'),
(303, 3, 'A', 3, 'Ghế thường', 0, 'Ghế trống'),
(304, 3, 'A', 4, 'Ghế thường', 0, 'Ghế trống'),
(305, 3, 'A', 5, 'Ghế thường', 0, 'Ghế trống'),
(306, 3, 'A', 6, 'Ghế thường', 0, 'Ghế trống'),
(307, 3, 'A', 7, 'Ghế thường', 0, 'Ghế trống'),
(308, 3, 'A', 8, 'Ghế thường', 0, 'Ghế trống'),
(309, 3, 'A', 9, 'Ghế thường', 0, 'Ghế trống'),
(310, 3, 'A', 10, 'Ghế thường', 0, 'Ghế trống'),

(311, 3, 'B', 1, 'Ghế thường', 0, 'Ghế trống'),
(312, 3, 'B', 2, 'Ghế thường', 0, 'Ghế trống'),
(313, 3, 'B', 3, 'Ghế thường', 0, 'Ghế trống'),
(314, 3, 'B', 4, 'Ghế thường', 0, 'Ghế trống'),
(315, 3, 'B', 5, 'Ghế thường', 0, 'Ghế trống'),
(316, 3, 'B', 6, 'Ghế thường', 0, 'Ghế trống'),
(317, 3, 'B', 7, 'Ghế thường', 0, 'Ghế trống'),
(318, 3, 'B', 8, 'Ghế thường', 0, 'Ghế trống'),
(319, 3, 'B', 9, 'Ghế thường', 0, 'Ghế trống'),
(320, 3, 'B', 10, 'Ghế thường', 0, 'Ghế trống'),

(321, 3, 'C', 1, 'Ghế thường', 0, 'Ghế trống'),
(322, 3, 'C', 2, 'Ghế thường', 0, 'Ghế trống'),
(323, 3, 'C', 3, 'Ghế thường', 0, 'Ghế trống'),
(324, 3, 'C', 4, 'Ghế thường', 0, 'Ghế trống'),
(325, 3, 'C', 5, 'Ghế thường', 0, 'Ghế trống'),
(326, 3, 'C', 6, 'Ghế thường', 0, 'Ghế trống'),
(327, 3, 'C', 7, 'Ghế thường', 0, 'Ghế trống'),
(328, 3, 'C', 8, 'Ghế thường', 0, 'Ghế trống'),
(329, 3, 'C', 9, 'Ghế thường', 0, 'Ghế trống'),
(330, 3, 'C', 10, 'Ghế thường', 0, 'Ghế trống'),

(331, 3, 'D', 1, 'Ghế thường', 0, 'Ghế trống'),
(332, 3, 'D', 2, 'Ghế thường', 0, 'Ghế trống'),
(333, 3, 'D', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(334, 3, 'D', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(335, 3, 'D', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(336, 3, 'D', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(337, 3, 'D', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(338, 3, 'D', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(339, 3, 'D', 9, 'Ghế thường', 0, 'Ghế trống'),
(340, 3, 'D', 10, 'Ghế thường', 0, 'Ghế trống'),

(341, 3, 'E', 1, 'Ghế thường', 0, 'Ghế trống'),
(342, 3, 'E', 2, 'Ghế thường', 0, 'Ghế trống'),
(343, 3, 'E', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(344, 3, 'E', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(345, 3, 'E', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(346, 3, 'E', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(347, 3, 'E', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(348, 3, 'E', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(349, 3, 'E', 9, 'Ghế thường', 0, 'Ghế trống'),
(350, 3, 'E', 10, 'Ghế thường', 0, 'Ghế trống'),

(351, 3, 'F', 1, 'Ghế thường', 0, 'Ghế trống'),
(352, 3, 'F', 2, 'Ghế thường', 0, 'Ghế trống'),
(353, 3, 'F', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(354, 3, 'F', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(355, 3, 'F', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(356, 3, 'F', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(357, 3, 'F', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(358, 3, 'F', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(359, 3, 'F', 9, 'Ghế thường', 0, 'Ghế trống'),
(360, 3, 'F', 10, 'Ghế thường', 0, 'Ghế trống'),

(361, 3, 'G', 1, 'Ghế đôi', 15000, 'Ghế trống'),
(362, 3, 'G', 2, 'Ghế đôi', 15000, 'Ghế trống'),
(363, 3, 'G', 3, 'Ghế đôi', 15000, 'Ghế trống'),
(364, 3, 'G', 4, 'Ghế đôi', 15000, 'Ghế trống'),
(365, 3, 'G', 5, 'Ghế đôi', 15000, 'Ghế trống'),
-- phòng 4
(401, 4, 'A', 1, 'Ghế thường', 0, 'Ghế trống'),
(402, 4, 'A', 2, 'Ghế thường', 0, 'Ghế trống'),
(403, 4, 'A', 3, 'Ghế thường', 0, 'Ghế trống'),
(404, 4, 'A', 4, 'Ghế thường', 0, 'Ghế trống'),
(405, 4, 'A', 5, 'Ghế thường', 0, 'Ghế trống'),
(406, 4, 'A', 6, 'Ghế thường', 0, 'Ghế trống'),
(407, 4, 'A', 7, 'Ghế thường', 0, 'Ghế trống'),
(408, 4, 'A', 8, 'Ghế thường', 0, 'Ghế trống'),
(409, 4, 'A', 9, 'Ghế thường', 0, 'Ghế trống'),
(410, 4, 'A', 10, 'Ghế thường', 0, 'Ghế trống'),

(411, 4, 'B', 1, 'Ghế thường', 0, 'Ghế trống'),
(412, 4, 'B', 2, 'Ghế thường', 0, 'Ghế trống'),
(413, 4, 'B', 3, 'Ghế thường', 0, 'Ghế trống'),
(414, 4, 'B', 4, 'Ghế thường', 0, 'Ghế trống'),
(415, 4, 'B', 5, 'Ghế thường', 0, 'Ghế trống'),
(416, 4, 'B', 6, 'Ghế thường', 0, 'Ghế trống'),
(417, 4, 'B', 7, 'Ghế thường', 0, 'Ghế trống'),
(418, 4, 'B', 8, 'Ghế thường', 0, 'Ghế trống'),
(419, 4, 'B', 9, 'Ghế thường', 0, 'Ghế trống'),
(420, 4, 'B', 10, 'Ghế thường', 0, 'Ghế trống'),

(421, 4, 'C', 1, 'Ghế thường', 0, 'Ghế trống'),
(422, 4, 'C', 2, 'Ghế thường', 0, 'Ghế trống'),
(423, 4, 'C', 3, 'Ghế thường', 0, 'Ghế trống'),
(424, 4, 'C', 4, 'Ghế thường', 0, 'Ghế trống'),
(425, 4, 'C', 5, 'Ghế thường', 0, 'Ghế trống'),
(426, 4, 'C', 6, 'Ghế thường', 0, 'Ghế trống'),
(427, 4, 'C', 7, 'Ghế thường', 0, 'Ghế trống'),
(428, 4, 'C', 8, 'Ghế thường', 0, 'Ghế trống'),
(429, 4, 'C', 9, 'Ghế thường', 0, 'Ghế trống'),
(430, 4, 'C', 10, 'Ghế thường', 0, 'Ghế trống'),

(431, 4, 'D', 1, 'Ghế thường', 0, 'Ghế trống'),
(432, 4, 'D', 2, 'Ghế thường', 0, 'Ghế trống'),
(433, 4, 'D', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(434, 4, 'D', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(435, 4, 'D', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(436, 4, 'D', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(437, 4, 'D', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(438, 4, 'D', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(439, 4, 'D', 9, 'Ghế thường', 0, 'Ghế trống'),
(440, 4, 'D', 10, 'Ghế thường', 0, 'Ghế trống'),

(441, 4, 'E', 1, 'Ghế thường', 0, 'Ghế trống'),
(442, 4, 'E', 2, 'Ghế thường', 0, 'Ghế trống'),
(443, 4, 'E', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(444, 4, 'E', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(445, 4, 'E', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(446, 4, 'E', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(447, 4, 'E', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(448, 4, 'E', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(449, 4, 'E', 9, 'Ghế thường', 0, 'Ghế trống'),
(450, 4, 'E', 10, 'Ghế thường', 0, 'Ghế trống'),

(451, 4, 'F', 1, 'Ghế thường', 0, 'Ghế trống'),
(452, 4, 'F', 2, 'Ghế thường', 0, 'Ghế trống'),
(453, 4, 'F', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(454, 4, 'F', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(455, 4, 'F', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(456, 4, 'F', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(457, 4, 'F', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(458, 4, 'F', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(459, 4, 'F', 9, 'Ghế thường', 0, 'Ghế trống'),
(460, 4, 'F', 10, 'Ghế thường', 0, 'Ghế trống'),

(461, 4, 'G', 1, 'Ghế đôi', 15000, 'Ghế trống'),
(462, 4, 'G', 2, 'Ghế đôi', 15000, 'Ghế trống'),
(463, 4, 'G', 3, 'Ghế đôi', 15000, 'Ghế trống'),
(464, 4, 'G', 4, 'Ghế đôi', 15000, 'Ghế trống'),
(465, 4, 'G', 5, 'Ghế đôi', 15000, 'Ghế trống'),
-- phòng 5
(501, 5, 'A', 1, 'Ghế thường', 0, 'Ghế trống'),
(502, 5, 'A', 2, 'Ghế thường', 0, 'Ghế trống'),
(503, 5, 'A', 3, 'Ghế thường', 0, 'Ghế trống'),
(504, 5, 'A', 4, 'Ghế thường', 0, 'Ghế trống'),
(505, 5, 'A', 5, 'Ghế thường', 0, 'Ghế trống'),
(506, 5, 'A', 6, 'Ghế thường', 0, 'Ghế trống'),
(507, 5, 'A', 7, 'Ghế thường', 0, 'Ghế trống'),
(508, 5, 'A', 8, 'Ghế thường', 0, 'Ghế trống'),
(509, 5, 'A', 9, 'Ghế thường', 0, 'Ghế trống'),
(510, 5, 'A', 10, 'Ghế thường', 0, 'Ghế trống'),

(511, 5, 'B', 1, 'Ghế thường', 0, 'Ghế trống'),
(512, 5, 'B', 2, 'Ghế thường', 0, 'Ghế trống'),
(513, 5, 'B', 3, 'Ghế thường', 0, 'Ghế trống'),
(514, 5, 'B', 4, 'Ghế thường', 0, 'Ghế trống'),
(515, 5, 'B', 5, 'Ghế thường', 0, 'Ghế trống'),
(516, 5, 'B', 6, 'Ghế thường', 0, 'Ghế trống'),
(517, 5, 'B', 7, 'Ghế thường', 0, 'Ghế trống'),
(518, 5, 'B', 8, 'Ghế thường', 0, 'Ghế trống'),
(519, 5, 'B', 9, 'Ghế thường', 0, 'Ghế trống'),
(520, 5, 'B', 10, 'Ghế thường', 0, 'Ghế trống'),

(521, 5, 'C', 1, 'Ghế thường', 0, 'Ghế trống'),
(522, 5, 'C', 2, 'Ghế thường', 0, 'Ghế trống'),
(523, 5, 'C', 3, 'Ghế thường', 0, 'Ghế trống'),
(524, 5, 'C', 4, 'Ghế thường', 0, 'Ghế trống'),
(525, 5, 'C', 5, 'Ghế thường', 0, 'Ghế trống'),
(526, 5, 'C', 6, 'Ghế thường', 0, 'Ghế trống'),
(527, 5, 'C', 7, 'Ghế thường', 0, 'Ghế trống'),
(528, 5, 'C', 8, 'Ghế thường', 0, 'Ghế trống'),
(529, 5, 'C', 9, 'Ghế thường', 0, 'Ghế trống'),
(530, 5, 'C', 10, 'Ghế thường', 0, 'Ghế trống'),

(531, 5, 'D', 1, 'Ghế thường', 0, 'Ghế trống'),
(532, 5, 'D', 2, 'Ghế thường', 0, 'Ghế trống'),
(533, 5, 'D', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(534, 5, 'D', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(535, 5, 'D', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(536, 5, 'D', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(537, 5, 'D', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(538, 5, 'D', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(539, 5, 'D', 9, 'Ghế thường', 0, 'Ghế trống'),
(540, 5, 'D', 10, 'Ghế thường', 0, 'Ghế trống'),

(541, 5, 'E', 1, 'Ghế thường', 0, 'Ghế trống'),
(542, 5, 'E', 2, 'Ghế thường', 0, 'Ghế trống'),
(543, 5, 'E', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(544, 5, 'E', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(545, 5, 'E', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(546, 5, 'E', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(547, 5, 'E', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(548, 5, 'E', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(549, 5, 'E', 9, 'Ghế thường', 0, 'Ghế trống'),
(550, 5, 'E', 10, 'Ghế thường', 0, 'Ghế trống'),

(551, 5, 'F', 1, 'Ghế thường', 0, 'Ghế trống'),
(552, 5, 'F', 2, 'Ghế thường', 0, 'Ghế trống'),
(553, 5, 'F', 3, 'Ghế VIP', 10000, 'Ghế trống'),
(554, 5, 'F', 4, 'Ghế VIP', 10000, 'Ghế trống'),
(555, 5, 'F', 5, 'Ghế VIP', 10000, 'Ghế trống'),
(556, 5, 'F', 6, 'Ghế VIP', 10000, 'Ghế trống'),
(557, 5, 'F', 7, 'Ghế VIP', 10000, 'Ghế trống'),
(558, 5, 'F', 8, 'Ghế VIP', 10000, 'Ghế trống'),
(559, 5, 'F', 9, 'Ghế thường', 0, 'Ghế trống'),
(560, 5, 'F', 10, 'Ghế thường', 0, 'Ghế trống'),

(561, 5, 'G', 1, 'Ghế đôi', 15000, 'Ghế trống'),
(562, 5, 'G', 2, 'Ghế đôi', 15000, 'Ghế trống'),
(563, 5, 'G', 3, 'Ghế đôi', 15000, 'Ghế trống'),
(564, 5, 'G', 4, 'Ghế đôi', 15000, 'Ghế trống'),
(565, 5, 'G', 5, 'Ghế đôi', 15000, 'Ghế trống');

INSERT INTO foods (id, namef, descript,food_images,price) VALUES
('CB01', 'Combo1', '1 bắp 1 nước','https://i.postimg.cc/jjvQmHmG/z6725431272487-229f645e15b08f2942b51e85f6d36426.jpg', 30000),
('CB02', 'Combo2', '2 nước 1 bắp','https://i.postimg.cc/qRRXTtdg/z6725431272499-29f07515196d1dc0fbaa2b3cc43546c8.jpg', 20000),
('B03', 'Bắp', 'Bắp','https://i.postimg.cc/mrSzR64y/bap.jpg', 35000),
('N04', 'Coca Cola','Nước ngọt Coca cola','https://i.postimg.cc/d0Fkbcb0/coca-cola.jpg', 40000),
('N05', 'Fanta', 'Nước ngọt Fanta','https://i.postimg.cc/HnrVwYy6/fanta.jpg', 15000),
('N06', 'Sprite', 'Nước ngọt Sprite','https://i.postimg.cc/59rHxChT/sprite.jpg', 15000),
('N07', 'Milo', 'Sữa milo','https://i.postimg.cc/0jhrZTGP/milo.jpg', 15000);



-- Coca Cola (N04)
INSERT INTO food_variants (variant_id ,food_id, size, flavor, price) VALUES
(1,'N04', 'Nhỏ', 'Coca', 15000),
(2,'N04', 'Lớn', 'Coca', 20000),
(3,'N05', 'Nhỏ', 'Fanta', 15000),
(4,'N05', 'Lớn', 'Fanta', 20000),
(5,'N06', 'Nhỏ', 'Sprite', 15000),
(6,'N06', 'Lớn', 'Sprite', 20000),
(7,'N07', 'Nhỏ', 'Milo', 15000),
(8,'N07', 'Lớn', 'Milo', 18000);


INSERT INTO showtimes (id, movie_id, room_id, show_date, show_time) VALUES
(1,1, 1, '2025-06-01', '18:00:00'),
(2,2, 2, '2025-06-02', '19:00:00'),
(3,3, 3, '2025-06-03', '20:00:00'),
(4,4, 4, '2025-06-04', '21:00:00'),
(5,5, 5, '2025-06-05', '22:00:00'),
(6,6, 6, '2025-06-06', '23:00:00'),
(7,7, 7, '2025-06-07', '00:00:00'),
(8, 2, 32, '2025-06-06', '20:00:00'),
(9, 4, 16, '2025-07-01', '19:00:00'),
(10, 5, 26, '2025-06-07', '19:00:00'),
(11, 5, 25, '2025-06-12', '21:00:00'),
(12, 7, 9, '2025-06-06', '17:00:00'),
(13, 4, 43, '2025-06-04', '14:00:00'),
(14, 4, 44, '2025-06-22', '22:00:00'),
(15, 5, 18, '2025-06-26', '13:00:00'),
(16, 6, 32, '2025-06-29', '13:00:00'),
(17, 7, 50, '2025-06-29', '10:00:00'),
(18, 4, 9, '2025-06-05', '17:00:00'),
(19, 3, 11, '2025-06-28', '14:00:00'),
(20, 6, 59, '2025-06-29', '11:00:00'),
(21, 4, 52, '2025-06-11', '11:00:00'),
(22, 3, 44, '2025-06-03', '16:00:00'),
(23, 7, 27, '2025-06-24', '22:00:00'),
(24, 4, 27, '2025-06-09', '17:00:00'),
(25, 1, 3, '2025-06-14', '18:00:00'),
(26, 6, 37, '2025-06-09', '11:00:00'),
(27, 5, 19, '2025-06-18', '17:00:00');
INSERT INTO payments (id, payment_method, payment_time, payment_status) VALUES
(1, 'Momo', NOW(), 'success'),
(2, 'Momo', NOW(), 'success'),
(3, 'ZaloPay', NOW(), 'success'),
(4, 'Cash', NOW(), 'success'),
(5, 'Momo', NOW(), 'success'),
(6, 'ZaloPay', NOW(), 'success'),
(7, 'Cash', NOW(), 'success'),
(8, 'Momo', NOW(), 'success'),
(9, 'ZaloPay', NOW(), 'success'),
(10, 'Momo', NOW(), 'success'),
(11, 'Momo', NOW(), 'success'),
(12, 'Cash', NOW(), 'success'),
(13, 'ZaloPay', NOW(), 'success'),
(14, 'Momo', NOW(), 'success'),
(15, 'Cash', NOW(), 'success');

INSERT INTO bookings (id, user_id, showtime_id, booking_time, total_amount, status, payment_id) VALUES
(1, 'U852369', 1, NOW(), 75000, 'paid', 1),
(2, 'U369852', 2, NOW(), 76000, 'paid', 2),
(3, 'U145869', 3, NOW(), 77000, 'paid', 3),
(4, 'U458921', 4, NOW(), 78000, 'unpaid', NULL), -- chưa thanh toán nên chưa có payment
(5, 'U758123', 5, NOW(), 79000, 'paid', 4),
(6, 'U146289', 6, NOW(), 80000, 'paid', 5),
(7, 'U584126', 7, NOW(), 81000, 'unpaid', NULL),
(8, 'U145869', 1, NOW(), 82000, 'paid', 6),
(9, 'U458921', 2, NOW(), 83000, 'paid', 7),
(10,'U758123', 3, NOW(), 84000, 'unpaid', NULL),
(11, 'U146289', 4, NOW(), 85000, 'paid', 8),
(12, 'U584126', 5, NOW(), 86000, 'paid', 9),
(13, 'U852369', 6, NOW(), 87000, 'paid', 10),
(14, 'U369852', 7, NOW(), 88000, 'unpaid', NULL),
(15, 'U123123', 1, NOW(), 89000, 'paid', 11),
(16, 'U654321', 2, NOW(), 90000, 'paid', 12),
(17, 'U111222', 3, NOW(), 91000, 'paid', 13),
(18, 'U333444', 4, NOW(), 92000, 'unpaid', NULL),
(19, 'U999000', 5, NOW(), 93000, 'paid', 14),
(20, 'U888777', 6, NOW(), 94000, 'paid', 15);


INSERT INTO booking_details (id, booking_id, seat_id) VALUES
(1, 1, 101),
(2, 2, 102),
(3, 3, 103),
(4, 4, 104),
(5, 5, 105),
(6, 6, 106),
(7, 7, 107),
(8, 8, 108),
(9, 9, 109),
(10, 10, 110),
(11, 11, 111),
(12, 12, 112),
(13, 13, 113),
(14, 14, 114),
(15, 15, 115),
(16, 16, 116),
(17, 17, 117),
(18, 18, 118),
(19, 19, 119),
(20, 20, 120);
INSERT INTO tickets(ticket_id, booking_detail_id, ticket_code, issue_time, status ) VALUES
(1,1, 'VE001', '2025-06-27 10:30:00', 'Còn hiệu lực'),
(2,1, 'VE002', '2025-06-27 10:35:00', 'Còn hiệu lực'),
(3,2, 'VE003', '2025-06-27 10:40:00', 'Đã sử dụng'),
(4,2, 'VE004', '2025-06-27 11:00:00', 'Đã hủy'),
(5,3, 'VE005', '2025-06-27 11:05:00', 'Còn hiệu lực'),
(6,3, 'VE006', '2025-06-27 11:06:00', 'Đã sử dụng'),
(7,4, 'VE007', '2025-06-27 11:10:00', 'Còn hiệu lực'),
(8,5, 'VE008', '2025-06-27 11:15:00', 'Đã hủy'),
(9,5, 'VE009', '2025-06-27 11:17:00', 'Còn hiệu lực'),
(10,6, 'VE010', '2025-06-27 11:20:00', 'Còn hiệu lực'),
(11,6, 'VE011', '2025-06-27 11:22:00', 'Còn hiệu lực'),
(12,7, 'VE012', '2025-06-27 11:25:00', 'Đã sử dụng'),
(13,7, 'VE013', '2025-06-27 11:27:00', 'Còn hiệu lực'),
(14,2, 'VE014', '2025-06-27 11:30:00', 'Đã hủy');

INSERT INTO food_orders (id, booking_id, food_id, quantity) VALUES
(1, 1, 'N04', 2),   -- Alice đặt 2 phần Coke
(2, 1, 'B03', 1),   -- Alice đặt 1 phần Bắp
(3, 3, 'N05', 1),  
(4, 1, 'CB01', 1),   
(5, 5, 'CB02', 1),   
(7, 2, 'N07', 2);  
INSERT INTO food_variants (variant_id, food_id, size, price) VALUES
(1, 'CB01', 'Size Nhỏ', 0),
(2, 'CB01', 'Size Lớn', 30000),
(3, 'CB02', 'Size Vừa', 20000),
(4, 'B03', 'Size Nhỏ', 0),
(5, 'B03', 'Size Lớn', 10000),
(6, 'N04', 'Size nhỏ', 0),
(7, 'N04', 'Size lớn', 10000),
(8, 'N05', 'Size nhỏ', 0),
(9, 'N05', 'Size lớn', 10000),
(10, 'N06', 'Size nhỏ', 0),
(11, 'N06', 'Size Lớn', 10000),
(12, 'N07', 'Size Nhỏ', 0),
(13, 'N07', 'Size Nhỏ', 10000);

