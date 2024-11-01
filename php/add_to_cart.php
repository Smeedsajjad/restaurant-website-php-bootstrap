<?php
session_start();
include_once '../config/config.php';
include_once 'Cart.php';

$database = new Database();
$dbConnection = $database->conn;

$cart = new Cart($dbConnection);


$response = ['status' => 'error', 'message' => 'Unknown error']; // Default response with message

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if ($product_id && $quantity > 0) {
            $response = $cart->addToCart($product_id, $quantity);
            echo json_encode($response);
        } else {
            $response['message'] = 'Invalid product ID or quantity.';
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }
} catch (Exception $e) {
    // Catch any exceptions and report
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response);
?>