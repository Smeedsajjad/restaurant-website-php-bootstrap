<?php
require_once '../config/config.php';

$response = ['status' => 'error', 'message' => 'Invalid request'];
$database = new Database();
$dbConnection = $database->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];

    $sql = "DELETE FROM cart WHERE id = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param("i", $cartId);

    if ($stmt->execute()) {
        $response = ['status' => 'success', 'message' => 'Item removed successfully'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to remove item'];
    }

    $stmt->close();
}

$dbConnection->close();

echo json_encode($response);
?>
