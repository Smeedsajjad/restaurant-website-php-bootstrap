<?php
require_once './config/config.php';

$database = new Database();
$dbConnection = $database->conn;

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Define the base path for views
$baseViewPath = './views/';

// Initialize the flag for invalid pages
$invalidPage = false;

// Define the `id` if provided in the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Database validation for specific pages with an `id`
if ($id > 0) {
    switch ($page) {
        case 'edit-category':
            $stmt = $conn->prepare("SELECT id FROM categories WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) $invalidPage = true; // Category not found
            break;

        case 'edit-products':
            $stmt = $conn->prepare("SELECT id FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) $invalidPage = true; // Product not found
            break;

        case 'order-view':
            $stmt = $conn->prepare("SELECT id FROM orders WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) $invalidPage = true; // Order not found
            break;

        default:
            // Do nothing for other pages
            break;
    }
}

// Redirect to 404 if the page is invalid
if ($invalidPage) {
    $page = '404';
}

// Determine the content to include based on the `page` parameter
switch ($page) {
    case 'dashboard':
        $pageContent = $baseViewPath . 'dashboard.php';
        break;
    case 'login':
        $pageContent = $baseViewPath . 'login.php';
        break;
    case 'register':
        $pageContent = $baseViewPath . 'register.php';
        break;
    case 'logout':
        $pageContent = $baseViewPath . 'logout.php';
        break;
    case 'add-category':
        $pageContent = $baseViewPath . 'add-category.php';
        break;
    case 'manage-category':
        $pageContent = $baseViewPath . 'manage-category.php';
        break;
    case 'edit-category':
        $pageContent = $baseViewPath . 'edit-category.php';
        break;
    case 'add-products':
        $pageContent = $baseViewPath . 'add-products.php';
        break;
    case 'manage-products':
        $pageContent = $baseViewPath . 'manage-products.php';
        break;
    case 'edit-products':
        $pageContent = $baseViewPath . 'edit-products.php';
        break;
    case 'orders':
        $pageContent = $baseViewPath . 'orders.php';
        break;
    case 'messages':
        $pageContent = $baseViewPath . 'messages.php';
        break;
    case 'order-view':
        $pageContent = $baseViewPath . 'order-view.php';
        break;
    default:
        $pageContent = $baseViewPath . '404.php';
        break;
}

// Include the selected page content
include $pageContent;
