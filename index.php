<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Define the base path for views
$baseViewPath = './public/';

// Determine the content to include based on the `page` parameter
switch($page) {
    case 'home':
        $pageContent = $baseViewPath . 'home.php';
        break;
    case 'menu':
        $pageContent = $baseViewPath . 'menu.html';
        break;
    case 'contact':
        $pageContent = $baseViewPath . 'contact.html';
        break;
    case 'about':
        $pageContent = $baseViewPath . 'about.html';
        break;
    default:
        $pageContent = $baseViewPath . 'home.php';
}

// Include the selected page content
include $pageContent;
?>
