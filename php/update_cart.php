<?php
require_once '../config/config.php';

$response = ['status' => 'success'];
$database = new Database();
$dbConnection = $database->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    foreach ($_POST['cart'] as $cartId => $data) {
        if (isset($data['qty'])) {
            $quantity = $data['qty'];

            if ($quantity > 0) {
                // Update the cart quantity in the database
                $sql = "UPDATE cart SET quantity = ? WHERE id = ?";
                $stmt = $dbConnection->prepare($sql);
                $stmt->bind_param("ii", $quantity, $cartId);
                if (!$stmt->execute()) {
                    $response = ['status' => 'error', 'message' => 'Failed to update cart item'];
                    break;
                }
                $stmt->close();
            } else {
                // Delete the item from the cart if quantity is 0
                $sql = "DELETE FROM cart WHERE id = ?";
                $stmt = $dbConnection->prepare($sql);
                $stmt->bind_param("i", $cartId);
                if (!$stmt->execute()) {
                    $response = ['status' => 'error', 'message' => 'Failed to delete cart item'];
                    break;
                }
                $stmt->close();
            }
        } else {
            $response = ['status' => 'error', 'message' => "Quantity not set for cart ID $cartId"];
            break;
        }
    }
} else {
    $response = ['status' => 'error', 'message' => 'No cart data received'];
}

$dbConnection->close();

echo json_encode($response);
?>
