USE cinemawebpage;

CREATE TABLE users (
    id VARCHAR(100) PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    pass_word VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    ro_lo ENUM('user','admin','employee') DEFAULT 'user',
    start_date DATE NULL, -- ngày vào làm cho nhân sự (user thì để trống)
    account_status ENUM('Hoạt động', 'Không hoạt động') DEFAULT 'Hoạt động',
    last_active DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- user id -> user_name -> email-> phone-number->rolo (user)
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    descript TEXT,
    genre VARCHAR(100),
    director VARCHAR(100),
    actor TEXT,
    duration INT,
    release_date DATE,
    lgs VARCHAR(50),
    age_rating VARCHAR(255),
    ticket_price DECIMAL(10,0) NOT NULL,
    banner_url VARCHAR(255),
    image_url VARCHAR(255),
    trailer_url VARCHAR(255),
    status ENUM('Sắp chiếu', 'Đang chiếu','Ngừng chiếu','Đang cập nhật','Tạm ẩn','Lưu trữ') default 'Đang chiếu'
);

CREATE TABLE cinemas (
    id VARCHAR (100) PRIMARY KEY,
    ci_name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    city VARCHAR(100),
    hotline VARCHAR(20),
    email_ci VARCHAR(100),
    ci_status ENUM('Hoạt động','Tạm ngừng') default 'Hoạt động'
    );

CREATE TABLE rooms (
    id  INT AUTO_INCREMENT PRIMARY KEY,
    cinema_id VARCHAR(100),
    room_number VARCHAR(50) NOT NULL,
    total_seats INT,
    room_status ENUM('Đang sử dụng','Phòng trống') default 'Phòng trống',
    FOREIGN KEY (cinema_id) REFERENCES cinemas(id)
);
CREATE TABLE seats (
    id INT PRIMARY KEY, -- Đổi sang mã ghế như 'R1-A1'
    room_id INT,
    seat_row CHAR(1),
    seat_number INT,
    seat_type ENUM('Ghế thường','Ghế VIP','Ghế đôi') DEFAULT 'Ghế thường',
    price_seat_type DECIMAL(10,0) NOT NULL,
    seat_status ENUM('Đã đặt','Ghế trống') DEFAULT 'Ghế trống',
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

CREATE TABLE foods (
    id VARCHAR(100) PRIMARY KEY,
    namef VARCHAR(100) NOT NULL,
    descript TEXT,
    food_images VARCHAR(255),
    price DECIMAL(10,0) NOT NULL,
    available BOOLEAN DEFAULT TRUE
);

CREATE TABLE food_variants (
  variant_id INT AUTO_INCREMENT PRIMARY KEY,
  food_id VARCHAR(10),
  size VARCHAR(10),  		-- 'small' or 'large'
  price INT,
  FOREIGN KEY (food_id) REFERENCES foods(id)
);

CREATE TABLE showtimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    room_id INT,
    show_date DATE,
    show_time TIME,
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_method ENUM('Tiền mặt', 'Banking', 'Momo', 'ZaloPay') DEFAULT 'Tiền mặt',
    payment_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    payment_status VARCHAR(50) DEFAULT 'thành công'
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(100),
    showtime_id INT,
    booking_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,0),
    status ENUM('Đã thanh toán','Chưa thanh toán') DEFAULT 'Đã thanh toán',
    payment_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (showtime_id) REFERENCES showtimes(id),
    FOREIGN KEY (payment_id) REFERENCES payments(id)
);

CREATE TABLE booking_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    seat_id INT,
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (seat_id) REFERENCES seats(id)
);

CREATE TABLE tickets (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_detail_id INT NOT NULL,
    ticket_code VARCHAR(20) NOT NULL UNIQUE,     
    issue_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Còn hiệu lực', 'Đã sử dụng', 'Đã hủy') DEFAULT 'Còn hiệu lực',
    FOREIGN KEY (booking_detail_id) REFERENCES booking_details(id)
);

CREATE TABLE food_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    food_id VARCHAR(100),
    quantity INT DEFAULT 1,
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (food_id) REFERENCES foods(id)
);
