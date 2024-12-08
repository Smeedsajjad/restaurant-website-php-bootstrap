<?php

class ContactController {
    private $conn;
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
// insert message
    public function insertContact($name, $email, $subject, $message) {
        $stmt = $this->conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        return $stmt->execute();
    }
// Get all messages
    public function getAllContacts() {
        $stmt = $this->conn->prepare("SELECT * FROM contacts");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    
}

?>