CREATE DATABASE IF NOT EXISTS mbc CHARACTER SET utf8mb4;
USE mbc;

DROP TABLE IF EXISTS utilisateurs;
CREATE TABLE utilisateurs ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(20) DEFAULT 'user' );
INSERT INTO utilisateurs (username, password, role) VALUES ('adminweb', 'adminweb', 'adminweb'), ('adminsys', 'adminsys', 'adminsys');