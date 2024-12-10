CREATE TABLE User (
    userid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL DEFAULT 'customer'
);
INSERT INTO User (name, password, role)
VALUES 
('John', 'testpass1', 'customer'),
('Bob', 'testpass2', 'admin');
