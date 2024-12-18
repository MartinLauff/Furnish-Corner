<?php
session_start();
include 'db.php';

if (!isset($_GET['orderid'])) {
    die("Invalid order.");
}

$orderid = $_GET['orderid'];

// Fetch order details
$sql = "SELECT o.orderid, o.order_date, o.total, od.productid, od.quantity, od.price, p.name
        FROM Orders o
        JOIN OrderDetails od ON o.orderid = od.orderid
        JOIN ProductBase p ON od.productid = p.pid
        WHERE o.orderid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h1>Order Confirmation</h1>";
    echo "<p>Order ID: $orderid</p>";
    echo "<table border='1'>";
    echo "<tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $total = $row['quantity'] * $row['price'];
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . number_format($row['price'], 2) . "€</td>";
        echo "<td>" . number_format($total, 2) . "€</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p>Total with Tax: " . number_format($result->fetch_assoc()['total'], 2) . "€</p>";
} else {
    echo "<p>Order not found.</p>";
}
?>
