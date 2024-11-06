<?php
require_once 'config.php';
require_once 'Cart.php';

$database = new Database();
$dbConnection = $database->conn;

$cart = new Cart($dbConnection);

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $result = $cart->removeFromCart($productId);

    echo json_encode(['status' => $result ? 'success' : 'error']);
}
?>
