<?php
// Include database connection
include 'db.php';
$errorMsg = '';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    $errorMsg = 'You need to be logged in to place an order.';
    die("You need to be logged in to place an order.");
}

// Check if the cart is empty
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart)) {
    $errorMsg = 'Your cart is empty. Add items to your cart before placing an order.';
    // die("Your cart is empty. Add items to your cart before placing an order.");
}

// Get the logged-in user's ID
$userid = $_SESSION['userid'];

try {
    // Start a transaction
    $conn->begin_transaction();

    // Calculate the total price
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    // Insert a new order into the `Order` table
    $orderSql = "INSERT INTO `OrderV1` (userid, totalPrice, orderStatus) VALUES (?, ?, 'Pending')";
    $orderStmt = $conn->prepare($orderSql);
    $orderStmt->bind_param("id", $userid, $totalPrice);
    $orderStmt->execute();
    $orderId = $conn->insert_id; // Get the ID of the newly created order

    // Insert each product into the `OrderProduct` table
    $orderProductSql = "INSERT INTO OrderProduct (orderid, productid, quantity) VALUES (?, ?, ?)";
    $orderProductStmt = $conn->prepare($orderProductSql);
    foreach ($cart as $pid => $item) {
        $orderProductStmt->bind_param("iii", $orderId, $pid, $item['quantity']);
        $orderProductStmt->execute();
    }

    // Commit the transaction
    $conn->commit();

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to the profile page with a success message
    header("Location: customer.php?message=Order placed successfully");
    exit;
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $conn->rollback();

    // Handle the error
    $errorMsg = "An error occurred while placing your order: " . $e->getMessage();
}
?>
<html>
    <head>
    </head>
    <body>
        <?php if (!empty($errorMsg)): ?>
            <div class="link-error" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);display: flex;align-items: center;flex-direction: column;">
                <h2 style="margin-left: 0">
                    <?php echo $errorMsg; ?>
                </h2>
                <a href=/myWebShop>Go Back</a>
            </div>
        <?php endif; ?>
    </body>
</html>