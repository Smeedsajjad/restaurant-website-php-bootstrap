<?php
session_start();
include_once '../config/config.php';
include_once 'Cart.php';

$database = new Database();
$dbConnection = $database->conn;

$cart = new Cart($dbConnection);

// Default response
$response = ['status' => 'error', 'count' => 0];

try {
    $count = $cart->getCartCount(); // Fetch cart count
    $response['status'] = 'success';
    $response['count'] = $count;
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit();
