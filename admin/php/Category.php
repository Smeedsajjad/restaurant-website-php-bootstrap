<?php
// Category.php

class Category {
    private $conn;

    // Constructor to receive the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create a new category
    public function create($cat_name, $cat_img) {
        $query = "INSERT INTO categories (cat_name, cat_img) VALUES (:cat_name, :cat_img)";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':cat_name', $cat_name);
        $stmt->bindParam(':cat_img', $cat_img);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Return true on success
        }
        return false; // Return false on failure
    }
}
