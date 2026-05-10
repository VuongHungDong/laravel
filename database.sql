CREATE DATABASE IF NOT EXISTS laravel;
USE laravel;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(256)
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(256),
    description VARCHAR(1024),
    image VARCHAR(2048),
    price DOUBLE,
    quantity INT,
    view INT,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(45),
    password VARCHAR(45),
    role VARCHAR(45)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(45),
    status VARCHAR(45),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    order_id INT,
    quantity INT,
    price DOUBLE,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Insert dummy data for Categories
INSERT IGNORE INTO categories (id, name) VALUES 
(1, 'Hoa Hồng'),
(2, 'Hoa Tulip'),
(3, 'Lan Hồ Điệp');

-- Insert 5 dummy products
INSERT IGNORE INTO products (id, name, description, image, price, quantity, view, category_id) VALUES 
(1, 'Mẫu Đơn Thượng Hạng', 'Loài hoa vương giả mang ý nghĩa phú quý', 'https://images.unsplash.com/photo-1591886960571-74d43a9d4166', 1850000, 10, 100, 1),
(2, 'Hồng Đỏ Cổ Điển', 'Hồng Ecuador nhập khẩu đỏ thắm', 'https://images.unsplash.com/photo-1582794543139-8ac9cb0f7b11', 1200000, 15, 250, 1),
(3, 'Tulip Hà Lan Mùa Xuân', 'Sự tươi mới thuần khiết từ Hà Lan', 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd', 850000, 20, 150, 2),
(4, 'Lan Hồ Điệp Mini', 'Trang trí bàn làm việc cực kỳ sang trọng', 'https://images.unsplash.com/photo-1528659551468-b302c0b56db1', 1500000, 8, 300, 3),
(5, 'Cẩm Tú Cầu Biển Xanh', 'Sắc xanh thơ mộng và êm đềm', 'https://images.unsplash.com/photo-1508611394142-6e2740fcae47', 750000, 12, 120, 1);
