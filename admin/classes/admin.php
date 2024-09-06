<?php
require_once './config/config.php';
class Admin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function register($username, $email, $password) {
        $query = "INSERT INTO admins (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $passwordHash);
            $result = $stmt->execute();
            $stmt->close();

            if ($result) {
                return array('success' => true, 'message' => 'Admin registered successfully.');
            } else {
                return array('success' => false, 'message' => 'Failed to register admin.');
            }
        } else {
            return array('success' => false, 'message' => 'Failed to prepare statement.');
        }
    }

    public function login($email, $password) {
        $query = "SELECT * FROM admins WHERE email = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $admin = $result->fetch_assoc();
            $stmt->close();

            if ($admin && password_verify($password, $admin['password'])) {
                return array('success' => true, 'message' => 'Login successful.');
            } else {
                return array('success' => false, 'message' => 'Invalid email or password.');
            }
        } else {
            return array('success' => false, 'message' => 'Failed to prepare statement.');
        }
    }
}
?>
