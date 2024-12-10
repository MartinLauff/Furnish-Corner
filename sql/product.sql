CREATE TABLE Product (
    pid INT PRIMARY KEY,
    description TEXT NOT NULL,
    imagepath VARCHAR(255),
    FOREIGN KEY (pid) REFERENCES ProductBase(pid) ON DELETE CASCADE
);
INSERT INTO ProductBase (pid, name, short_description, price, category, subcategory)
VALUES 
(1, 'Classic Wardrobe', 'Based Wardrobe made from artisan oak', 249.99, 'bedroom', 'wardrobe'),
(2, 'Closet System', 'A wall-to-wall wardrobe with extra containing space', 599.99, 'bedroom', 'wardrobe'),
(3, 'Double Bed', 'Large bed frame with padded headbord', 549.99, 'bedroom', 'beds'),
(4, 'Kids\' Bed', 'Bed frame with storage', 219.99, 'bedroom', 'beds'),
(5, 'Smart Curtains', 'Remote and time controled blinds', 149.00, 'living-room', 'devices'),
(6, 'Sound System', 'Sleek sound setup that blends with furnture', 710.00, 'living-room', 'devices'),
(7, 'Sofa', 'Small couch to place in front of a TV', 399.00, 'living-room', 'couches'),
(8, 'L-Shaped Sectional Couch', 'A comfy place for a quik nap', 1525.00, 'living-room', 'couches');
