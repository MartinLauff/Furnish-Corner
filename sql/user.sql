CREATE TABLE User (
    userid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') NOT NULL DEFAULT 'customer',
    isLogged BOOLEAN NOT NULL DEFAULT FALSE
);
INSERT INTO User (name, password, role)
VALUES 
('John123', 'testpass123', 'customer'),
('Bob123', 'testpass123', 'admin');
