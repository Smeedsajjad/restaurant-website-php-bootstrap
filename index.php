<?php
require_once './admin/config/config.php';

$database = new Database();
$dbConnection = $database->conn;

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define the base path for views
$baseViewPath = './public/';

// Initialize the flag for invalid pages
$invalidPage = false;

// Define the `id` if provided in the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check the validity of the `id` for specific pages
if ($id > 0) {
    switch ($page) {
        case 'product':
            $stmt = $dbConnection->prepare("SELECT id FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) $invalidPage = true; // No product found
            break;

        case 'orders':
            $stmt = $dbConnection->prepare("SELECT id FROM orders WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) $invalidPage = true; // No order found
            break;

        case 'order-details':
            $stmt = $dbConnection->prepare("SELECT id FROM billingdetails WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) $invalidPage = true; // No order details found
            break;

        case 'cart':
            $stmt = $dbConnection->prepare("SELECT id FROM cart WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) $invalidPage = true; // No cart entry found
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
    case 'home':
        $pageContent = $baseViewPath . 'home.php';
        break;
    case 'login':
        $pageContent = $baseViewPath . 'login.php';
        break;
    case 'signup':
        $pageContent = $baseViewPath . 'signup.php';
        break;
    case 'logout':
        $pageContent = $baseViewPath . 'logout.php';
        break;
    case 'product':
        $pageContent = $baseViewPath . 'product.php';
        break;
    case 'cart':
        $pageContent = $baseViewPath . 'cart.php';
        break;
    case 'orders':
        $pageContent = $baseViewPath . 'orders.php';
        break;
    case 'order-details':
        $pageContent = $baseViewPath . 'order-details.php';
        break;
    case 'checkout':
        $pageContent = $baseViewPath . 'checkout.php';
        break;
    case 'menu':
        $pageContent = $baseViewPath . 'menu.php';
        break;
    case 'contact':
        $pageContent = $baseViewPath . 'contact.php';
        break;
    case 'shop':
        $pageContent = $baseViewPath . 'shop.php';
        break;
    case 'about':
        $pageContent = $baseViewPath . 'about.php';
        break;
    case '404':
        $pageContent = $baseViewPath . '404.php';
        break;
    default:
        $pageContent = $baseViewPath . '404.php';
}

// Include the selected page content
include $pageContent;
?>
