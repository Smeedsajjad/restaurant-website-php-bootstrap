<?php

class ContactController
{
    private $conn;
    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }
    // insert message
    public function insertContact($name, $email, $subject, $message)
    {
        $stmt = $this->conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        return $stmt->execute();
    }
    public function saveReview($name, $email, $rating, $review, $product_id)
    {
        // Check if the product exists in the products table
        $stmt = $this->conn->prepare("SELECT id FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);  // 'i' for integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // The product doesn't exist, throw an error or handle it
            throw new Exception("Product with ID $product_id does not exist.");
        }

        // Proceed to insert the review if the product exists
        $stmt = $this->conn->prepare("INSERT INTO reviews (name, email, rating, review, product_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisi", $name, $email, $rating, $review, $product_id);
        $stmt->execute();
    }

    public function getReviews($productId, $page = 1, $limit = 5)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->conn->prepare("SELECT name, email, rating, review, created_at FROM reviews WHERE product_id = ? ORDER BY created_at DESC LIMIT ?, ?");
        $stmt->bind_param("iii", $productId, $offset, $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalReviewsCount($productId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM reviews WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }
}
