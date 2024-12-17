<?php
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = ""; // Default for XAMPP
$dbname = "myWebShop"; // Replace with your database name


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Place this logic here
$isLoggedIn = isset($_SESSION['userid']);
$isCartFull = isset($_SESSION['cart']) && count($_SESSION['cart']) > 0;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
