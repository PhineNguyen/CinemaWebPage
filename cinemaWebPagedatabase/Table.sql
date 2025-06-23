

USE cinemawebpage;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    pass_word VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    ro_lo ENUM('user','admin') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

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
    hotline VARCHAR(20)
);

CREATE TABLE rooms (
    id  INT AUTO_INCREMENT PRIMARY KEY,
    cinema_id VARCHAR(100),
    room_number VARCHAR(50) NOT NULL,
    total_seats INT,
    FOREIGN KEY (cinema_id) REFERENCES cinemas(id)
);
CREATE TABLE seats (
    id VARCHAR(10) PRIMARY KEY, -- Đổi sang mã ghế như 'R1-A1'
    room_id INT,
    seat_row CHAR(1),
    seat_number INT,
    seat_type ENUM('Ghế thường','Ghế VIP','Ghế đôi') DEFAULT 'Ghế thường',
    seat_status ENUM('Đã đặt','Ghế trống') DEFAULT 'Ghế trống',
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);


CREATE TABLE foods (
    id VARCHAR(100) PRIMARY KEY,
    namef VARCHAR(100) NOT NULL,
    descript TEXT,
    food_images VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    available BOOLEAN DEFAULT TRUE
);
CREATE TABLE food_variants (
  variant_id INT AUTO_INCREMENT PRIMARY KEY,
  food_id VARCHAR(10),
  size VARCHAR(10),  		-- 'small' or 'large'
  flavor VARCHAR(50),       -- e.g coca, sprite
  price INT,
  FOREIGN KEY (food_id) REFERENCES foods(id)
);


CREATE TABLE showtimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    room_id INT,
    show_date DATE,
    show_time TIME,
    price DECIMAL(10,2),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_method ENUM('Cash', 'Banking', 'Momo', 'ZaloPay') DEFAULT 'Cash',
    payment_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('success', 'failed')
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    showtime_id INT,
    booking_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2),
    status ENUM('paid','unpaid') DEFAULT 'unpaid',
    payment_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (showtime_id) REFERENCES showtimes(id),
    FOREIGN KEY (payment_id) REFERENCES payments(id)
);

CREATE TABLE booking_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    seat_id VARCHAR(100),
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (seat_id) REFERENCES seats(id)
);

CREATE TABLE food_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    food_id VARCHAR(100),
    quantity INT DEFAULT 1,
    FOREIGN KEY (booking_id) REFERENCES bookings(id),
    FOREIGN KEY (food_id) REFERENCES foods(id)
);
