<?php
session_start();
require_once '../config/config.php';
require_once 'Cart.php';
require_once 'Order.php';

class BillingDetails {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertbillingdetails($data) {
        $stmt = $this->db->prepare("INSERT INTO billingdetails (firstName, lastName, country, address, address2, city, county, postcode, phone, email, notes) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssssssss",
            $data['firstName'],
            $data['lastName'],
            $data['country'],
            $data['address'],
            $data['address2'],
            $data['city'],
            $data['county'],
            $data['postcode'],
            $data['phone'],
            $data['email'],
            $data['notes']
        );

        if ($stmt->execute()) {
            return $this->db->insert_id;
        } else {
            throw new Exception("Error submitting billing information: " . $stmt->error);
        }
    }
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please login to place an order']);
    exit;
}

$database = new Database();
$db = $database->conn;

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Enable error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        // Collect form data
        $data = [
            'firstName' => $_POST['firstName'] ?? '',
            'lastName' => $_POST['lastName'] ?? '',
            'country' => $_POST['country'] ?? '',
            'address' => $_POST['address'] ?? '',
            'address2' => $_POST['address2'] ?? '',
            'city' => $_POST['city'] ?? '',
            'county' => $_POST['county'] ?? '',
            'postcode' => $_POST['postcode'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'email' => $_POST['email'] ?? '',
            'notes' => $_POST['notes'] ?? ''
        ];

        // Validate required fields
        $required_fields = ['firstName', 'lastName', 'country', 'address', 'city', 'postcode', 'phone', 'email'];
        $missing_fields = [];
        
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                $missing_fields[] = $field;
            }
        }
        
        if (!empty($missing_fields)) {
            throw new Exception("The following required fields are missing: " . implode(', ', $missing_fields));
        }

        // Start transaction
        $db->begin_transaction();

        // Insert billing details
        $billing = new BillingDetails($db);
        $billingId = $billing->insertbillingdetails($data);

        // Create order
        $order = new Order($db);
        $paymentMethod = $_POST['payment'] ?? 'bank-transfer';
        $result = $order->createOrder($_SESSION['user_id'], $billingId, $paymentMethod);

        // Commit transaction
        $db->commit();

        echo json_encode([
            'status' => 'success',
            'message' => 'Order placed successfully!',
            'order_id' => $result['order_id']
        ]);

    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}
?>
