CREATE TABLE OrderV1 (
    orderid INT AUTO_INCREMENT PRIMARY KEY,
    userid INT NOT NULL,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    totalPrice DECIMAL(10, 2) NOT NULL,
    orderStatus ENUM('Pending', 'Processing', 'Cancelled') DEFAULT 'Pending',
    FOREIGN KEY (userid) REFERENCES User(userid) ON DELETE CASCADE
);
