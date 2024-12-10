<?php
session_start();
require_once '../admin/config/config.php';

$response = ['status' => 'error', 'message' => 'No items found'];

if (!isset($_SESSION['user_id'])) {
    $response['message'] = 'User not logged in';
    echo json_encode($response);
    exit();
}

$userId = $_SESSION['user_id'];
$database = new Database();
$dbConnection = $database->conn;

// Fetch cart items for the logged-in user
$sql = "SELECT cart.id AS cart_item_id, products.name, products.images, cart.quantity, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $dbConnection->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

if (count($cartItems) > 0) {
    $response = [
        'status' => 'success',
        'cart_items' => $cartItems
    ];
} else {
    $response['message'] = 'No items in the cart';
}

$stmt->close();
$dbConnection->close();

header('Content-Type: application/json');
echo json_encode($response);
exit();