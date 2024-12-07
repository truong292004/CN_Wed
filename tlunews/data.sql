CREATE DATABASE tlunews;
USE tlunews;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role TINYINT NOT NULL DEFAULT 0, -- 0: user, 1: admin
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
INSERT INTO users (username, password, role) VALUES
('admin', 'admin123', 1), -- Mật khẩu: admin123
('user1', 'user123', 0); -- Mật khẩu: user123
INSERT INTO categories (name) VALUES
('Tin tức chính trị'),
('Tin tức thể thao'),
('Tin tức giải trí'),
('Tin tức công nghệ');
INSERT INTO news (title, content, image, category_id) VALUES
('Tin tức chính trị 1', 'Nội dung tin tức chính trị 1', 'hanquo.jpg', 1),
('Tin tức thể thao 1', 'Nội dung tin tức thể thao 1', 'dabong.jpg', 2),
('Tin tức giải trí 1', 'Nội dung tin tức giải trí 1', 'atsh.jpg', 3),
('Tin tức công nghệ 1', 'Nội dung tin tức công nghệ 1', 'bitcoin.jpg', 4);