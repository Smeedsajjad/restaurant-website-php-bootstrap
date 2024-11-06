<?php
require_once 'Cart.php';
require_once '../config/config.php';

$cart = new Cart($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $removed = $cart->removeItem($productId);

    echo json_encode(['success' => $removed]);
}
