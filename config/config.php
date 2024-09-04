<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $database = 'restaurant';
    private $password = '';
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
         // Create a new mysqli instance and attempt to connect to the database
         $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

         // Check the connection errors
         if ($this->connection->connect_error){
            die('Connection Failed: ' .$this->connection->connect_error);
         }
    }

    public function getConnection(){
        return $this->connection;
    }

    public function __destruct() {
        // Close the connection when the object is destroyed
        if($this->connect()) {
            $this->connection->close();
        }
    }
}
?>