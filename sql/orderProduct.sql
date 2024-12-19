CREATE TABLE OrderProduct (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orderid INT NOT NULL,
    productid INT NOT NULL,
    quantity INT NOT NULL CHECK (quantity > 0),
    FOREIGN KEY (orderid) REFERENCES OrderV1(orderid) ON DELETE CASCADE,
    FOREIGN KEY (productid) REFERENCES ProductBase(pid) ON DELETE CASCADE
);