<?php
require_once './admin/config/config.php'; // Adjust the path as necessary
require_once './admin/php/ProductController.php'; // Adjust the path as necessary

$database = new Database();
$dbConnection = $database->conn;
$productController = new ProductController($dbConnection);

try {
    // Check if the method exists
    if (!method_exists($productController, 'getProductsLoadMore')) {
        throw new Exception("Method getProductsLoadMore does not exist.");
    }

    // Call the method to test
    $products = $productController->getProductsLoadMore(0, 6); // Test with offset 0 and limit 6
    echo json_encode($products);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>