<?php
require_once '../config/config.php';
require_once 'Cart.php';

$database = new Database();
$dbConnection = $database->conn;

$cart = new Cart($dbConnection);

// Assuming the user ID is available in the session
session_start();
$userId = $_SESSION['user_id'] ?? null;

if ($userId) {
    $response = [
        'status' => 'success',
        'count' => $cart->getCartCount($userId)
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'User not logged in.'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
