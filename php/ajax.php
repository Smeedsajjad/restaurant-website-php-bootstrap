<?php
require_once 'User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    $user = new User();

    if ($action == 'register') {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];

        echo $user->register($full_name, $username, $email, $password, $phone);
    }

    if ($action == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        echo $user->login($email, $password);
    }

    if ($action == 'logout') {
        echo $user->logout();
    }

    $user->close();
}
?>