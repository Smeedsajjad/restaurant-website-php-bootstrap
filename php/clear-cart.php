<?php
session_start();
require_once '../admin/config/config.php';
require_once 'Cart.php';

try {
    $database = new Database();
    $db = $database->conn;
    
    // Create cart instance
    $cart = new Cart($db);
    
    // Clear cart items
    if (isset($_SESSION['user_id'])) {
        $cart->clearCart($_SESSION['user_id']);
    }
    
    // Clear cart session
    unset($_SESSION['cart']);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Cart cleared successfully'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
