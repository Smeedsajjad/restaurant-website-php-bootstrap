<?php
require_once './admin.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $admin = new Admin($database);

    $response = $admin->login($email, $password);

    if ($response['success']) {
        // Set a cookie or session
        setcookie('admin_logged_in', true, time() + (86400 * 30), "/"); // 30 days expiration
        
        // Redirect to the index page
        header('Location: index.php');
        exit();
    } else {
        // Redirect back to the login page with an error message
        header('Location: login.php?error=' . urlencode($response['message']));
        exit();
    }
} else {
    // Redirect to login page if not a POST request
    header('Location: login.php');
    exit();
}
?>
