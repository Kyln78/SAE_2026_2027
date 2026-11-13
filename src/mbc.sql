CREATE DATABASE IF NOT EXISTS mbc CHARACTER SET utf8mb4;
USE mbc;

DROP TABLE IF EXISTS utilisateurs;
CREATE TABLE utilisateurs ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(20) DEFAULT 'user' );
INSERT INTO utilisateurs (username, password, role) VALUES ('adminweb', '$2y$12$PRZ3VAHhT/L4QigjdE2w4OXfXM4evjkfbcvTNkMSgjM8DmVcreWNm', 'adminweb'), ('adminsys', '$2y$12$OPB9mWjcR9T2ZMEV3bSTmuxZSU0Q30hEjNGFrCeJGpEDHah7mv6wq', 'adminsys');