<?php

class ContactController {
    private $conn;
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
    public function getAllContacts() {
        $stmt = $this->conn->prepare("SELECT * FROM contacts");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteContact($id) {
        $query = "DELETE FROM contacts WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id); // 'i' specifies the variable type is integer

        return $stmt->execute();
    }
}

?>