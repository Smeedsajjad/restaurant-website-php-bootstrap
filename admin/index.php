<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Define the base path for views
$baseViewPath = './views/';

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
        $pageContent = $baseViewPath . 'add-category.php'; // Page to add a category
        break;
    case 'manage-category':
        $pageContent = $baseViewPath . 'manage-category.php'; // Page to manage categories
        break;
    case 'edit-category':
        $pageContent = $baseViewPath . 'edit-category.php'; // Page to edit a category
        break;
    case 'add-products':
        $pageContent = $baseViewPath . 'add-products.php'; // Page to add a category
        break;
    case 'manage-products':
        $pageContent = $baseViewPath . 'manage-products.php'; // Page to manage Products
        break;
    case 'edit-products':
        $pageContent = $baseViewPath . 'edit-products.php'; // Page to manage Products
        break;
    default:
        $pageContent = $baseViewPath . 'dashboard.php'; // Default to dashboard if no valid page is found
}

// Include the selected page content
include $pageContent;
