<?php
require_once '../admin/config/config.php';
require_once 'ProductController.php';

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Create the ProductController with the database connection
$productController = new ProductController($dbConnection);

// Get offset and limit from the POST request
$offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 9;

// Fetch the products based on offset and limit
$products = $productController->getProductsLoadMore($offset, $limit);

// Return the products as a JSON response
echo json_encode($products);
?>
