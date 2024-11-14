<?php
require_once(__DIR__ . '/../config/config.php');

class UserController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Register a new user
    public function register($full_name, $username, $email, $password, $phone)
    {
        // Check if the username already exists
        $checkStmt = $this->db->conn->prepare("SELECT id FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            return "Username already exists. Please choose a different username.";
        }

        // Proceed with registration if username is unique
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->conn->prepare("INSERT INTO users (full_name, username, email, password, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $username, $email, $hashedPassword, $phone);

        if ($stmt->execute()) {
            // Get the user_id of the newly registered user
            $user_id = $this->db->conn->insert_id;

            // Store user_id in session
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            // Return the user object
            return [
                'id' => $user_id,
                'full_name' => $full_name,
                'username' => $username,
                'email' => $email,
                'phone' => $phone
            ];
        }

        return false; // Return false if registration fails
    }

    // Login the user and store user_id in session
    public function login($email, $password)
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return $user;  // Return user object if login is successful
        }
        return false; // Return false if login fails
    }

    // Logout the user and destroy the session
    public function logout()
    {
        session_start();
        session_unset();  // Unset all session variables
        session_destroy(); // Destroy the session
    }

    // Fetch products for the logged-in user
    public function getUserProducts()
    {
        if (!isset($_SESSION['user_id'])) {
            return false; // If user is not logged in, return false
        }

        $user_id = $_SESSION['user_id']; // Get user_id from session

        // Prepare SQL to fetch products for the logged-in user
        $stmt = $this->db->conn->prepare("SELECT * FROM products WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);  // Bind user_id to the query
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;  // Store each product
        }

        return $products;  // Return the list of products for the logged-in user
    }

    // Add a new product and associate it with the logged-in user
    public function addProduct($name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available)
    {
        // Get user_id from session
        if (!isset($_SESSION['user_id'])) {
            return false;  // If no user is logged in, return false
        }
        $user_id = $_SESSION['user_id'];

        // Insert product with user_id
        $stmt = $this->db->conn->prepare("INSERT INTO products (name, tagline, `desc`, category_id, ingredients, images, price, is_available, user_id) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssi", $name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available, $user_id);
        return $stmt->execute();  // Execute the query and add the product
    }

    // Check if the email already exists
    public function checkEmailExists($email)
    {
        $checkStmt = $this->db->conn->prepare("SELECT id FROM users WHERE email = ?");
        if (!$checkStmt) {
            die("Database prepare failed: " . $this->db->conn->error); // Check for prepare errors
        }
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        return $checkStmt->num_rows > 0; // Return true if email exists, false otherwise
    }
    public function addToUserCart($productId, $quantity)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            return ['status' => 'error', 'message' => 'User not logged in.'];
        }

        $userId = $_SESSION['user_id'];
        $cart = new Cart($this->db->conn); // Assuming Database instance is passed
        return $cart->addToCart($userId, $productId, $quantity);
    }


    public function getCartSubtotal($userId)
    {
        $stmt = $this->db->conn->prepare("SELECT SUM(p.price * c.quantity) AS subtotal 
                                      FROM cart c 
                                      JOIN products p ON c.product_id = p.id 
                                      WHERE c.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['subtotal'] ?? 0.00;
    }

    public function getCartCount($userId)
    {
        $stmt = $this->db->conn->prepare("SELECT SUM(quantity) AS count FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] ?? 0;
    }
}
