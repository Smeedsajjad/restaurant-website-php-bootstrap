<?php
class Cart
{
    private $connection;
    private $table_name = "cart";

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function addToCart($productId, $quantity)
    {
        try {
            // Prepare your SQL statement
            $stmt = $this->connection->prepare("INSERT INTO cart (product_id, quantity) VALUES (?, ?)");
            if (!$stmt) {
                return ['status' => 'error', 'message' => 'Prepare failed: ' . $this->connection->error];
            }

            $stmt->bind_param("ii", $productId, $quantity);
            
            // Execute the statement
            if ($stmt->execute()) {
                return ['status' => 'success', 'message' => 'Product added to cart.'];
            } else {
                return ['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error];
            }
        } catch (PDOException $e) {
            // Log the error for debugging purposes
            error_log("Database Error: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to add product to cart due to database error.'];
        }
    }
}
