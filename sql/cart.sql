CREATE TABLE Cart (
    cartid INT PRIMARY KEY AUTO_INCREMENT,
    userid INT NOT NULL,
    productid INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    FOREIGN KEY (userid) REFERENCES User(userid) ON DELETE CASCADE,
    FOREIGN KEY (productid) REFERENCES ProductBase(pid) ON DELETE CASCADE
);
INSERT INTO Cart (userid, productid, quantity)
VALUES 
(1, 1, 2),
(1, 3, 1),
(2, 2, 5);
