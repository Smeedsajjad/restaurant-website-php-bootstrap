<?php
// In load_more_products.php
require_once '../admin/config/config.php'; // Ensure this path is correct

// Create a new instance of the Database class
$db = new Database();
$conn = $db->conn; // Get the connection from the Database instance

$offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 6; // Default to 6 products per page

// Get total products count
$totalProductsQuery = "SELECT COUNT(*) as total FROM products";
$totalProductsResult = mysqli_query($conn, $totalProductsQuery);
$totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
$totalProducts = $totalProductsRow['total'];

// Fetch products
$sql = "SELECT * FROM products ORDER BY id DESC LIMIT $offset, $limit";
$run_sql = mysqli_query($conn, $sql);
$products = [];

if (mysqli_num_rows($run_sql) > 0) {
    while ($row = mysqli_fetch_assoc($run_sql)) {
        $products[] = $row;
    }
}

// Return JSON response
echo json_encode(['products' => $products, 'total' => $totalProducts]);

// Close the database connection
$db->close();
?>