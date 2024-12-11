CREATE TABLE ProductBase (
    pid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    short_description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    subid INT NOT NULL,
    FOREIGN KEY (subid) REFERENCES Subcategory(subid) ON DELETE CASCADE
);
INSERT INTO ProductBase (pid, name, short_description, price, subid)
VALUES 
(1, 'Classic Wardrobe', 'Based Wardrobe made from artisan oak', 249.99, 2),
(2, 'Closet System', 'A wall-to-wall wardrobe with extra containing space', 599.99, 2),
(3, 'Double Bed', 'Large bed frame with padded headbord', 549.99, 1),
(4, 'Kids\' Bed', 'Bed frame with storage', 219.99, 1),
(5, 'Smart Curtains', 'Remote and time controled blinds', 149.00, 3),
(6, 'Sound System', 'Sleek sound setup that blends with furnture', 710.00, 3),
(7, 'Sofa', 'Small couch to place in front of a TV', 399.00, 4),
(8, 'L-Shaped Sectional Couch', 'A comfy place for a quik nap', 1525.00, 4);
