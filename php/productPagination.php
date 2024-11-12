<?php
require './ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $controller = new ProductController($db);
    $products = $controller->getProductsForPagination($page);
    $totalPages = $controller->getTotalPagesForPagination();

    echo json_encode(['products' => $products, 'totalPages' => $totalPages]);
}
?>