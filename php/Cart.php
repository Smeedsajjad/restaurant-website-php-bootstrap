<?php
class Cart {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addToCart($productId, $quantity, $userId) {
        // Check if the product already exists in the user's cart
        $stmt = $this->conn->prepare("SELECT id, quantity FROM cart WHERE product_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $productId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the product already exists, update the quantity
            $row = $result->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity;

            $updateStmt = $this->conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            $updateStmt->bind_param("ii", $newQuantity, $row['id']);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            // If the product does not exist, insert it
            $insertStmt = $this->conn->prepare("INSERT INTO cart (product_id, quantity, user_id) VALUES (?, ?, ?)");
            $insertStmt->bind_param("iii", $productId, $quantity, $userId);
            $insertStmt->execute();
            $insertStmt->close();
        }

        $stmt->close();
        return ['status' => 'success', 'message' => 'Product added to cart'];
    }

    public function getCartCount($userId) {
        $stmt = $this->conn->prepare("SELECT SUM(quantity) AS count FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] ?? 0;
    }

    // Method to get the cart count
    public function getCartCountSlider($userId) {
        $query = "SELECT COUNT(*) AS count FROM cart WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'];
    }

    // Method to get cart items
    public function getCartItems($userId) {
        $query = "SELECT c.id, p.name AS product_name, c.quantity, p.price, p.images AS product_image
                  FROM cart c
                  JOIN products p ON c.product_id = p.id
                  WHERE c.user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
