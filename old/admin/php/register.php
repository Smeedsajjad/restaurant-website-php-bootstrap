<?php
session_start();
require_once '../../config/config.php';
require_once '../classes/Admin.php';

// Create a new Database object and get the connection
$database = new Database();
$conn = $database->getConnection();

// Check if the registration form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get form input data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Hash the password using password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Generate a remember token
    $remember_token = bin2hex(random_bytes(16));

    // Prepare an SQL query to insert the admin data
    $query = "INSERT INTO admins (username, email, password, created_at, remember_token) VALUES (?, ?, ?, NOW(), ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters (s = string)
        $stmt->bind_param('ssss', $username, $email, $hashed_password, $remember_token);
        
        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the login page upon successful registration
            header("Location: ../login.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
