<?php
error_reporting(0); // Disable error reporting for production
header('Content-Type: application/json');
require_once '../config/config.php';

$response = ['status' => 'error', 'message' => 'Invalid request'];
$database = new Database();
$dbConnection = $database->conn;

// Check if the request method is POST and the 'cart_id' is set in the POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];

    // Prepare the SQL query to delete the cart item by ID
    $sql = "DELETE FROM cart WHERE id = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param("i", $cartId);

    if ($stmt->execute()) {
        $response = ['status' => 'success', 'message' => 'Item removed successfully'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to remove item'];
    }

    $stmt->close();
} else {
    $response = ['status' => 'error', 'message' => 'No cart ID received'];
}

$dbConnection->close();

echo json_encode($response);
exit;
