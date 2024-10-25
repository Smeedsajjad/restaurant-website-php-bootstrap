<?php
class Admin {
    private $db;
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Register the admin with optional image upload
    public function registerAdmin($username, $password, $image = null) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Handle image upload
        if ($image && $image['error'] == 0) {
            $imagePath = $this->uploadImage($image);
        } else {
            // Use the default image if no image is provided
            $imagePath = './uploads/default.png'; // Default image path
        }

        // Insert the admin data into the database
        $query = "INSERT INTO admin (username, password, image) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sss', $username, $hashedPassword, $imagePath);

        return $stmt->execute(); // Return true or false
    }

    // Method to upload image
    private function uploadImage($image) {
        $targetDir = 'uploads/admin/';
        $fileName = basename($image['name']);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($image['tmp_name'], $targetFilePath);
        return $targetFilePath;
    }

    // Method for admin login
    public function loginAdmin($username, $password) {
        $query = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                session_start(); // Ensure session is started
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['username'] = $admin['username'];  // Setting username in session
                $_SESSION['last_activity'] = time();
                return true;
            }
        }
        return false;
    }
    

    // Method to logout
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: index.php?page=login"); // Redirect to login page
        exit; // Add exit after header redirect
    }

    // Method to check session timeout
    public function checkSession() {
        if (isset($_SESSION['last_activity'])) {
            $sessionDuration = time() - $_SESSION['last_activity'];
            if ($sessionDuration > 86400) {
                $this->logout();
            }
        }
        $_SESSION['last_activity'] = time(); // Update last activity time
    }
}
?>
