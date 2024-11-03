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
            // Check if the product already exists in the cart
            $checkStmt = $this->connection->prepare("SELECT quantity FROM cart WHERE product_id = ?");
            $checkStmt->bind_param("i", $productId);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {
                // If product exists, update the quantity
                $existingQuantity = $result->fetch_assoc()['quantity'];
                $newQuantity = $existingQuantity + $quantity;

                $updateStmt = $this->connection->prepare("UPDATE cart SET quantity = ? WHERE product_id = ?");
                $updateStmt->bind_param("ii", $newQuantity, $productId);

                if ($updateStmt->execute()) {
                    return ['status' => 'success', 'message' => 'Product quantity updated in cart.'];
                } else {
                    return ['status' => 'error', 'message' => 'Failed to update quantity: ' . $updateStmt->error];
                }
            } else {
                // If product does not exist, insert it into the cart
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
            }
        } catch (Exception $e) {
            // Log the error for debugging purposes
            error_log("Database Error: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to add product to cart due to database error.'];
        }
    }

    // Method to get total count of items in cart
    public function getCartCount()
    {
        $stmt = $this->connection->prepare("SELECT SUM(quantity) AS count FROM cart");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] ? (int)$row['count'] : 0; // Return 0 if count is null
    }
}
