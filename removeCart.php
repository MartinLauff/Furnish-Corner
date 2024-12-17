<?php
session_start();

$response = ['success' => false];

// Check if the product ID (pid) is provided
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];

    // Check if the cart exists and the item is in the cart
    if (isset($_SESSION['cart'][$pid])) {
        unset($_SESSION['cart'][$pid]); // Remove the item

        // Recalculate the grand total
        $grandTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart']));

        // Check if the cart is now empty
        $isCartEmpty = empty($_SESSION['cart']);

        $response = [
            'success' => true,
            'grandTotal' => $grandTotal,
            'isCartEmpty' => $isCartEmpty
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);