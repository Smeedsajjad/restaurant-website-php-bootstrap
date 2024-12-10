<?php
class Admin
{
    private $db;
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Register the admin with optional image upload
    public function registerAdmin($username, $password, $image = null)
    {
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
    private function uploadImage($image)
    {
        $targetDir = 'uploads/admin/';
        $fileName = basename($image['name']);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($image['tmp_name'], $targetFilePath);
        return $targetFilePath;
    }

    // Method for admin login
    public function loginAdmin($username, $password)
    {
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
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: index.php?page=login"); // Redirect to login page
        exit; // Add exit after header redirect
    }

    // Method to check session timeout
    public function checkSession()
    {
        if (isset($_SESSION['last_activity'])) {
            $sessionDuration = time() - $_SESSION['last_activity'];
            if ($sessionDuration > 86400) {
                $this->logout();
            }
        }
        $_SESSION['last_activity'] = time(); // Update last activity time
    }
    // Method to get total users
    public function getTotalUsers()
    {
        $sql = "SELECT COUNT(*) as total FROM users"; // Adjust table name as necessary
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_assoc()['total'] : 0;
    }

    // Method to get orders today
    public function getOrdersToday()
    {
        $today = date('Y-m-d');
        $sql = "SELECT COUNT(*) as total FROM orders WHERE DATE(created_at) = '$today'"; // Adjust table and column names as necessary
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_assoc()['total'] : 0;
    }

    // Method to get revenue today
    public function getRevenueToday()
    {
        $today = date('Y-m-d');
        $sql = "SELECT SUM(total_amount) as total FROM orders WHERE DATE(created_at) = '$today'"; // Adjust table and column names as necessary
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_assoc()['total'] : 0;
    }

    // Method to get total orders
    public function getTotalQuantity()
    {
        $sql = "SELECT SUM(quantity) as total FROM order_items"; // Adjust table name as necessary
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_assoc()['total'] : 0;
    }
    // Method to get monthly orders count
    public function getMonthlyOrders()
    {
        $currentYear = date('Y');
        $sql = "SELECT MONTH(created_at) as month, COUNT(*) as total FROM orders WHERE YEAR(created_at) = '$currentYear' GROUP BY MONTH(created_at)";
        $result = $this->conn->query($sql);

        $monthlyOrders = array_fill(1, 12, 0); // Initialize an array for 12 months with 0

        while ($row = $result->fetch_assoc()) {
            $monthlyOrders[$row['month']] = $row['total'];
        }

        return $monthlyOrders;
    }
    // Method to get orders count by category
    public function getOrdersByCategory() {
        $sql = "SELECT p.category_id, c.cat_name, COUNT(oi.id) as total 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                JOIN categories c ON p.category_id = c.category_id 
                GROUP BY p.category_id"; // Group by category_id
    
        $result = $this->conn->query($sql);
        
        $categoryData = [];
        while ($row = $result->fetch_assoc()) {
            $categoryData[$row['cat_name']] = $row['total']; // Use cat_name for better readability
        }
    
        return $categoryData; // Return an associative array of category names and counts
    }
}
