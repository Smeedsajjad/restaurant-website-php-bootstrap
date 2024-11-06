<?php
require_once 'Cart.php';
require_once '../config/config.php';

$cart = new Cart($db);

$items = $cart->getCartItems();
$total = $cart->getCartTotal();

echo json_encode(['items' => $items, 'total' => $total]);
