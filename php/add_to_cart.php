<?php
session_start();
include_once '../config/config.php';
include_once 'Cart.php';

$database = new Database();
$dbConnection = $database->conn; // This should be a MySQLi connection

$cart = new Cart($dbConnection);

$response = ['status' => 'error', 'message' => 'Unknown error']; // Default response

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if ($product_id && $quantity > 0) {
            // Attempt to add the product to the cart
            $addToCartResponse = $cart->addToCart($product_id, $quantity);

            // Check if the product was added successfully
            if ($addToCartResponse['status'] === 'success') {
                // Fetch the product name from the database using MySQLi
                $stmt = $dbConnection->prepare("SELECT name FROM products WHERE id = ?");
                $stmt->bind_param("i", $product_id); // Bind the parameter
                $stmt->execute();
                $result = $stmt->get_result(); // Get the result set from the prepared statement
                $product = $result->fetch_assoc(); // Fetch the product details

                if ($product) {
                    $response['status'] = 'success';
                    $response['product_name'] = $product['name']; // Add product name to the response
                } else {
                    $response['message'] = 'Product not found.';
                }
            } else {
                $response['message'] = $addToCartResponse['message']; // Use message from addToCart response
            }
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

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>