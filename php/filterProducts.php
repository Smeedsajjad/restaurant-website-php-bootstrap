<?php
// Include database connection and ProductController
include '../admin/config/config.php';
include '../admin/php/ProductController.php';
// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Ensure $dbConnection is passed to the ProductController
$productController = new ProductController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['category_id'])) {
        $categoryId = $_POST['category_id'];
        
        // Fetch products by category
        $products = $productController->getProductsByCategory($categoryId);
        
        // Return JSON response
        echo json_encode($products);
    } elseif (isset($_POST['search_query'])) {
        $searchQuery = $_POST['search_query'];
        
        // Fetch products by search query
        $products = $productController->searchProducts($searchQuery);
        
        // Return JSON response
        echo json_encode($products);
    } elseif (isset($_POST['price_min']) && isset($_POST['price_max'])) {
        $priceMin = $_POST['price_min'];
        $priceMax = $_POST['price_max'];
        
        // Fetch products by price range
        $products = getProductsByPriceRange($dbConnection, $priceMin, $priceMax);
        
        // Return JSON response
        echo json_encode($products);
    } elseif (isset($_POST['get_max_price'])) {
        // Fetch the maximum price
        $maxPrice = getMaxPrice($dbConnection);
        
        // Return JSON response
        echo json_encode(['max_price' => $maxPrice]);
    } else {
        echo json_encode([]);
    }
}

// Function to get products by price range
function getProductsByPriceRange($dbConnection, $priceMin, $priceMax) {
    $query = "SELECT * FROM products WHERE price BETWEEN ? AND ?";
    $stmt = $dbConnection->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("dd", $priceMin, $priceMax);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $products;
    } else {
        throw new Exception("Failed to prepare SQL statement.");
    }
}

// Function to get the maximum price
function getMaxPrice($dbConnection) {
    $query = "SELECT MAX(price) as max_price FROM products";
    $result = $dbConnection->query($query);
    $row = $result->fetch_assoc();
    return $row['max_price'];
}