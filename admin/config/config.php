<?php
class Database
{
    private $host = "localhost"; // Database host
    private $username = "root"; // Database username
    private $password = ""; // Database password
    private $dbname = "restaurant"; // Database name
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function close()
    {
        $this->conn->close();
    }
}
