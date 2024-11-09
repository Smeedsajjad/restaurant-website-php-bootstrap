<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';  // Include the database connection file
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the JSON data from the POST body
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if required fields are provided
    if (empty($input['product_id']) || empty($input['action'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing product_id or action']);
        exit;
    }

    $productId = $input['product_id'];
    $action = $input['action'];

    // Example logic for adding/removing from wishlist
    // Assuming $db is your database connection
    if ($action == 'add') {
        // Add to wishlist logic
        $query = "INSERT INTO wishlist (product_id, session_id) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$productId, session_id()]);
        echo json_encode(['status' => 'added']);
    } elseif ($action == 'remove') {
        // Remove from wishlist logic
        $query = "DELETE FROM wishlist WHERE product_id = ? AND session_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$productId, session_id()]);
        echo json_encode(['status' => 'removed']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}