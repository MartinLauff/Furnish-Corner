<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to cart or increase quantity
    if (isset($_SESSION['cart'][$pid])) {
        $_SESSION['cart'][$pid]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$pid] = [
            'pid' => $pid,
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        ];
    }

    // Redirect back to the product page or cart
    header("Location: shoppingCart.php");
    exit;
}
?>
