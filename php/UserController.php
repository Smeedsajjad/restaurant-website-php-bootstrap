<?php
require_once './config/config.php';

class UserController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($full_name, $username, $email, $password, $phone)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->conn->prepare("INSERT INTO users (full_name, username, email, password, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $username, $email, $hashedPassword, $phone);
        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // session_start(); // Remove this line
            return $user; // Return the user object instead of true
        }
        return false;
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
