<?php
session_start();
include_once 'config/config.php';
include_once 'php/Cart.php';

$cart = new Cart($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'remove') {
        $productId = $_POST['productId'];
        $response = $cart->removeFromCart($productId);
        echo json_encode($response);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cartItems = $cart->getCartItems();
    $subtotal = $cart->getCartSubtotal();
    
    error_log("Cart Items: " . print_r($cartItems, true));
    error_log("Subtotal: " . $subtotal);

    echo json_encode(['items' => $cartItems, 'subtotal' => $subtotal]);
    exit;
}