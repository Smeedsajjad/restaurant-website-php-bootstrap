<?php
require_once './config/config.php';
require_once './php/Admin.php';

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Create an Admin object
$admin = new Admin($dbConnection);

// Call the logout method
$admin->logout();
?>
