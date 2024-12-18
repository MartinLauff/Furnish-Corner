<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    die("You must be logged in to place an order.");
}

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    die("Your cart is empty.");
}

// User ID from session
$userid = $_SESSION['userid'];

// Calculate the total
$cart = $_SESSION['cart'];
$grandTotal = 0;
foreach ($cart as $item) {
    $grandTotal += $item['price'] * $item['quantity'];
}

// Insert the order into the Orders table
$sql = "INSERT INTO Orders (userid, total) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("id", $userid, $grandTotal);

if ($stmt->execute()) {
    // Get the generated order ID
    $orderid = $stmt->insert_id;

    // Insert the order details
    $sql = "INSERT INTO OrderDetails (orderid, productid, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($cart as $pid => $item) {
        $quantity = $item['quantity'];
        $price = $item['price'];
        $stmt->bind_param("iiid", $orderid, $pid, $quantity, $price);
        $stmt->execute();
    }

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to a confirmation page
    header("Location: orderConfirmation.php?orderid=$orderid");
    exit;
} else {
    die("Failed to place the order.");
}
?>
