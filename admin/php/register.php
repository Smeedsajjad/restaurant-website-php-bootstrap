<?php
require_once './admin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $admin = new Admin($database);

    $response = $admin->register($username, $email, $password);

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
