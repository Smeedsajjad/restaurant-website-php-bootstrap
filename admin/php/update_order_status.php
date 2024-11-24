<?php
// Clean any output buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Start fresh output buffer
ob_start();

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Initialize response array
$response = ['success' => false, 'message' => ''];

try {
    require_once '../../admin/config/config.php';
    $db = new Database();
    $conn = $db->conn;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }
    
    // Debug received data
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    
    // Log the received data
    error_log("Received order_id: " . $order_id);
    error_log("Received status: " . $status);
    
    // Validate inputs
    if ($order_id <= 0 || empty($status)) {
        throw new Exception("Invalid input data - ID: $order_id, Status: $status");
    }
    
    // Validate status values
    $valid_statuses = ['pending', 'processing', 'completed', 'cancelled'];
    if (!in_array($status, $valid_statuses)) {
        throw new Exception("Invalid status value: $status");
    }
    
    // Update the order status using mysqli
    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }
    
    $stmt->bind_param("si", $status, $order_id);
    $result = $stmt->execute();
    
    if ($result) {
        $response['success'] = true;
        $response['message'] = "Order status updated successfully";
        $response['data'] = [
            'order_id' => $order_id,
            'new_status' => $status
        ];
    } else {
        throw new Exception("Failed to update order status: " . $stmt->error);
    }
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    $response['error_type'] = 'Exception';
    error_log("Error: " . $e->getMessage());
}

// Clear any output buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Set JSON header
header('Content-Type: application/json');

// Encode and output response
$json_response = json_encode($response);
if ($json_response === false) {
    error_log("JSON encode error: " . json_last_error_msg());
    $json_response = json_encode(['success' => false, 'message' => 'JSON encoding error']);
}

echo $json_response;
exit();