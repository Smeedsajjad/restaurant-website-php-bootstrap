<?php
session_start();
require_once '../../config/config.php';
require_once '../classes/Admin.php';

// Create a new Database object and get the connection
$database = new Database();
$conn = $database->getConnection();

// Initialize the Admin class
$admin = new Admin($conn);

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the login form data
    $admin->email = $_POST['email'];
    $admin->password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']) ? true : false;

    // Call the login function
    $login_response = $admin->login($remember_me);

    // If login failed, display error message
    if ($login_response !== true) {
        echo $login_response;
    }
}
?>
