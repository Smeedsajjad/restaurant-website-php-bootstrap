<?php
class Order {
    private $db;
    private $cart;

    public function __construct($db) {
        $this->db = $db;
        $this->cart = new Cart($db);
    }

    public function createOrder($userId, $billingId, $paymentMethod) {
        try {
            // Start transaction
            $this->db->begin_transaction();

            // Get cart items
            $cartItems = $this->cart->getCartItems($userId);
            if (empty($cartItems)) {
                throw new Exception("Cart is empty");
            }

            // Calculate total amount
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // Create order
            $stmt = $this->db->prepare("INSERT INTO orders (user_id, billing_id, payment_method, total_amount) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $userId, $billingId, $paymentMethod, $totalAmount);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to create order");
            }
            
            $orderId = $this->db->insert_id;

            // Add order items
            $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            
            foreach ($cartItems as $item) {
                $stmt->bind_param("iiid", $orderId, $item['product_id'], $item['quantity'], $item['price']);
                if (!$stmt->execute()) {
                    throw new Exception("Failed to add order items");
                }
            }

            // Clear cart
            $this->clearCart($userId);

            // Commit transaction
            $this->db->commit();
            
            return [
                'status' => 'success',
                'message' => 'Order placed successfully!',
                'order_id' => $orderId
            ];

        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->rollback();
            throw $e;
        }
    }

    private function clearCart($userId) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }
}
?>
