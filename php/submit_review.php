<?php
require_once 'Contact.php';
require_once '../admin/config/config.php';
header('Content-Type: application/json');  // Ensure the correct response type

$response = ['success' => false, 'message' => 'Failed to submit review.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $rating = $_POST['rating'] ?? 0;
    $review = $_POST['review'] ?? '';
    $product_id = $_POST['product_id'] ?? 0; // Assuming product_id is sent with the form

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($review) && $rating > 0 && $rating <= 5 && $product_id > 0) {
        // Create an instance of ContactController
        $database = new Database();
        $dbConnection = $database->conn;
        $contactController = new ContactController($dbConnection);

        try {
            // Use the saveReview method
            $contactController->saveReview($name, $email, $rating, $review, $product_id);
            $response['success'] = true;
            $response['message'] = 'Review submitted successfully.';
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }
    } else {
        $response['message'] = 'Please fill all the fields, provide a rating between 1 and 5, and ensure the product ID is valid.';
    }
}

echo json_encode($response);  // Return JSON response