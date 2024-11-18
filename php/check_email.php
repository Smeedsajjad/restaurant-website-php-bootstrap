<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'UserController.php';

header('Content-Type: application/json');

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $userController = new UserController();

    // Check if the email exists
    if ($userController->checkEmailExists($email)) {
        $response = ['status' => 'exists']; // Email is already registered
    } else {
        // Proceed with the signup logic here, if applicable
        $response = ['status' => 'success', 'message' => 'Signed up successfully'];
    }

    echo json_encode($response);
    exit(); // Ensure no further output is sent after JSON response
}
