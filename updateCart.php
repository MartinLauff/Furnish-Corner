<?php
session_start();

// Initialize response array
$response = ['success' => false];

// Check if action and pid are provided
if (isset($_POST['action'], $_POST['pid'])) {
    $action = $_POST['action'];
    $pid = $_POST['pid'];

    if (isset($_SESSION['cart'][$pid])) {
        $item = $_SESSION['cart'][$pid];

        // Update quantity based on the action
        if ($action === 'add') {
            $_SESSION['cart'][$pid]['quantity'] += 1;
        } elseif ($action === 'sub' && $_SESSION['cart'][$pid]['quantity'] > 1) {
            $_SESSION['cart'][$pid]['quantity'] -= 1;
        }

        // Recalculate total and grand total
        $quantity = $_SESSION['cart'][$pid]['quantity'];
        $total = $quantity * $item['price'];
        $grandTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart']));

        // Send updated values back
        $response['success'] = true;
        $response['quantity'] = $quantity;
        $response['total'] = $total;
        $response['grandTotal'] = $grandTotal;
    }
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
