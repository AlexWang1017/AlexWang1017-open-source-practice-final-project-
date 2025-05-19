-- 建立資料庫（如果尚未存在）
CREATE DATABASE IF NOT EXISTS message_wall DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 使用該資料庫
USE message_wall;

-- 建立留言表
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nickname VARCHAR(50) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    like_count INT DEFAULT 0
);
