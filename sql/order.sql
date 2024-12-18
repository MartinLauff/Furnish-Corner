CREATE TABLE Orders (
    orderid INT AUTO_INCREMENT PRIMARY KEY,
    userid INT NOT NULL,
    productid INT NOT NULL,
    quantity INT NOT NULL CHECK (Quantity > 0),
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    orderStatus ENUM('Pending', 'Processing', 'Cancelled') DEFAULT 'Pending',

    FOREIGN KEY (userid) REFERENCES User(userid) ON DELETE CASCADE,
    FOREIGN KEY (productid) REFERENCES Product(pid) ON DELETE CASCADE
);
INSERT INTO Orders (userid, productid, quantity, orderStatus)
VALUES (1, 2, 3, 'Pending'),
VALUES (1, 1, 1, 'Processing');

