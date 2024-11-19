<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define the base path for views
$baseViewPath = './public/';

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
    case 'shop':
        $pageContent = $baseViewPath . 'shop.php';
        break;
    case 'product':
        $pageContent = $baseViewPath . 'product.php';
        break;
    case 'cart':
        $pageContent = $baseViewPath . 'cart.php';
        break;
        case 'checkout':
            $pageContent = $baseViewPath . 'checkout.php';
            break;
    case 'menu':
        $pageContent = $baseViewPath . 'menu.html';
        break;
    case 'contact':
        $pageContent = $baseViewPath . 'contact.html';
        break;
    case 'shop':
        $pageContent = $baseViewPath . 'shop.html';
        break;
    case 'about':
        $pageContent = $baseViewPath . 'about.html';
        break;
    case '404':
        $pageContent = $baseViewPath . '404.php';
        break;
    default:
        $pageContent = $baseViewPath . '404.php';
}

// Include the selected page content
include $pageContent;
