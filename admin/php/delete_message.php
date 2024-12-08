<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../config/config.php';
require_once 'ContactMessages.php';

header('Content-Type: application/json'); // Set the content type to JSON

$response = ['success' => false, 'message' => 'Failed to delete message.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $database = new Database();
    $dbConnection = $database->conn;
    $contact = new ContactController($dbConnection);

    $messageId = intval($_POST['id']);

    if ($contact->deleteContact($messageId)) {
        $response['success'] = true;
        $response['message'] = 'Message deleted successfully.';
    }
}

echo json_encode($response);
?>