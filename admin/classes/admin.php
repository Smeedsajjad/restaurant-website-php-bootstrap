<?php
class Admin
{
    private $conn;

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register()
    {
        // SQL query for inserting a new admin
        $query = "INSERT INTO admins (username, email, password, created_at, remember_token) VALUES (?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die('Prepare error: ' . $this->conn->error);
        }

        // Get current date for `created_at` and generate remember token
        $created_at = date('Y-m-d H:i:s');
        $remember_token = bin2hex(random_bytes(16)); // Generates a random token

        // Bind the parameters (s = string for each field)
        $stmt->bind_param("sssss", $this->username, $this->email, $this->password, $created_at, $remember_token);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            die('Execute error: ' . $stmt->error);
        }
    }

    public function login($remember_me = false)
    {
        // SQL query to check if the email exists
        $query = "SELECT * FROM admins WHERE email = ? LIMIT 1";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die('Prepare error: ' . $this->conn->error);
        }

        // Bind the email parameter
        $stmt->bind_param("s", $this->email);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if email exists
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();

            // Verify password
            if (password_verify($this->password, $admin['password'])) {
                // Set session variables
                session_start();
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_email'] = $admin['email'];

                // If the user checked "Remember Me", set cookies
                if ($remember_me) {
                    setcookie('remember_token', $admin['remember_token'], time() + (86400 * 30), "/"); // 30 days expiration
                }

                // Redirect to admin dashboard
                header("Location: ../index.php");
                exit;
            } else {
                return "Invalid password!";
            }
        } else {
            return "Email not found!";
        }
    }
}
?>
