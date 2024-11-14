<?php
session_start();
require_once '../config/config.php';
require_once 'Cart.php';

$response = ['status' => 'error', 'message' => 'Unknown error'];

if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, send a specific response
    $response = [
        'status' => 'not_logged_in',
        'message' => 'Please log in to add items to your cart.'
    ];
    echo json_encode($response);
    exit();
}

$database = new Database();
$dbConnection = $database->conn;
$cart = new Cart($dbConnection);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;

        if ($product_id) {
            $addToCartResponse = $cart->addToCart($product_id, $quantity, $_SESSION['user_id']);

            if ($addToCartResponse['status'] === 'success') {
                $response = [
                    'status' => 'success',
                    'message' => 'Product added to cart.',
                    'cart_count' => $cart->getCartCount($_SESSION['user_id'])
                ];
            } else {
                $response['message'] = $addToCartResponse['message'];
            }
        } else {
            $response['message'] = 'Invalid product ID.';
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
