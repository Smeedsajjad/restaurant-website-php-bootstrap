<?php
require_once "../admin/config/config.php";
require_once "Contact.php";

$database = new Database();
$dbConnection = $database->conn;
$response = ['success' => false];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';

        $contactController = new ContactController($dbConnection);
        if ($contactController->insertContact($name, $email, $subject, $message)) {
            $response['success'] = true;
        }
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

// Clear any output buffer before sending JSON
if (ob_get_length()) ob_clean();

header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
