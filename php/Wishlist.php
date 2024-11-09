<?php
require_once './config/config.php'; // Adjusted path to config.php

class Wishlist {
    private $conn;

    public function __construct($conn = null) {
        // Use the mysqli instance from config if not provided
        $this->conn = $conn ?: $GLOBALS['dbConnection']; // Assuming $dbConnection is defined in config.php
    }

    public function addToWishlist($sessionId, $productId) {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO wishlist (session_id, product_id) VALUES (?, ?)");
        $stmt->bind_param("si", $sessionId, $productId);
        return $stmt->execute();
    }

    public function removeFromWishlist($sessionId, $productId) {
        $stmt = $this->conn->prepare("DELETE FROM wishlist WHERE session_id = ? AND product_id = ?");
        $stmt->bind_param("si", $sessionId, $productId);
        return $stmt->execute();
    }

    public function isInWishlist($sessionId, $productId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM wishlist WHERE session_id = ? AND product_id = ?");
        $stmt->bind_param("si", $sessionId, $productId);
        $stmt->execute();
        
        $result = $stmt->get_result(); // Get the result set from the executed statement
        $row = $result->fetch_assoc(); // Fetch the single row result as an associative array
        
        $stmt->close(); // Close the statement
        
        return $row['count'] > 0; // Check if the count is greater than 0
    }
}
?>