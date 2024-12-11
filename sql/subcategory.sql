CREATE TABLE Subcategory (
    subid INT PRIMARY KEY AUTO_INCREMENT,
    categoryid INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    FOREIGN KEY (categoryid) REFERENCES Category(catid) ON DELETE CASCADE
);
INSERT INTO Subcategory (subid, categoryid, name, description)
VALUES 
(1, 1, 'Beds', 'Beds that match everyones style'),
(2, 1, 'Wardrobes', 'Wardrobes in any sizes'),
(3, 2, 'Devices', 'Devices for improved life comfort'),
(4, 2, 'Couches', 'Couches for extra coziness');
SELECT 
	s.name AS category_name,
    pb.name,
    pb.short_description,
    pb.price,
    pb.pid
FROM subcategory s
LEFT JOIN productbase pb
ON s.subid = pb.subid
WHERE s.subid = 1;