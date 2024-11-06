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
            $checkStmt = $this->connection->prepare("SELECT quantity FROM cart WHERE product_id = ?");
            $checkStmt->bind_param("i", $productId);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {
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
                $stmt = $this->connection->prepare("INSERT INTO cart (product_id, quantity) VALUES (?, ?)");
                if (!$stmt) {
                    return ['status' => 'error', 'message' => 'Prepare failed: ' . $this->connection->error];
                }

                $stmt->bind_param("ii", $productId, $quantity);
                if ($stmt->execute()) {
                    return ['status' => 'success', 'message' => 'Product added to cart.'];
                } else {
                    return ['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error];
                }
            }
        } catch (Exception $e) {
            error_log("Database Error: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to add product to cart due to database error.'];
        }
    }

    public function getCartCount()
    {
        $stmt = $this->connection->prepare("SELECT SUM(quantity) AS count FROM cart");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] ? (int)$row['count'] : 0;
    }

    public function removeFromCart($productId)
    {
        $stmt = $this->connection->prepare("DELETE FROM cart WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Product removed from cart.'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to remove product: ' . $stmt->error];
        }
    }

    public function getCartItems()
    {
        $stmt = $this->connection->prepare("
            SELECT c.product_id, c.quantity, p.name, p.price, p.images 
            FROM cart c 
            JOIN products p ON c.product_id = p.id
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        return $items;
    }

    public function getCartSubtotal()
    {
        $stmt = $this->connection->prepare("
            SELECT SUM(c.quantity * p.price) AS subtotal 
            FROM cart c 
            JOIN products p ON c.product_id = p.id
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['subtotal'] ? (float)$row['subtotal'] : 0.00; // Return 0.00 if subtotal is null
    }
}
